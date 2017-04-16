<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prestation extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('prestation_model');
        $this->data['tab_title'] = 'GoSciences - Aide scolaire à Orléans et ses environs | Classe';
        $this->data['meta_desc'] = 'GoSciences propose de l\'aide scolaire de qualité dans les matières scientifiques à Orléans, La Ferté-Saint-Aubin, La Chapelle-Saint-Mesmin, Saint-Jean-de-Braye, Saint-Jean-le-Blanc, Saint-Jean-de-la-Ruelle, Olivet, Saran, Lamotte-Beuvron, Vouzon, Marcilly-en-Villette, Menestreau-en-Villette, Saint-Cyr-en-Val, Ligny-le-Ribault, Jouy-le-Potier.';
    }
    
    public function index(){
        redirect ('site/accueil');
    }

    public function reserver(){
        if(!isset($_SESSION['id']))
            return redirect ('utilisateur/connexion/connexion_requise', 'refresh');
        
        $this->load->model('eleve_model');
        $this->load->model('type_prestation_model');
        $this->load->model('discipline_model');
        $this->data['tab_title'] = 'GoSciences - Aide scolaire à Orléans et ses environs | Réserver une prestation';
        $this->data['meta_desc'] = 'Réservez une prestation GoSciences en Mathématiques, SVT, Physique et Chimie niveau collège et lycée à Orléans, La Ferté-Saint-Aubin, La Chapelle-Saint-Mesmin, Saint-Jean-de-Braye, Saint-Jean-le-Blanc, Saint-Jean-de-la-Ruelle, Olivet, Saran, Lamotte-Beuvron, Vouzon, Marcilly-en-Villette, Menestreau-en-Villette, Saint-Cyr-en-Val, Ligny-le-Ribault, Jouy-le-Potier.';
        $this->data['page_title'] = 'Définir la prestation';
        $this->data['classes'] = $this->classe_model->read('id,libelle',array(),null,null,'ordre ASC')->result();
        $this->data['eleves'] = $this->eleve_model->read('id,nom,prenom,classe',array('parent'=>$_SESSION['id']))->result();
        $this->data['disciplines'] = $this->discipline_model->read('id,libelle')->result();
        // on propose tous les types de prestation sauf les stages
        $this->data['types_prest'] = $this->type_prestation_model->read('id,libelle',array('id !=' => 's'),null,null,'ordre ASC')->result();        
        $this->data['footer_include'][0] = '<script src="'.js_url('scripts/prestation_reserver').'"></script>';
        $this->load->view('site/header', $this->data);
        $this->load->view('site/menu', $this->data);
        $this->load->view('prestation/reserver', $this->data);
        $this->load->view('site/footer');
    }
    
    public function valid_reserver(){
        $this->form_validation->set_rules('eleve', 'Élève', 'required|callback_belong_to_user');
        $this->form_validation->set_rules('type_prestation', 'Type de prestation', 'required');
        $this->form_validation->set_rules('classe_prestation', 'Classe', 'required');
        $this->form_validation->set_rules('disciplines[]', 'Disciplines', 'required',array('required'=>'Vous devez sélectionner au moins une discipline.'));
        $this->form_validation->set_error_delimiters('<p class="help-text valid-error">', '</p>');

        if ($this->form_validation->run()) {
            $this->prestation_model->create(array(
                    'etat'                  =>  'propose',
                    'disciplines'           =>  serialize($this->input->post('disciplines[]')),
                    'type_prestation_id'    =>  $this->input->post('type_prestation'),
                    'eleve_id'              =>  $this->input->post('eleve'),
                    'classe_id'             =>  $this->input->post('classe_prestation')),
              array('date_deb'              =>  'CURDATE()')
            );
            // Retourne l'id de la dernière insertion
            $id_prest = $this->db->insert_id();
            $this->definir_disponibilites($id_prest);
        }else{
            $this->reserver();
        }
    }
    
     public function definir_disponibilites($id_prest=null){
        if(!isset($_SESSION['id']))
            return redirect ('utilisateur/connexion/connexion_requise', 'refresh');
        $prest = $this->prestation_model->read('*',array('id'=>$id_prest))->row();
        if(empty($prest) || !$this->belong_to_user($prest->eleve_id))
            return redirect ('site/accueil', 'refresh');
        
        $this->data['tab_title'] = 'GoSciences - Aide scolaire à Orléans et ses environs | Définir vos disponibilités';
        $this->data['meta_desc'] = 'Réservez une prestation GoSciences et définissez vos disponibilités, nous vous proposerons des crénneaux horaires en conséquences. Nous nous déplaçons à Orléans, La Ferté-Saint-Aubin, La Chapelle-Saint-Mesmin, Saint-Jean-de-Braye, Saint-Jean-le-Blanc, Saint-Jean-de-la-Ruelle, Olivet, Saran, Lamotte-Beuvron, Vouzon, Marcilly-en-Villette, Menestreau-en-Villette, Saint-Cyr-en-Val, Ligny-le-Ribault et Jouy-le-Potier.';
        $this->data['page_title'] = 'Définir vos disponibilités';

        $this->data['prestation'] = $prest;
        /*$this->data['header_include'][0] = '<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">';
        $this->data['footer_include'][0] = '<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>';
        $this->data['footer_include'][1] = '<script src="'.js_url('scripts/init_timepicker').'"></script>';
        $this->data['footer_include'][2] = '<script src="'.js_url('scripts/definir_disponibilites').'"></script>';*/
        $eventData = (empty($prest->disponibilite))? '{events : []}' : $prest->disponibilite;
        $this->data['header_include'][0] = '<link rel="stylesheet" type="text/css" href="'.css_url('week-calendar/jquery-ui-1.8.11.custom').'" />';
        $this->data['header_include'][1] = '<link rel="stylesheet" type="text/css" href="'.css_url('week-calendar/jquery.weekcalendar').'" />';
        $this->data['footer_include'][2] = '<script src="'.js_url('vendor/week-calendar/jquery-1.4.4.min').'"></script>';
        $this->data['footer_include'][3] = '<script src="'.js_url('vendor/week-calendar/jquery-ui-1.8.11.custom.min').'"></script>';
        $this->data['footer_include'][4] = '<script src="'.js_url('vendor/week-calendar/date').'"></script>';
        $this->data['footer_include'][5] = '<script src="'.js_url('vendor/week-calendar/jquery.weekcalendar').'"></script>';
        $this->data['footer_include'][6] = '<script type="text/javascript">var eventData = '.$eventData.'</script>';
        $this->data['footer_include'][7] = '<script src="'.js_url('vendor/week-calendar/init-week-calendar').'"></script>';
        
        $this->load->view('site/header', $this->data);
        $this->load->view('site/menu', $this->data);
        $this->load->view('prestation/disponibilites', $this->data);
        $this->load->view('site/footer');
    }
    
     public function valid_disponibilites($id_prest=null){
         if(!isset($_SESSION['id']))
            return redirect ('utilisateur/connexion/connexion_requise', 'refresh');
        $prest = $this->prestation_model->read('*',array('id'=>$id_prest))->row();
        if(empty($prest) || !$this->belong_to_user($prest->eleve_id))
            return redirect ('site/accueil', 'refresh');
        
        $this->form_validation->set_rules('disponibilite', 'Disponibilités', 'callback_valid_json');        
        $this->form_validation->set_rules('commentaire', 'Commentaire', 'max_length[512]');
        $this->form_validation->set_error_delimiters('<p class="help-text valid-error">', '</p>');

        if ($this->form_validation->run()) {
            $this->prestation_model->update(array('id'=>$id_prest),array(
                'disponibilite' => $this->input->post('disponibilite'),
                'etat'          => 'propose',
                'commentaire'   => $this->input->post('commentaire')
                ));
        }else{
            $this->definir_disponibilites($id_prest);
        }
    }
    
    // Vérifie si l'id d'élève appartient au compte connecté
    public function belong_to_user($eleve_id) {
        $this->load->model('eleve_model');
        if ($this->eleve_model->belong_to_user($eleve_id))
          return TRUE;
        else {
          $this->form_validation->set_message('belong_to_user', 'L\'élève ne correspond pas à votre compte.');
          return FALSE;
        }
    }


    public function valid_json($string=null) {
        json_decode($string);
        if ($string == '{"events":[]}')
            return TRUE;    // Tableau vide
        elseif((json_last_error() == JSON_ERROR_NONE))
            // TODO Tester les valeurs présentent dans le json (sanitize)
            return TRUE;
        else{
            $this->form_validation->set_message('valid_json', 'Format des disponibilités incorrect.');         
            return FALSE;
        }
            
    }

}
