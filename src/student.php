<?php

class Student {
    public $name;
    public $grade;
    public $pass;
    private $treshold;
    // required grade to pass
    
    
    function __construct() {
        $this->treshold = 35;     
    }
    
    public function setName(string $name) {
        $this->name = $name;
    }
    public function setGrade(int $grade) {
        $this->grade = Helper::roundGrade($grade);
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