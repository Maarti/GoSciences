<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends CI_Controller {

        public function index(){
            $this->accueil();
        }
	public function accueil()
	{            
            $data['page_title'] = 'GoSciences - Accueil';
            
            $this->load->view('site/header', $data);
            $this->load->view('site/menu', $data);
            $this->load->view('site/accueil', $data);
            $this->load->view('site/footer');
	}
        
}
