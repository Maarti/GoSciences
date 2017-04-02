<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Format_string {
	
    function format_lastname($lastname){
        return mb_strtoupper($lastname, 'UTF-8');
    }
        
    function format_firstname($firstname){
        $first_letter_upper=mb_strtoupper(mb_substr($firstname,0,1,'UTF-8'),'UTF-8');
        $else_string_lower=mb_strtolower(mb_substr($firstname,1,mb_strlen($firstname),'UTF-8'),'UTF-8');
        return $first_letter_upper.$else_string_lower;
    }
    
    function format_tel($tel){
        $splitted_tel = str_split($tel, 2);
        return implode('.', $splitted_tel);
    }
}

?>
