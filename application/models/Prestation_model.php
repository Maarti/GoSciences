<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Prestation_model extends MY_Model {

   protected $table = 'prestation';
   protected $table_type_prest = 'type_prestation';
   protected $table_classe = 'classe';
   protected $table_eleve = 'eleve';
   protected $table_utilisateur = 'utilisateur';
 
   // Retourne toutes les prestations d'un utilisateur
   public function get_array($user_id=null,$where=array()){
        $this->db->select($this->table.'.id,DATE_FORMAT(date_creation,\'%d/%m/%Y\') as date_creation,etat,libelle,nom,prenom')
            ->from($this->table)
            ->join($this->table_type_prest,$this->table_type_prest.'.id = '.$this->table.'.type_prestation_id')
            ->join($this->table_eleve,$this->table_eleve.'.id = '.$this->table.'.eleve_id');
        if ($user_id!=null)
            $this->db->where($this->table_eleve.'.parent',$user_id);
        return $this->db->where($where)
            ->order_by($this->table.'.date_creation DESC')
            ->get();
   }
   
   // Retourne les infos détaillées d'une prestation
   public function get_infos($id_prest){
        return $this->db->select($this->table.'.id,nb_heure,DATE_FORMAT(date_creation,\'%d/%m/%Y\') as date_creation,'
                . $this->table.'.etat,disciplines,disponibilite,commentaire,'.$this->table_type_prest.'.libelle as prest_libel,'.$this->table_eleve.'.nom as nom_eleve,'
                . $this->table_eleve.'.prenom as prenom_eleve, '.$this->table_utilisateur.'.nom as nom_parent,'
                . $this->table_utilisateur.'.prenom as prenom_parent, mail, civilite, tel, cp, ville, adresse,'
                . $this->table_classe.'.libelle as classe_libel')
            ->from($this->table)
            ->join($this->table_type_prest,$this->table_type_prest.'.id = '.$this->table.'.type_prestation_id')
            ->join($this->table_eleve,$this->table_eleve.'.id = '.$this->table.'.eleve_id')
            ->join($this->table_utilisateur,$this->table_eleve.'.parent = '.$this->table_utilisateur.'.id')
            ->join($this->table_classe,$this->table_classe.'.id = '.$this->table.'.classe_id')
            ->where($this->table.'.id',$id_prest)
            ->get();
   }
}