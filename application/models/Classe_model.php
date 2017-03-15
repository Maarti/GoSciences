<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Classe_model extends MY_Model {

   protected $table = 'classe';
   protected $table_etab = 'etablissement';
   protected $table_disc = 'discipline';
   protected $table_classe_disc = 'classe_discipline';
   protected $table_prest = 'prestation';
   protected $table_tarif = 'tarif';
      
   // Retourne toutes les classes et établissments (utilisé pour le menu "Nos offres")
   public function get_array(){
       $etab_array = $this->db->select('id,libelle')->from($this->table_etab)->get()->result_array();
       
        foreach ($etab_array as $key => $etab) {
            $classes_array = $this->read('id,libelle', array('etablissement_id'=>$etab['id']), 20, 0, 'ordre ASC')->result_array();
            $etab_array[$key]['classes'] = $classes_array;
        }
        return $etab_array;
   }
   
   // Retourne toutes les matières d'une classe et leur description
   public function get_matiere_from_class($id_classe){
       return $this->db->select($this->table_disc.'.id, '.$this->table_disc.'.libelle, '.$this->table_classe_disc.'.description')
               ->from($this->table_classe_disc)
               ->join($this->table_disc,$this->table_disc.'.id = '.$this->table_classe_disc.'.discipline_id')
               ->join($this->table,$this->table.'.id = '.$this->table_classe_disc.'.classe_id')
               ->where($this->table.'.id',$id_classe)
               ->order_by($this->table_disc.'.libelle ASC')
               ->get();
   }
   
   // Retourne tous les tarifs d'une prestation et la description de leurs matières
   public function get_tarifs($id_prest){
       return $this->db->select(
               $this->table_tarif.'.classe_id,'
               .$this->table.'.libelle,'
               .$this->table_tarif.'.tarif_brut,'
               .$this->table_tarif.'.tarif_remise,'
               .$this->table_tarif.'.unite_remise,'
               .$this->table_tarif.'.nb_seance,'
               .$this->table_tarif.'.duree_seance,'
               .'GROUP_CONCAT('.$this->table_classe_disc.'.description  SEPARATOR ", ") as description')
               ->from($this->table_tarif)
               ->join($this->table,$this->table.'.id = '.$this->table_tarif.'.classe_id')
               ->join($this->table_classe_disc,$this->table.'.id = '.$this->table_classe_disc.'.classe_id')
               ->where($this->table_tarif.'.prestation_id',$id_prest)
               ->group_by($this->table.'.id')
               ->order_by($this->table.'.ordre ASC')
               ->get()->result_array();
   }
   
   // Retourne toutes les prestations (utilisé pour le menu "Tarifs")
   public function get_prestations(){
       return $this->db->select('id,libelle')->from($this->table_prest)->order_by('id ASC')->get()->result_array();
   }

}