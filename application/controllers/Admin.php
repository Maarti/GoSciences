<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct(){
        parent::__construct();        
        $this->load->library('form_validation');
        if(!isset($_SESSION['id']) || !in_array(90, $_SESSION['roles']))
                redirect('site/accueil', 'refresh');
        //$this->output->enable_profiler(true);
    }
    
    public function index(){
        redirect('admin/utilisateurs');
    }
    
    public function utilisateurs(){
        $this->load->model('utilisateur_model');
        $data['tab_title'] = 'GoSciences - Administration';
        $data['page_title'] = 'Utilisateurs';
        
        $data['utilisateurs'] = $this->utilisateur_model->
                read('id,mail,nom,prenom,tel,date_naissance,date_inscription,date_connexion,etat',array(),null,null,'nom,prenom ASC')->result();
        $this->load->view('site/header', $data);
        $this->load->view('site/menu', $data);
        $this->load->view('admin/admin_utilisateurs', $data);
        $this->load->view('site/footer');
    }
    
    public function prestations($id_prest=null,$id_class=null){
        $data['tab_title'] = 'GoSciences - Administration';
        $data['page_title'] = 'Prestations';
        // Ouvre automatiquement le modal en erreur
        $data['show_modal'] = (!empty($id_prest) && !empty($id_class))? 'modal-'.$id_prest.'-'.$id_class : null;
        $data['id_prest'] = $id_prest;
        $data['prestations'] = $this->classe_model->get_prestations();
        $tarifs = array();
        foreach ($data['prestations'] as $p)
            $tarifs[$p['id']] = $this->classe_model->get_tarifs($p['id']);
        $data['tarifs'] = $tarifs;
        $data['enum_unite_remise'] = array(NULL, '/h', '/2h', '/20h', '/jour', '/semaine');
        $this->load->view('site/header', $data);
        $this->load->view('site/menu', $data);
        $this->load->view('admin/admin_prestations', $data);
        $this->load->view('site/footer');
    }
    
    public function valid_prestations($id_prest=null,$id_class=null) {
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
            redirect('admin/prestations/'.$id_prest);
        }else
            $this->prestations($id_prest,$id_class);
    }
    
     public function classes($id_class=null){
        $this->load->model('classe_model');
        $data['tab_title'] = 'GoSciences - Administration';
        $data['page_title'] = 'Classes';
        $data['id_class'] = $id_class;
        $data['classes'] =$this->classe_model->get_all_classe_disciplines();
        
        $this->load->view('site/header', $data);
        $this->load->view('site/menu', $data);
        $this->load->view('admin/admin_classes', $data);
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
        $data['tab_title'] = 'GoSciences - Administration';
        $data['page_title'] = 'Logs';
        $data['logs'] =$this->log_model->get_last()->result();
        $this->load->view('site/header', $data);
        $this->load->view('site/menu', $data);
        $this->load->view('admin/admin_logs', $data);
        $this->load->view('site/footer');
    }
    
    public function textes(){
        $data['tab_title'] = 'GoSciences - Administration';
        $data['page_title'] = 'Textes';
        $data['tinymce'] = 
            "selector: '#mytextarea',
             style_formats: [
                {title: 'Vert GoSciences', inline: 'span', classes: 'green-word'},
                {title: 'Test', inline: 'span', classes: 'valid-error'}
             ],
             style_formats_merge: true,
             content_css:'/assets/css/style.css'";
            //content_style:'.green-word{color:#B2C835;}'
        $this->load->view('site/header', $data);
        $this->load->view('site/menu', $data);
        $this->load->view('admin/admin_textes', $data);
        $this->load->view('site/footer');
    }
    
    public function valid_textes(){
        $data['output'] = $this->input->post('mon_texte');
        $this->load->view('site/header', $data);
        $this->load->view('site/menu', $data);
        $this->load->view('admin/admin_textes', $data);
        $this->load->view('site/footer');
    }
}
