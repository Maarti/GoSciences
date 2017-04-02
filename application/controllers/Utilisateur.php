<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Utilisateur extends CI_Controller {

     public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('utilisateur_model');
        $this->data['tab_title'] = 'GoSciences - Aide scolaire à Orléans et ses environs | Utilisateur';
        $this->data['meta_desc'] = 'GoSciences propose de l\'aide scolaire de qualité dans les matières scientifiques à Orléans, La Ferté-Saint-Aubin, La Chapelle-Saint-Mesmin, Saint-Jean-de-Braye, Saint-Jean-le-Blanc, Saint-Jean-de-la-Ruelle, Olivet, Saran, Lamotte-Beuvron, Vouzon, Marcilly-en-Villette, Menestreau-en-Villette, Saint-Cyr-en-Val, Ligny-le-Ribault, Jouy-le-Potier.';
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
        $this->data['tab_title'] = 'GoSciences - Aide scolaire à Orléans et ses environs | Inscription';
        $this->data['meta_desc'] = 'Inscrivez-vous au site GoSciences pour bénéficier de suivis pour les cours particuliers de votre enfant.';
        $this->data['page_title'] = 'Inscription';
        $this->data['public_recaptcha'] = $this->config->item('public_recaptcha');
        $this->data['header_include'][0] = '<script src="https://www.google.com/recaptcha/api.js"></script>';
        $this->load->view('site/header', $this->data);
        $this->load->view('site/menu', $this->data);
        $this->load->view('utilisateur/inscription', $this->data);
        $this->load->view('site/footer');
    }

    public function valid_inscription() {
        $this->form_validation->set_rules('mail', 'E-mail', 'required|valid_email|max_length[254]|is_unique[utilisateur.mail]', array('is_unique' => 'Cet %s est déjà utilisé sur le site.'));
        $this->form_validation->set_rules('civilite', 'Civilité', 'required|in_list[Mme,M.]');
        $this->form_validation->set_rules('nom', 'Nom', 'required|min_length[2]|max_length[50]|regex_match[/^([-a-z_éèàêâùïüëÉÈÀÊÙÏÜË ])+$/i]');
        $this->form_validation->set_rules('prenom', 'Prénom', 'required|min_length[2]|max_length[50]|regex_match[/^([-a-z_éèàêâùïüëÉÈÀÊÙÏÜË ])+$/i]');
        $this->form_validation->set_rules('pass', 'Mot de passe', 'required|min_length[3]|max_length[50]');
        $this->form_validation->set_rules('passconf', 'Confirmation', 'required|matches[pass]');
        $this->form_validation->set_rules('g-recaptcha-response','Captcha','callback_recaptcha');
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
        $this->data['tab_title'] = 'GoSciences - Aide scolaire à Orléans et ses environs | Connexion';
        $this->data['meta_desc'] = 'Connectez-vous à GoSciences et définissez vos disponibilités pour pouvoir disposer de soutien scolaire aux horaires qui vous conviennent.';
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
                $message='<h5>Connexion requise.</h5><p>Vous devez d\'abord vous connecter pour faire cela.</p>';
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
        
        $this->data['tab_title'] = 'GoSciences - Aide scolaire à Orléans et ses environs | Mon espace';
        $this->data['meta_desc'] = 'Depuis votre espace : accédez aux suivis de votre enfant, porposez vos disponibilités pour les prochains cours ou réservez une prestation.';        
        $this->data['page_title'] = 'Mon Espace';
        $this->load->view('site/header', $this->data);
        $this->load->view('site/menu', $this->data);
        $this->load->view('utilisateur/mon_espace', $this->data);
        $this->load->view('site/footer');
    }
    
    function infos(){
        if(!isset($_SESSION['id']))
            return redirect ('utilisateur/connexion/connexion_requise', 'refresh');
        
        $this->load->model('eleve_model');
        $this->data['tab_title'] = 'GoSciences - Aide scolaire à Orléans et ses environs | Mon compte';
        $this->data['meta_desc'] = 'Modifiez les informations de votre compte GoSciences, celles-ci sont strictement confidentielles.';
        $this->data['page_title'] = 'Mon Compte';
        $this->data['user'] = $this->utilisateur_model->read('mail,nom,prenom,tel,civilite,date_naissance',array('id'=>$_SESSION['id']))->row();
        $this->data['footer_include'][0] = '<script src="'.js_url('scripts/confpassword').'"></script>';
        $this->data['classes'] = $this->classe_model->read('id,libelle',array(),null,null,'ordre ASC')->result();
        $this->data['eleves'] = $this->eleve_model->read('id,nom,prenom,classe',array('parent'=>$_SESSION['id']))->result();
        
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
    
    public function ajouter_eleve() {
        if(!isset($_SESSION['id']))
            return redirect ('utilisateur/connexion/connexion_requise', 'refresh');
        
        $this->load->model('eleve_model');
        $this->load->library('format_string');
        $this->form_validation->set_rules('nom', 'Nom', 'required|min_length[2]|max_length[50]|regex_match[/^([-a-z_éèàêâùïüëÉÈÀÊÙÏÜË ])+$/i]');
        $this->form_validation->set_rules('prenom', 'Prénom', 'required|min_length[2]|max_length[50]|regex_match[/^([-a-z_éèàêâùïüëÉÈÀÊÙÏÜË ])+$/i]');
        $this->form_validation->set_rules('classe', 'Classe', 'required');
        $this->form_validation->set_error_delimiters('<p class="help-text valid-error">', '</p>');

        if ($this->form_validation->run()) {
            $nom = $this->format_string->format_lastname($this->input->post('nom'));
            $prenom = $this->format_string->format_firstname($this->input->post('prenom'));
            $this->eleve_model->create(array(
                'nom'       => $nom,
                'prenom'    => $prenom,
                'classe'    => $this->input->post('classe'),
                'parent'    => $_SESSION['id']
            ));
            redirect('utilisateur/infos', 'refresh');
        }else
            $this->infos();
    }
    
        public function modifier_eleve() {
        if(!isset($_SESSION['id']))
            return redirect ('utilisateur/connexion/connexion_requise', 'refresh');
        
        $this->load->model('eleve_model');
        $this->form_validation->set_rules('classe', 'Classe', 'required');
        $this->form_validation->set_error_delimiters('<p class="help-text valid-error">', '</p>');

        if ($this->form_validation->run()) {
            $this->eleve_model->update(array(
                'id'        => $this->input->post('id'),                
                'parent'    => $_SESSION['id']
            ),array('classe' => $this->input->post('classe')));
            redirect('utilisateur/infos', 'refresh');
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
    
    public function recaptcha($str='') {
        $google_url="https://www.google.com/recaptcha/api/siteverify";
        $ip=$_SERVER['REMOTE_ADDR'];
        $url=$google_url."?secret=".$this->config->item('private_recaptcha')."&response=".$str."&remoteip=".$ip;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT, 10);
        curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.16) Gecko/20110319 Firefox/3.6.16");
        $res_exec = curl_exec($curl);
        curl_close($curl);
        $res= json_decode($res_exec, true);
        if($res['success'])
          return TRUE;
        else {
          $this->form_validation->set_message('recaptcha', 'Le captcha vous a détecté comme étant un robot.');
          return FALSE;
        }
    }
}
