<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Eleve_model extends MY_Model {

    protected $table = 'eleve';
   
    // Vérifie si l'id d'élève appartient au compte connecté
    public function belong_to_user($eleve_id) {
        $eleve = $this->read('parent',array('id'=>$eleve_id))->row();
        var_dump($_SESSION['id']);
        return (!empty($eleve) && isset($_SESSION['id']) && $eleve->parent == $_SESSION['id']);
    }
}