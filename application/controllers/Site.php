<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends CI_Controller {

    public function __construct(){
        parent::__construct();        
        //$this->output->enable_profiler(true);                
    }
    
    public function index(){
        $this->accueil();
    }

    public function accueil(){            
        $data['tab_title'] = 'GoSciences - Accueil';
        $this->load->view('site/header', $data);
        $this->load->view('site/menu', $data);
        $this->load->view('site/accueil', $data);
        $this->load->view('site/footer');
    }

    public function contact($msg=NULL){
        $this->load->helper('form');
        $this->load->model('utilisateur_model');
        $data['tab_title'] = 'GoSciences - Contact';
        $data['page_title'] = 'Nous Contacter';
        if (isset($_SESSION['id'])){
            $data['mail'] = $this->utilisateur_model->read('mail',array('id'=>$_SESSION['id']))->row()->mail;
            $data['nom'] = $_SESSION['nom'];
            $data['prenom'] = $_SESSION['prenom'];
        }else{
            $data['mail'] = '';$data['nom']='';$data['prenom']='';
        }

        switch ($msg) { // Gestion des messages à afficher
        case 'envoi_ok':
            $type='success';
            $message='<h5>Envoi réussi.</h5><p>Merci, nous prendrons connaissance de votre message dès que possible.</p>';
            break;
        default:
            $type=NULL;
            $message=NULL;
        } 
        if(!is_null($type)&&!is_null($message))
        $data['msg']= '<div class="callout '.$type.'" data-closable>'.$message.'<button class="close-button" aria-label="Fermer" type="button" data-close><span aria-hidden="true">&times;</span></button></div>';

        $this->load->view('site/header', $data);
        $this->load->view('site/menu', $data);
        $this->load->view('site/contact', $data);
        $this->load->view('site/footer');
    }

     public function valid_contact(){
        $this->load->model('utilisateur_model');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nom', 'Nom', 'required|min_length[2]|max_length[50]|regex_match[/^([-a-z_éèàêâùïüë ])+$/i]');
        $this->form_validation->set_rules('prenom', 'Prénom', 'required|min_length[2]|max_length[50]|regex_match[/^([-a-z_éèàêâùïüë ])+$/i]');
        $this->form_validation->set_rules('mail', 'E-mail', 'required|valid_email|max_length[254]');
        $this->form_validation->set_rules('motif', 'Motif', 'required|in_list[info,postulation,bug,autre]');
        $this->form_validation->set_rules('message', 'Message', 'required|min_length[10]|max_length[2000]');
        $this->form_validation->set_error_delimiters('<p class="help-text valid-error">', '</p>');

        if ($this->form_validation->run()) {
            $mail = $this->input->post('mail');
            $nom = $this->input->post('nom');
            $prenom = $this->input->post('prenom');
            $message = $this->input->post('message');
            $this->utilisateur_model->sendMail('bryan.martinet@gmail.com', 'Contact depuis GoSciences', $message, $mail, $nom.' '.$prenom);
            redirect('site/contact/envoi_ok', 'refresh');
        }else
            $this->contact();
     }

     public function not_found(){
        $this->output->set_status_header('404');
        $data['page_title'] = 'GoSciences - Not found';            
        $this->load->view('site/header', $data);
        $this->load->view('site/menu', $data);
        $this->load->view('site/error_404', $data);
        $this->load->view('site/footer');
    }
        
}
