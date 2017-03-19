<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Utilisateur_model extends MY_Model {

   protected $table = 'utilisateur';
   protected $table_role_util = 'utilisateur_has_role';
 
    // Active le compte d'un utilisateur
    public function activerCompte($mail,$code){
        $CI =& get_instance();
        $CI->load->model('log_model');
        $user_id = $this->read('id',
                array(  'mail'              =>$mail,
                        'code_activation'   =>$code,
                        'etat'              =>'validation'), 1, 0,'id DESC')->row();
        if (!empty($user_id)){
            $this->update(array('id'=>$user_id->id), array('etat'=>'actif'));
            $CI->log_model->create_log('compte','Activation du compte','Mail: '.$mail,$mail);
            return TRUE;
        }else
            return FALSE;
    }
    
    public function create_utilisateur($mail,$nom,$prenom,$hashed_pass){
        $CI =& get_instance();
        $CI->load->model('log_model');
        $this->load->helper('string');
        $this->load->library('format_string');
        $code_activation=random_string('alnum', 32);
        $prenomFormat = $this->format_string->format_firstname($prenom);
        $nomFormat = $this->format_string->format_lastname($nom);
        $options_echappees = array(
            'mail'              => $mail,
            'nom'               => $nomFormat,
            'prenom'            => $prenomFormat,
            'pass'              => $hashed_pass,
            'code_activation'   => $code_activation,
            'etat'              => 'validation'
        );
        $options_non_echappees = array(            
            'date_connexion'    => 'NOW()',
            'date_inscription'  => 'NOW()'
        );
        $return = $this->create($options_echappees, $options_non_echappees);
        $CI->log_model->create_log('compte','Création de compte','Nom: '.$nomFormat.' Prenom: '.$prenomFormat.' Mail: '.$mail,$mail);
        $this->sendActivationMail($mail,'first');
        return $return;
    }
    
    public function get_session_data($mail){
        $session_data = $this->read('id,nom,prenom', array('utilisateur.mail'=>$mail), 1, 0)->row_array();
        
        // On récupère les rôles de l'utilisateur
        $roles_array = array();
        $role_query = $this->db->select('role_id')->from($this->table_role_util)->where('utilisateur_id',$session_data['id'])->get();        
        foreach ($role_query->result() as $role)
            array_push($roles_array, $role->role_id);        
        $session_data['roles'] = $roles_array;
        
        return $session_data;        
    }
    
     // Envoie le mail d'activation d'un compte
    public function sendActivationMail($mail,$type='first'){
        $result = $this->read('date_connexion,prenom,code_activation',array('mail'=>$mail))->row();
        $interval = strtotime(date("Y-m-j H:i:s")) - strtotime($result->date_connexion);
        if ($type=='first' || $interval<0 || $interval >(60*30) ){    // On doit patienter 30min avant de renvoyer un mail d'activation        
            $subject = 'Activation de votre compte GoSciences';
            $link = site_url('utilisateur/activation/'.urlencode($mail).'/'.urlencode($result->code_activation));
            $message = '<html><body>Bonjour '.htmlspecialchars($result->prenom).',<br/>'
                        .'Merci de cliquer sur le lien suivant afin de finaliser votre inscription sur '.$_SERVER['HTTP_HOST'].' :<br/>'
                        .'<a href="'.$link.'">Lien d\'activation</a><br/><br/>'
                        .'Ou recopiez le lien suivant dans votre navigateur :<br/>'
                        .$link.'<br/><br/>'.
                        'Inutile de répondre à cet e-mail. En cas de problème, merci d\'utiliser <a href="'.site_url('site/contact').'">ce formulaire</a>.</body></html>';
            $this->update(array('mail'=>$mail), array(),array('date_connexion'=>'NOW()'));
            return $this->sendMail($mail, $subject, $message);        
        }else{
            return 'erreur_intervalle';
        }
    }
    
    // Envoie un mail
    public function sendMail($to, $subject, $message, $fromMail = 'no-reply@gosciences.net', $fromName = 'GoSciences.fr'){
        $CI =& get_instance();
        $CI->load->library('email');
        $CI->load->model('log_model');
        $this->email->set_mailtype("html");
        $this->email->from($fromMail, $fromName);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);
        $log_user = ($fromMail=='no-reply@gosciences.net')? $to : $fromMail;
        $CI->log_model->create_log('mail','Envoi de mail',
'To: '.$to.' 
Subject: '.$subject.'
Msg: '.$message,$log_user);
        return $this->email->send();
    }
    
    public function verifyPassword($mail,$pass){
        $hashpass = $this->read('pass',array('mail'=>$mail),1,0)->row();
        if ($hashpass!=NULL && password_verify($pass,$hashpass->pass))
            return TRUE;
        else
            return FALSE;
    }
    
   
}