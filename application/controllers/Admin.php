<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct(){
        parent::__construct();        
        //$this->output->enable_profiler(true);
    }
    
    public function index(){        
        $data['tab_title'] = 'GoSciences - Administration';
        $data['page_title'] = 'Paramétrage des tarifs';
        $this->load->view('site/header', $data);
        $this->load->view('site/menu', $data);
        $this->load->view('admin/admin_tarifs', $data);
        $this->load->view('site/footer');
    }
}
