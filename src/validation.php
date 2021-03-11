<?php

class Validation {

    static function validateName(string $name) {
        // name must be at least 2 chars long
        if(strlen($name) < 2) {
            return false; 
        } else {
            return true;
        }
    }
    
    static function validateGrade(string $grade) {      
        // grade must be an integer between 0 and 100
        if (filter_var($grade, FILTER_VALIDATE_INT, array("options" => array("min_range"=>0, "max_range"=>100))) === false) {      
            return false;
        } else {
            return true;
        }
    } 
} 

?>