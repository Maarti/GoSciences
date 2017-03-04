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
        
        public function tarifs(){            
            $data['page_title'] = 'GoSciences - Tarifs';
            
            $this->load->view('site/header', $data);
            $this->load->view('site/menu', $data);
            $this->load->view('cours/tarifs', $data);
            $this->load->view('site/footer');
	}
        
}
