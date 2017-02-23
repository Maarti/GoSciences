<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Utilisateur extends CI_Controller {

     public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('utilisateur_model');        
        //$this->data['session']=$this->session->all_userdata();        
    }
    
    public function inscription() {
        $data['page_title'] = 'GoSciences - Inscription';        
        $this->load->view('site/header', $data);
        $this->load->view('site/menu', $data);
        $this->load->view('utilisateur/inscription', $data);
        $this->load->view('site/footer');
    }

    public function valid_inscription() {
        $this->form_validation->set_rules('mail', 'E-mail', 'required|valid_email|max_length[254]|is_unique[utilisateur.mail]', array('is_unique' => 'Cet %s est déjà utilisé sur le site.'));
        $this->form_validation->set_rules('nom', 'Nom', 'required|min_length[2]|max_length[50]|regex_match[/^([-a-z_éèàêâùïüë ])+$/i]');
        $this->form_validation->set_rules('prenom', 'Prénom', 'required|min_length[2]|max_length[50]|regex_match[/^([-a-z_éèàêâùïüë ])+$/i]');
        $this->form_validation->set_rules('pass', 'Mot de passe', 'required|min_length[3]|max_length[50]');
        $this->form_validation->set_rules('passconf', 'Confirmation', 'required|matches[pass]');
        $this->form_validation->set_error_delimiters('<p class="help-text valid-error">', '</p>');

        if ($this->form_validation->run()) {
            $mail = $this->input->post('mail');
            $nom = $this->input->post('nom');
            $prenom = $this->input->post('prenom');
            $pass = password_hash($this->input->post('pass'), PASSWORD_DEFAULT);
            $ip = $this->input->ip_address();
            
            $this->utilisateur_model->create($mail, $nom, $prenom, $pass, $ip);
            redirect('utilisateur/connexion/inscription_ok', 'refresh');
        }else
            $this->inscription();
    }

    public function connexion($msg=NULL) {
        $data['page_title'] = 'GoSciences - Connexion';

        switch ($msg) { // Gestion des messages à afficher en page d'accueil
            case 'ActivatingSuccess':
                $type='success';
                $message='Activation réussie.<br/>Vous pouvez désormais vous connecter avec vos identifiants.';
                break;
            case 'ActivatingFailed':
                $type='error';
                $message='Échec de l\'activation.<br/>Ce lien d\'activation ne correspond à aucun compte.<br/>Merci de contacter l\'administrateur grâce au menu "Contact" si le porblème persiste.';
                break;
            case 'inscription_ok':
                $type='success';
                $message='<h5>Inscription réussie.</h5><br/>Vous devez maintenant activer votre compte en cliquant sur le lien qui vous a été envoyé par e-mail.';
                break;
            case 'mustRegister':
                $type='error';
                $message='Vous devez d\'abord vous connecter pour faire cela.';
                break;
            default:
                $type=NULL;
                $message=NULL;
        } 
        if(!is_null($type)&&!is_null($message)){$data['msg']= '<div class="callout '.$type.'" data-closable>'.$message.'<button class="close-button" aria-label="Fermer" type="button" data-close><span aria-hidden="true">&times;</span></button></div>';}

        $this->load->view('site/header', $data);
        $this->load->view('site/menu', $data);
        $this->load->view('utilisateur/connexion', $data);
        $this->load->view('site/footer');
    }
    
    public function valid_connexion() {
        $this->form_validation->set_rules('mail', 'E-mail', 'required|callback_verify_email');
        $this->form_validation->set_rules('pass', 'Mot de passe', 'required|callback_verify_password');
        $this->form_validation->set_error_delimiters('<p class="help-text valid-error">', '</p>');

        if ($this->form_validation->run()) {
            //$mail = $this->input->post('mail');
            $ip = $this->input->ip_address();
            redirect('site/accueil', 'refresh');
        }else
            $this->connexion();
    }

    function verify_email(){   // fonction utilisée à la connexion pour vérifier si le compte existe et est actif
        $mail = $this->input->post('mail');
        if ($mail != NULL) $etat_obj = $this->utilisateur_model->get_info('etat','mail',$this->input->post('mail'));
        else $etat_obj = NULL;
        
        if ($etat_obj != NULL) $etat = $etat_obj->etat;
        else $etat = NULL;
        
        switch ($etat){
            case NULL:
                $this->form_validation->set_message('verify_email', '%s incorrect.');
                return FALSE;
            case 'validation':
                $this->form_validation->set_message('verify_email', 'Le compte lié à cet %s n\'a pas encore été activé. <a href="">Renvoyer le lien d\'activation</a>.');
                return FALSE;
            case 'actif':
                return TRUE;
            default :
                $this->form_validation->set_message('verify_email', '%s incorrect.');
                return FALSE;
        }
    }

    function verify_password(){   // fonction utilisée à la connexion pour vérifier si le mot de passe est correct
        if ($this->utilisateur_model->verify_password($this->input->post('mail'),$this->input->post('pass')))
            return TRUE;
        else{
            $this->form_validation->set_message('verify_password', '%s incorrect.');
            return FALSE;
        }
    }

}
