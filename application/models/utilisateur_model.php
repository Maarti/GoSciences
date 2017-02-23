<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Utilisateur_model extends CI_Model {

    protected $table = 'utilisateur';

    public function create($mail,$nom,$prenom,$pass,$ip){
        $this->load->helper('string');
        $code_activation=random_string('alnum', 32);
        $user_data = array(
            'mail'      => $mail,
            'nom'       => $nom,
            'prenom'    => $prenom,
            'pass'      => $pass,
            //'ip'        => $ip
            'date_connexion' => date("Y-m-j H:i:s"),
            'date_inscription' => date("Y-m-j H:i:s"),
            'code_activation' => $code_activation,
            'etat'      => 'validation'
        );
        return $this->db->insert('utilisateur', $user_data);
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
}