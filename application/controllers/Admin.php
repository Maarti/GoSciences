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
        $this->load->model('utilisateur_model');
        $data['tab_title'] = 'GoSciences - Administration';
        $data['page_title'] = 'Prestations';
        $data['show_modal'] = (!empty($id_prest) && !empty($id_class))? 'modal-'.$id_prest.'-'.$id_class : null;
        $data['prestations'] = $this->classe_model->get_prestations();
        $tarifs = array();
        foreach ($data['prestations'] as $p)
            $tarifs[$p['id']] = $this->classe_model->get_tarifs($p['id']);
        $data['tarifs'] = $tarifs;
        $data['enum_unite_remise'] = array('/h', '/2h', '/20h', '/jour', '/semaine');
        $this->load->view('site/header', $data);
        $this->load->view('site/menu', $data);
        $this->load->view('admin/admin_prestations', $data);
        $this->load->view('site/footer');
    }
    
    public function valid_prestations($id_prest=null,$id_class=null) {
        $this->form_validation->set_rules('tarif_brut', 'Tarif brut', 'required|numeric|greater_than_equal_to[0]|less_than_equal_to[9999]');
        $this->form_validation->set_rules('tarif_remise', 'Tarif remise', 'required|numeric|greater_than_equal_to[0]|less_than_equal_to[9999]');
        $this->form_validation->set_rules('unite_remise', 'Unité', 'required|in_list[/h,/2h,/20h,/jour]');
        $this->form_validation->set_rules('nb_seance', 'Nb séances', 'required|integer|greater_than_equal_to[0]');
        $this->form_validation->set_rules('duree_seance', 'Durée séance', 'required|numeric|greater_than_equal_to[0]|less_than_equal_to[24]');
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
            redirect('admin/prestations');
        }else
            $this->prestations($id_prest,$id_class);
    }
}
