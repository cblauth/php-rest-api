<?php

class Validation {

    static function validateName($name) {
        if(strlen($name) < 2) {
            return false; 
        } else {
            return true;
        }
    }
    
    static function validateGrade($grade) {
        if($grade == "0") {
            return true;
        }
        if (filter_var($grade, FILTER_VALIDATE_INT, array("options" => array("min_range"=>0, "max_range"=>100))) === false) {      
            return false;
        } else {
            return true;
        }
    } 
} 

?>