<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Utilisateur_model extends MY_Model {

    protected $table = 'utilisateur';

    // Active le compte d'un utilisateur
    public function activerCompte($mail,$code){
        $CI =& get_instance();
        $CI->load->model('log_model');
        $user_id = $this->read('id',
                array(  'mail'              =>$mail,
                        'code_activation'   =>$code,
                        'etat'              =>'validation'), 1, 0,'id DESC')->row();
            var_dump($user_id);
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
        $nomFormat = $this->format_string->format_firstname($nom);
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
    
    /*public function getInfo($select,$field_name,$field_value){
        // exemple : $this->utilisateur_model->getInfo('etat','mail',$this->input->post('mail'));
        return $this->db->select($select)->from($this->table)->where($field_name,$field_value)->get()->row();
    }*/
    
     // Envoie le mail d'activation d'un compte
    public function sendActivationMail($mail,$type='first'){
        //$result = $this->db->select('date_connexion,prenom,code_activation')->from($this->table)->where('mail',$mail)->get()->row();
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
    public function sendMail($to, $subject, $message, $fromMail = 'no-reply@gosciences.net', $fromName = 'GoSciences.net'){
        $CI =& get_instance();
        $CI->load->library('email');
        $CI->load->model('log_model');
        $this->email->set_mailtype("html");
        $this->email->from($fromMail, $fromName);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);
        $CI->log_model->create_log('mail','Envoi de mail',
'To: '.$to.' 
Subject: '.$subject.'
Msg: '.$message,$to);
        return $this->email->send();
    }
    
    /*public function update($where, $options_echappees = array(), $options_non_echappees = array()){		
	if(empty($options_echappees) AND empty($options_non_echappees))
            return false;

	if(is_integer($where))
            $where = array('id' => $where);

	return (bool) $this->db->set($options_echappees)
                               ->set($options_non_echappees, null, false)
                               ->where($where)
                               ->update($this->table);
    }*/
    
    public function verifyPassword($mail,$pass){
        //$hashpass = $this->db->select('pass')->from($this->table)->where('mail',$mail)->limit(1,0)->get()->row();
        $hashpass = $this->read('pass',array('mail'=>$mail),1,0)->row();
        if ($hashpass!=NULL && password_verify($pass,$hashpass->pass))
            return TRUE;
        else
            return FALSE;
    }
    
   
}