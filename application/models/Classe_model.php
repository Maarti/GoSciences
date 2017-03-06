<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Classe_model extends MY_Model {

   protected $table = 'classe';
   protected $table_etab = 'etablissement';
   
   // Retourne toutes les classes et établissments (utilisé pour le menu "Nos offres")
   public function get_array(){
       $etab_array = $this->db->select('id,libelle')->from($this->table_etab)->get()->result_array();
       
        foreach ($etab_array as $key => $etab) {
            $classes_array = $this->read('id,libelle', array('etablissement_id'=>$etab['id']), 20, 0, 'ordre ASC')->result_array();
            $etab_array[$key]['classes'] = $classes_array;
        }
        return $etab_array;
   }

}