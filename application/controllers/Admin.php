<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct(){
        parent::__construct();
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
    
    public function prestations(){
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
}
