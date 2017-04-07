<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Format_string {
	
    // Tout en majuscule
    function format_lastname($lastname){
        return mb_strtoupper($lastname, 'UTF-8');
    }
     
    // 1ere lettre en majuscule, le reste en minuscule
    function format_firstname($firstname){
        $first_letter_upper=mb_strtoupper(mb_substr($firstname,0,1,'UTF-8'),'UTF-8');
        $else_string_lower=mb_strtolower(mb_substr($firstname,1,mb_strlen($firstname),'UTF-8'),'UTF-8');
        return $first_letter_upper.$else_string_lower;
    }
    
    // Ajoute des points tous les 2 chiffres d'un numéro de téléphone
    function format_tel($tel){
        $splitted_tel = str_split($tel, 2);
        return implode('.', $splitted_tel);
    }
    
    // N'affiche pas les nombres après la virgule s'il n'y en a pas
    function format_price($price){
        $entier = floor($price);
        if($price-$entier>0)
            return $price;
        else
            return floatval ($price);
    }
}

?>
