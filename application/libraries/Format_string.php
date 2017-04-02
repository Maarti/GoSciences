<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Format_string {
	
    /**
     * Renvoie une chaine avec la première lettre en majuscule et le reste en minuscule
     * @param string $lastname : chaine de caractere a formater
     * @return string chaine de caractere aux format souhaité
     */
    function format_lastname($lastname){
        return mb_strtoupper($lastname, 'UTF-8');
    }

        
    function format_firstname($firstname){
        $first_letter_upper=mb_strtoupper(substr($firstname,0,1), 'UTF-8');
        $else_string_lower=mb_strtolower(substr($firstname,1), 'UTF-8');
        $formatted_string=$first_letter_upper.$else_string_lower;
        return $formatted_string;
    }
    
    function format_tel($tel){
        $splitted_tel = str_split($tel, 2);
        return implode('.', $splitted_tel);
    }
}

?>
