<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cours extends CI_Controller {

    public function __construct(){
        parent::__construct();
        //$this->output->enable_profiler(true);
    }
    
    public function index(){
        $this->tarifs();
    }

    public function tarifs($id_prest = null){
        $data['tab_title'] = 'GoSciences - Tarifs';
        $data['page_title'] = 'Tarifs';
        $data['tarifs'] = $this->classe_model->get_tarifs($id_prest);
        var_dump($data['tarifs']);
        if (empty($data['tarifs']))
            redirect('site/accueil', 'refresh');
        else{
            $this->load->view('site/header', $data);
            $this->load->view('site/menu', $data);
            $this->load->view('cours/tarifs', $data);
            $this->load->view('site/footer');
        }
    }
        
}
