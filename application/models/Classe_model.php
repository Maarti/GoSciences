<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Classe_model extends MY_Model {

   protected $table = 'classe';
   protected $table_etab = 'etablissement';
   protected $table_disc = 'discipline';
   protected $table_classe_disc = 'classe_discipline';
   protected $table_prest = 'type_prestation';
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
       return $this->db->select($this->table_disc.'.id, '.$this->table_disc.'.libelle, '.$this->table_classe_disc.'.description_longue')
               ->from($this->table_classe_disc)
               ->join($this->table_disc,$this->table_disc.'.id = '.$this->table_classe_disc.'.discipline_id')
               ->join($this->table,$this->table.'.id = '.$this->table_classe_disc.'.classe_id')
               ->where($this->table.'.id',$id_classe)
               ->where($this->table_classe_disc.'.description_longue !=','')
               ->order_by($this->table_disc.'.libelle ASC')
               ->get();
   }
   
   // Retourne tous les tarifs d'une prestation et la description de leurs matières
   public function get_tarifs($id_prest){
       // Nécessaire pour augmenter la taille de la concatenation sql
       $this->db->query('SET SESSION group_concat_max_len=2048');
       
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
               ->where($this->table_classe_disc.'.description !=','')
               ->group_by($this->table.'.id')
               ->order_by($this->table.'.ordre ASC')
               ->get()->result_array();
   }
   
   // Retourne toutes les prestations (utilisé pour le menu "Tarifs")
   public function get_prestations(){
       return $this->db->select('id,libelle')->from($this->table_prest)->order_by('ordre ASC')->get()->result_array();
   }
   
   // Retourne les infos de chaque disciplines / classes
   public function get_all_classe_disciplines(){
       $classes = $this->classe_model->read('id,libelle',array(),null,null,'ordre ASC')->result_array();
       foreach ($classes as $key => $c) {
            $classe_disc_array = $this->db->select(
                    $this->table_classe_disc.'.description,'
                    .$this->table_classe_disc.'.description_longue,'
                    .$this->table_disc.'.id,'
                    .$this->table_disc.'.libelle')
               ->from($this->table_classe_disc)
               ->join($this->table_disc,$this->table_disc.'.id = '.$this->table_classe_disc.'.discipline_id')
               ->where($this->table_classe_disc.'.classe_id',$c['id'])
               ->get()->result_array();
            $classes[$key]['disc'] = $classe_disc_array;
        }
        return $classes;          
   }

}