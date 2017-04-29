<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Prestation_model extends MY_Model {

   protected $table = 'prestation';
   protected $table_type_prest = 'type_prestation';
   protected $table_eleve = 'eleve';
 
   // Retourne toutes les prestations d'un utilisateur
   public function get_array($user_id,$where=array()){
       return $this->db->select($this->table.'.id,DATE_FORMAT(date_creation,\'%d/%m/%Y\') as date_creation,etat,libelle,nom,prenom')
            ->from($this->table)
            ->join($this->table_type_prest,$this->table_type_prest.'.id = '.$this->table.'.type_prestation_id')
            ->join($this->table_eleve,$this->table_eleve.'.id = '.$this->table.'.eleve_id')
            ->where($this->table_eleve.'.parent',$user_id)
            ->where($where)
            ->order_by($this->table.'.date_creation DESC')
            ->get();
   }
}