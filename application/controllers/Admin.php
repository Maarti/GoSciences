<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->data['tab_title'] = 'GoSciences - Aide scolaire à Orléans et ses environs | Administration';
        $this->data['meta_desc'] = 'GoSciences propose de l\'aide scolaire de qualité dans les matières scientifiques à Orléans, La Ferté-Saint-Aubin, La Chapelle-Saint-Mesmin, Saint-Jean-de-Braye, Saint-Jean-le-Blanc, Saint-Jean-de-la-Ruelle, Olivet, Saran, Lamotte-Beuvron, Vouzon, Marcilly-en-Villette, Menestreau-en-Villette, Saint-Cyr-en-Val, Ligny-le-Ribault, Jouy-le-Potier.';
        $this->data['meta_robots'] = 'noindex, nofollow';
        $this->load->library('form_validation');
        if(!isset($_SESSION['id']) || !in_array(90, $_SESSION['roles']))
                return redirect ('utilisateur/connexion/connexion_requise', 'refresh');
        //$this->output->enable_profiler(true);
    }
    
    public function index(){
        redirect('admin/prestations');
    }
    
    public function utilisateurs(){
        $this->load->model('utilisateur_model');
        $this->data['page_title'] = 'Utilisateurs';
        
        $this->data['utilisateurs'] = $this->utilisateur_model->
                read('id,mail,nom,prenom,tel,date_naissance,date_inscription,date_connexion,etat',array(),null,null,'nom,prenom ASC')->result();
        $this->load->view('site/header', $this->data);
        $this->load->view('site/menu', $this->data);
        $this->load->view('admin/admin_utilisateurs', $this->data);
        $this->load->view('site/footer');
    }
    
    public function tarifs($id_prest=null,$id_class=null){
        $this->data['page_title'] = 'Tarifs';
        // Ouvre automatiquement le modal en erreur
        if(!empty($id_prest) && !empty($id_class))
            $this->data['footer_include'][0] = '<script>$(document).ready(function(){$(\'#modal-'.$id_prest.'-'.$id_class.'\').foundation(\'open\')});</script>';
         $this->data['id_prest'] = $id_prest;
        $this->data['prestations'] = $this->classe_model->get_prestations();
        $tarifs = array();
        foreach ($this->data['prestations'] as $p)
            $tarifs[$p['id']] = $this->classe_model->get_tarifs($p['id']);
        $this->data['tarifs'] = $tarifs;
        $this->data['enum_unite_remise'] = array(NULL, '/h', '/2h', '/20h', '/jour', '/semaine');
        $this->load->view('site/header', $this->data);
        $this->load->view('site/menu', $this->data);
        $this->load->view('admin/admin_tarifs', $this->data);
        $this->load->view('site/footer');
    }
    
    public function valid_tarifs($id_prest=null,$id_class=null) {
        $this->form_validation->set_rules('tarif_brut', 'Tarif brut', 'numeric|greater_than_equal_to[0]|less_than_equal_to[9999]');
        $this->form_validation->set_rules('tarif_remise', 'Tarif remise', 'numeric|greater_than_equal_to[0]|less_than_equal_to[9999]');
        $this->form_validation->set_rules('unite_remise', 'Unité', 'in_list[/h,/2h,/20h,/jour,/semaine]');
        $this->form_validation->set_rules('nb_seance', 'Nb séances', 'integer|greater_than_equal_to[0]');
        $this->form_validation->set_rules('duree_seance', 'Durée séance', 'numeric|greater_than_equal_to[0]|less_than_equal_to[24]');
        $this->form_validation->set_error_delimiters('<p class="help-text valid-error">', '</p>');

        if ($this->form_validation->run()) {
            $this->load->model('tarif_model');            
            $this->tarif_model->update(array('prestation_id'=>$id_prest,'classe_id'=>$id_class),
                    array(  'tarif_brut'    =>$this->input->post('tarif_brut'),
                            'tarif_remise'  =>$this->input->post('tarif_remise'),
                            'unite_remise'  =>$this->input->post('unite_remise'),
                            'nb_seance'     =>$this->input->post('nb_seance'),
                            'duree_seance'  =>$this->input->post('duree_seance')
                        ));
            redirect('admin/tarifs/'.$id_prest);
        }else
            $this->tarifs($id_prest,$id_class);
    }
    
     public function classes($id_class=null){
        $this->load->model('classe_model');
        $this->data['page_title'] = 'Classes';
        $this->data['id_class'] = $id_class;
        $this->data['classes'] =$this->classe_model->get_all_classe_disciplines();
        
        $this->load->view('site/header', $this->data);
        $this->load->view('site/menu', $this->data);
        $this->load->view('admin/admin_classes', $this->data);
        $this->load->view('site/footer');
    }
    
    public function valid_classes($id_class=null) {
        $this->load->model('discipline_model');
        $disc = $this->discipline_model->read('id')->result_array();
        foreach ($disc as $d) {
            $this->form_validation->set_rules('description_'.$d['id'], 'Description', 'max_length[500]');
            $this->form_validation->set_rules('description_longue_'.$d['id'], 'Description longue', 'max_length[50000]');        
        }
        $this->form_validation->set_error_delimiters('<p class="help-text valid-error">', '</p>');

        if ($this->form_validation->run()) {
            $this->load->model('classe_discipline_model');
            foreach ($disc as $d) {
                $this->classe_discipline_model->update(array('discipline_id'=>$d['id'],'classe_id'=>$id_class),
                    array(  'description'           =>$this->input->post('description_'.$d['id']),
                            'description_longue'    =>$this->input->post('description_longue_'.$d['id'])));
            }           
            redirect('admin/classes/'.$id_class);
        }else
            $this->classes($id_class);
    }
    
    public function logs(){
        $this->load->model('log_model');
        $this->data['page_title'] = 'Logs';
        $this->data['logs'] =$this->log_model->get_last()->result();
        $this->load->view('site/header', $this->data);
        $this->load->view('site/menu', $this->data);
        $this->load->view('admin/admin_logs', $this->data);
        $this->load->view('site/footer');
    }
    
    public function textes($id_texte='sidebar_info'){
        $this->data['page_title'] = 'Textes';
        $this->data['textes'] = $this->texte_model->read('*')->result();
        $this->data['texte'] = $this->texte_model->read('*',array('id'=>$id_texte))->row();
        
        $base_url = (ENVIRONMENT=='development')? 'https://gosciences.fr/' : base_url();        
        if (ENVIRONMENT == 'development')
            $this->data['header_include'][0] = '<script src="//cloud.tinymce.com/stable/tinymce.min.js"></script>';
        else
            $this->data['header_include'][0] = '<script src="'.js_url('vendor/tinymce/tinymce.min').'"></script>';
            
        $this->data['header_include'][1] =
           "<script type=\"text/javascript\">
            tinymce.init({
                selector: 'textarea#corps',
                style_formats: [
                   {title: 'Vert GoSciences', inline: 'span', classes: 'green-word'},
                   {title: 'Nos Valeurs', inline: 'span', classes: 'hammer-word'},
                   {title: 'Stat', inline: 'span', classes: 'stat'}
                ],
                style_formats_merge: true,
                document_base_url : '".$base_url."',
                content_css:'/assets/css/style.css,/assets/css/app.css',
                height : 500,
                plugins: 'lists advlist code hr image textcolor link',
                toolbar: 'undo redo | fontsizeselect styleselect forecolor | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | bullist numlist | hr image link',
                browser_spellcheck: true,            
                contextmenu: false,
                schema: 'html5',
                language: 'fr_FR'
            });
            </script>";
        $this->load->view('site/header', $this->data);
        $this->load->view('site/menu', $this->data);
        $this->load->view('admin/admin_textes', $this->data);
        $this->load->view('site/footer');
    }
    
    public function valid_textes($id_texte=null){
        $this->form_validation->set_error_delimiters('<p class="help-text valid-error">', '</p>');
        
        // Si on a sélectionné un texte dans la liste déroulante
        if ($this->input->post('form') == 'texte_id'){
            //$this->form_validation->set_rules('id', 'Texte à modifier', 'in_list[1,2,3]');
            //if ($this->form_validation->run())
                redirect('admin/textes/'.$this->input->post('id'));
            //else
            //    $this->textes();
        }
        
        // Si on a modifié un texte
        else{
            $this->form_validation->set_rules('corps', 'Corps du texte', 'max_length[65535]');
            if ($this->form_validation->run()) {
                // On purifie le HTML écrit par l'utilisateur
                $html_purifier_path = APPPATH.'/third_party/htmlpurifier-4.9.2-lite/';
                require_once $html_purifier_path.'HTMLPurifier.auto.php';
                $config = HTMLPurifier_Config::createDefault();
                $purifier = new HTMLPurifier($config);
                $corps = $this->input->post('corps');
                $clean_corps = $purifier->purify($corps);

                $this->texte_model->update(array('id'=>$id_texte),array('corps'=>$clean_corps));
                redirect('admin/textes/'.$id_texte);
            }else
                $this->textes($id_texte);
        }
    }
    
    // Listes des prestations demandées par les clients en attente de réponse admin
    public function prestations(){
        $this->load->model('prestation_model');
        $this->data['page_title'] = 'Prestations';

        $this->data['demandes']= $this->prestation_model->get_array(null,array('etat'=>'demande'))->result();
        
        $this->load->view('site/header', $this->data);
        $this->load->view('site/menu', $this->data);
        $this->load->view('admin/admin_prestations', $this->data);
        $this->load->view('site/footer');
    }
    
    // Faire une propositions de cours à partir d'une demande de prestation client
    public function faire_proposition($id_prest=null){
        $this->load->model('prestation_model');
        $prest = $this->prestation_model->read('*',array('id'=>$id_prest))->row();
        if(empty($prest))
            return redirect ('admin', 'refresh');
        $this->data['page_title'] = 'Proposer une prestation';
        $this->data['prestation'] = $prest;
        
        $eventData = (empty($prest->disponibilite))? '{events : []}' : $prest->disponibilite;        
        $this->data['header_include'][0] = '<link rel="stylesheet" type="text/css" href="'.css_url('week-calendar/jquery-ui-1.8.11.custom').'" />';
        $this->data['header_include'][1] = '<link rel="stylesheet" type="text/css" href="'.css_url('week-calendar/jquery.weekcalendar').'" />';
        $this->data['header_include'][3] = '<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">';
        
        $this->data['footer_include'][2] = '<script src="'.js_url('vendor/week-calendar/jquery-1.4.4.min').'"></script>';
        $this->data['footer_include'][3] = '<script src="'.js_url('vendor/week-calendar/jquery-ui-1.8.11.custom.min').'"></script>';
        $this->data['footer_include'][4] = '<script src="'.js_url('vendor/week-calendar/date').'"></script>';
        $this->data['footer_include'][5] = '<script src="'.js_url('vendor/week-calendar/jquery.weekcalendar').'"></script>';
        $this->data['footer_include'][6] = '<script type="text/javascript">var eventData = '.$eventData.'</script>';
        $this->data['footer_include'][7] = '<script src="'.js_url('vendor/week-calendar/init-week-calendar-admin').'"></script>';
        $this->data['footer_include'][8] = '<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>';
        $this->data['footer_include'][9] = '<script src="'.js_url('scripts/init_timepicker').'"></script>';
        $this->data['footer_include'][10] = '<script src="'.js_url('scripts/definir_disponibilites').'"></script>';
        
        $this->load->view('site/header', $this->data);
        $this->load->view('site/menu', $this->data);
        $this->load->view('admin/admin_faire_proposition', $this->data);
        $this->load->view('site/footer');
    }
}
