<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Utilisateur_model extends CI_Model {

    protected $table = 'utilisateur';

     //Active le compte d'un utilisateur
    public function activer_compte($mail,$code){
        $user_id = $this->db->select('id')->from($this->table)
                ->where('mail',$mail)
                ->where('code_activation',$code)
                ->where('etat','validation')->limit(1,0)->get()->row();
        if (!empty($user_id)){
            $this->db->where('id',$user_id->id)->set('etat','actif')->update($this->table);
            return TRUE;
        }else
            return FALSE;
    }
    
    public function create($mail,$nom,$prenom,$pass,$ip){
        $this->load->helper('string');
        $this->load->library('format_string');
        $code_activation=random_string('alnum', 32);
        $prenomFormat = $this->format_string->format_firstname($prenom);
        $user_data = array(
            'mail'      => $mail,
            'nom'       => $this->format_string->format_lastname($nom),
            'prenom'    => $prenomFormat,
            'pass'      => $pass,
            'date_connexion' => date("Y-m-j H:i:s"),
            'date_inscription' => date("Y-m-j H:i:s"),
            'code_activation' => $code_activation,
            'etat'      => 'validation'
        );
        $this->db->insert('utilisateur', $user_data);
        $this->sendActivationMail($mail,$code_activation,$prenomFormat);
        return TRUE;
    }
    public function get_info($select,$field_name,$field_value){
         return $this->db->select($select)->from($this->table)->where($field_name,$field_value)->get()->row();
    }

    public function verify_password($mail,$pass){
        $hashpass = $this->db->select('pass')->from($this->table)->where('mail',$mail)->limit(1,0)->get()->row();
        if ($hashpass!=NULL && password_verify($pass,$hashpass->pass))
            return TRUE;
        else
            return FALSE;
    }
    
    // Envoie un mail
    public function sendMail($to, $subject, $message, $fromMail = 'no-reply@gosciences.net', $fromName = 'GoSciences.net'){
        $CI =& get_instance();
        $CI->load->library('email');
        $this->email->set_mailtype("html");
        $this->email->from($fromMail, $fromName);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);
        return $this->email->send();
    }
    
    // Envoie le mail d'activation d'un compte
    public function sendActivationMail($mail,$code,$firstname){
        $subject = 'Activation de votre compte GoSciences';
        $link = site_url('utilisateur/activation/'.urlencode($mail).'/'.urlencode($code));
        $message = '<html><body>Bonjour '.htmlspecialchars($firstname).',<br/>
                    Merci de cliquer sur le lien suivant afin de finaliser votre inscription sur '.$_SERVER['HTTP_HOST'].' :<br/>
                    <a href="'.$link.'">Lien d\'activation</a><br/><br/>
                    Ou recopiez le lien suivant dans votre navigateur :<br/>
                    '.$link.'<br/><br/>
                    Inutile de répondre à cet e-mail. En cas de problème, merci d\'utiliser <a href="'.site_url('site/contact').'">ce formulaire</a>.</body></html>';
        return $this->sendMail($mail, $subject, $message);
    }
}