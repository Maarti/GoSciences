<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Utilisateur extends CI_Controller {

     public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('utilisateur_model');
        $this->data['tab_title'] = 'GoSciences - Utilisateur';
        //$this->output->enable_profiler(true);
    }
    
    public function index() {
        if(isset($_SESSION['id']))
            return redirect ('utilisateur/mon_espace', 'refresh');
        else
            return redirect ('utilisateur/inscription', 'refresh');
    }
    
    public function activation($mail_encode=null,$code_encode=null){
        $mail = urldecode($mail_encode);
        $code = urldecode($code_encode);
        if($this->utilisateur_model->activerCompte($mail,$code))
           redirect('utilisateur/connexion/activation_succes/'.$mail_encode, 'refresh');
        else
           redirect('utilisateur/connexion/activation_echec', 'refresh');
    }
    
    public function inscription() {
        $this->data['tab_title'] = 'GoSciences - Inscription';
        $this->data['page_title'] = 'Inscription';
        $this->load->view('site/header', $this->data);
        $this->load->view('site/menu', $this->data);
        $this->load->view('utilisateur/inscription', $this->data);
        $this->load->view('site/footer');
    }

    public function valid_inscription() {
        $this->form_validation->set_rules('mail', 'E-mail', 'required|valid_email|max_length[254]|is_unique[utilisateur.mail]', array('is_unique' => 'Cet %s est déjà utilisé sur le site.'));
        $this->form_validation->set_rules('civilite', 'Civilité', 'required|in_list[Mme,M.]');
        $this->form_validation->set_rules('nom', 'Nom', 'required|min_length[2]|max_length[50]|regex_match[/^([-a-z_éèàêâùïüë ])+$/i]');
        $this->form_validation->set_rules('prenom', 'Prénom', 'required|min_length[2]|max_length[50]|regex_match[/^([-a-z_éèàêâùïüë ])+$/i]');
        $this->form_validation->set_rules('pass', 'Mot de passe', 'required|min_length[3]|max_length[50]');
        $this->form_validation->set_rules('passconf', 'Confirmation', 'required|matches[pass]');
        $this->form_validation->set_error_delimiters('<p class="help-text valid-error">', '</p>');

        if ($this->form_validation->run()) {
            $mail = $this->input->post('mail');
            $nom = $this->input->post('nom');
            $prenom = $this->input->post('prenom');
            $civ = $this->input->post('civilite');
            $hashed_pass = password_hash($this->input->post('pass'), PASSWORD_DEFAULT);
            
            $this->utilisateur_model->create_utilisateur($mail, $nom, $prenom, $hashed_pass, $civ);
            redirect('utilisateur/connexion/inscription_ok', 'refresh');
        }else
            $this->inscription();
    }

    public function connexion($msg=NULL,$mail_encode=NULL) {
        $this->data['tab_title'] = 'GoSciences - Connexion';
        $this->data['page_title'] = 'Connexion';
        switch ($msg) { // Gestion des messages à afficher en page d'accueil
            case 'activation_succes':
                $type='success';
                $message='<h5>Activation réussie.</h5><p>Vous pouvez désormais vous connecter avec vos identifiants.</p>';
                break;
            case 'activation_echec':
                $type='alert';
                $message='<h5>Échec de l\'activation.</h5><p>Ce lien d\'activation ne correspond à aucun compte.<br/>Merci de contacter l\'administrateur grâce au menu "Contact" si le problème persiste.</p>';
                break;
            case 'inscription_ok':
                $type='success';
                $message='<h5>Inscription réussie.</h5><p>Vous devez maintenant activer votre compte en cliquant sur le lien qui vous a été envoyé par e-mail.</p>';
                break;
            case 'connexion_requise':
                $type='warning';
                $message='<p>Vous devez d\'abord vous connecter pour faire cela.</p>';
                break;
            case 'erreur_intervalle':
                $type='warning';
                $message='<h5>Échec de l\'envoi.</h5><p>Vous ne pouvez demander un mail d\'activation qu\'une fois toutes les 30min.</p>';
                break;
            default:
                $type=NULL;
                $message=NULL;
        } 
        if(!is_null($type)&&!is_null($message))
            $this->data['msg']= '<div class="callout '.$type.'" data-closable>'.$message.'<button class="close-button" aria-label="Fermer" type="button" data-close><span aria-hidden="true">&times;</span></button></div>';
        
        // On alimente le champ email suite à une activation de compte
        $this->data['mail'] = ($mail_encode==NULL)? '' : urldecode($mail_encode);
        
        if (!isset($_SESSION['id'])){
            $this->load->view('site/header', $this->data);
            $this->load->view('site/menu', $this->data);
            $this->load->view('utilisateur/connexion', $this->data);
            $this->load->view('site/footer');
        }else
            redirect('utilisateur/mon_espace', 'refresh');
    }
    
    public function valid_connexion() {
        $this->load->model('log_model');
        $this->form_validation->set_rules('mail', 'E-mail', 'required|valid_email|callback_verify_email');
        $this->form_validation->set_rules('pass', 'Mot de passe', 'required|callback_verify_password');
        $this->form_validation->set_error_delimiters('<p class="help-text valid-error">', '</p>');
        $mail = $this->input->post('mail');
        
        if ($this->form_validation->run()) {
            $this->log_model->create_log('connexion','Connexion réussie','Mail: '.$mail,$mail);
            $this->utilisateur_model->update(array('mail'=>$mail), array(),array('date_connexion'=>'NOW()'));
            
            // Session init
            $session_data = $this->utilisateur_model->get_session_data($mail);
            $this->session->set_userdata($session_data);
            
            redirect('utilisateur/mon_espace', 'refresh');
        }else{
            $this->log_model->create_log('connexion','Tentative de connexion échouée','Mail: '.$mail,$mail);
            $this->connexion();
        }
    }
    
    public function deconnexion() {
        session_destroy();
        redirect('utilisateur/connexion', 'refresh');
    }
        
    public function renvoi_activation($mail=null){
        if (empty($mail))
            redirect('site/accueil', 'refresh');
        else{            
            $codeRetour = $this->utilisateur_model->sendActivationMail(urldecode($mail),'renvoi');
            redirect('utilisateur/connexion/'.$codeRetour, 'refresh');
        }
    }
    
    function mon_espace(){
        if(!isset($_SESSION['id']))
            return redirect ('utilisateur/connexion/connexion_requise', 'refresh');
        
        $this->data['tab_title'] = 'GoSciences - Mon Espace';
        $this->data['page_title'] = 'Mon Espace';
        $this->load->view('site/header', $this->data);
        $this->load->view('site/menu', $this->data);
        $this->load->view('utilisateur/mon_espace', $this->data);
        $this->load->view('site/footer');
    }
    
    function infos(){
        if(!isset($_SESSION['id']))
            return redirect ('utilisateur/connexion/connexion_requise', 'refresh');
        
        $this->data['tab_title'] = 'GoSciences - Mon Compte';
        $this->data['page_title'] = 'Mon Compte';
        $this->data['user'] = $this->utilisateur_model->read('mail,nom,prenom,tel,civilite,date_naissance',array('id'=>$_SESSION['id']))->row();
        $this->data['add_jquery'] = '<script type="text/javascript">
            $("#newpass").keyup(function(){
                if($(this).val()) {$("#newpassconf").show();
                }else{
                    $("#newpassconf").hide();}
            });
        </script>';
        
        $this->load->view('site/header', $this->data);
        $this->load->view('site/menu', $this->data);
        $this->load->view('utilisateur/infos', $this->data);
        $this->load->view('site/footer');
    }
    
    public function valid_infos() {
        if(!isset($_SESSION['id']))
            return redirect ('utilisateur/connexion/connexion_requise', 'refresh');
        
        $this->form_validation->set_rules('civilite', 'Civilité', 'required|in_list[Mme,M.]');
        $this->form_validation->set_rules('nom', 'Nom', 'required|min_length[2]|max_length[50]|regex_match[/^([-a-z_éèàêâùïüë ])+$/i]');
        $this->form_validation->set_rules('prenom', 'Prénom', 'required|min_length[2]|max_length[50]|regex_match[/^([-a-z_éèàêâùïüë ])+$/i]');
        $this->form_validation->set_rules('newpass', 'Nouveau mot de passe', 'max_length[50]');
        $this->form_validation->set_rules('newpassconf', 'Confirmation', 'callback_verify_confpassword');
        $this->form_validation->set_rules('date_naissance', 'Date de naissance', 'max_length[10]');
        $this->form_validation->set_rules('tel', 'Téléphone', 'integer|exact_length[10]');
        $this->form_validation->set_error_delimiters('<p class="help-text valid-error">', '</p>');

        if ($this->form_validation->run()) {
            $this->load->library('format_string');
            $updated_fields = array(
                'civilite' => $this->input->post('civilite'),
                'nom' => $this->format_string->format_lastname($this->input->post('nom')),
                'prenom' => $this->format_string->format_firstname($this->input->post('prenom')),
                'tel' => $this->input->post('tel'),
                'date_naissance' => $this->input->post('date_naissance')
            );
            $newpass = $this->input->post('newpass');
            if(!empty($newpass))
                $updated_fields['pass'] = password_hash($newpass, PASSWORD_DEFAULT);
            $this->utilisateur_model->update(array('id'=>$_SESSION['id']),$updated_fields);
            redirect('utilisateur/mon_espace', 'refresh');
        }else
            $this->infos();
    }
    
    function verify_email(){   // fonction utilisée à la connexion pour vérifier si le compte existe et est actif
        $mail = $this->input->post('mail');
        if ($mail != NULL) $etat_obj = $this->utilisateur_model->read('etat', array('mail'=>$mail))->row();
        else $etat_obj = NULL;        
        $etat = ($etat_obj != NULL)? $etat_obj->etat : NULL;
        $link = site_url('utilisateur/renvoi_activation/'.urlencode($mail));
        switch ($etat){
            case NULL:
                $this->form_validation->set_message('verify_email', '%s incorrect.');
                return FALSE;
            case 'validation':
                $this->form_validation->set_message('verify_email', 'Le compte lié à cet email n\'a pas encore été activé. <a href="'.$link.'">Renvoyer le lien d\'activation</a>.');
                return FALSE;
            case 'actif':
                return TRUE;
            default :
                $this->form_validation->set_message('verify_email', '%s incorrect.');
                return FALSE;
        }
    }

    function verify_password(){   // fonction utilisée à la connexion pour vérifier si le mot de passe est correct
        if ($this->utilisateur_model->verifyPassword($this->input->post('mail'),$this->input->post('pass')))
            return TRUE;
        else{
            $this->form_validation->set_message('verify_password', '%s incorrect.');
            return FALSE;
        }
    }
    
    function verify_confpassword($confpass){ 
        $newpass = $this->input->post('newpass');
        if (empty($newpass) || $newpass==$confpass)
            return TRUE;
        else{
            $this->form_validation->set_message('verify_confpassword', '%s doit être identique au Mot de passe.');
            return FALSE;
        }
    }
}
