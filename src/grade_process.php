<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);  

require_once("validation.php");
require_once("helper.php");
require_once("student.php");
  
class Api {
     
    public function grade_process($data) {
        
        $this->result = [];
        $this->counter = 0;
        $this->request = json_decode($data);
        
        if ($this->request === null && json_last_error() !== JSON_ERROR_NONE) {
           exit("invalid json");
        }             
        foreach($this->request as $elem) {
             
            $this->counter ++;
            if ((!isset($elem->name)) OR (!isset($elem->grade))) {
                exit("missing name or grade element $this->counter");
            }
             
            if(!(Validation::validateName($elem->name))) {
               exit("name invalid element $this->counter");      
            }   
            if(!(Validation::validateGrade($elem->grade))) {
               exit("grade invalid element $this->counter");      
            }     
                          
            $student = new Student($elem);            
            $this->result[] = $student->printStudent();    
        }
        header('Content-Type: application/json'); 
        echo json_encode($this->result); 
    }
}  
  
$data = file_get_contents("php://input");
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    exit("invalid requetst");
}  
$api = new Api;
$api->grade_process($data);
  
?>