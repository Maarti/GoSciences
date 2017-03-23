<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
// Affiche le texte paramétré dont l'id est passé en paramètre
if ( ! function_exists('display'))
{
    function display($id_texte) {
        $texte = get_instance()->texte_model->read('corps',array('id'=>$id_texte))->row();
        if(empty($texte))
            return '';
        else
            return $texte->corps;
    }
}

?>