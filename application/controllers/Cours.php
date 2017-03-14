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
        $this->load->model('prestation_model'); 
        $data['tarifs'] = $this->classe_model->get_tarifs($id_prest);
        $libelle_prest = $this->prestation_model->read('libelle',array('id'=>$id_prest))->row();
        if (empty($data['tarifs']) || empty($libelle_prest))
            redirect('site/accueil', 'refresh');
        else{                   
            $data['tab_title'] = 'GoSciences - Tarifs';
            $data['page_title'] = 'Tarifs '.$libelle_prest->libelle;
            $this->load->view('site/header', $data);
            $this->load->view('site/menu', $data);
            $this->load->view('cours/tarifs', $data);
            $this->load->view('site/footer');
        }
    }
        
}
