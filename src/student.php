<?php

class Student {
    public $name;
    public $grade;
    public $pass;
    // required grade to pass
    private $treshold = 35;
    
    function __construct($data) {
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
        if($this->grade < $this->treshold ) {
            $this->pass = false;
        } else {
            $this->pass = true;
        }
    }
} 
 

?>