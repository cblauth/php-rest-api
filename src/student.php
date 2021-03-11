<?php

class Student {
    public $name;
    public $grade;
    public $pass;
    
    public function __construct($data) {
        $this->name = $data->name;
        $this->grade = Helper::roundGrade($data->grade);        
        $this->passed();     
    }
    
    public function getName() {
        return $this->name;
    }
    public function getGrade() {
        return $this->grade;
    }  
    public function printStudent() {
         return $this;   
    }
    public function passed() {
         if($this->grade < 35 ) {
            $this->pass = false;
         } else {
            $this->pass = true;
         }
    }
} 
 

?>