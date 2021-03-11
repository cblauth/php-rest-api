<?php

require_once("api.php");
require_once("validation.php");
require_once("helper.php");
require_once("student.php");
  
class GradeProcess implements Api {

    function __construct() {
        $this->result = [];
        $this->request = "";
        $this->counter = 0;
    }
     
    public function process(string $data) {
        
        // only accepting POST requests
        if ($_SERVER["REQUEST_METHOD"] != "POST") {
            exit("[{\"error\" : \"invalid request method\"}]");
        }  
        
        $this->request = json_decode($data);       
        if ($this->request === null && json_last_error() !== JSON_ERROR_NONE) {
            exit("[{\"error\" : \"invalid json\"}]");
        }
                     
        foreach($this->request as $elem) {
             
            $this->counter ++;
            
            // validations to ensure the structure is valid                                             
            if ((!isset($elem->name)) OR (!isset($elem->grade))) {
                exit("[{\"error\" : \"missing name or grade, element $this->counter\"}]");
            }             
            if(!(Validation::validateName($elem->name))) {
                exit("[{\"error\": \"name invalid, element $this->counter\"}]");      
            }   
            if(!(Validation::validateGrade($elem->grade))) {
                exit("[{\"error\" : \"grade invalid, element $this->counter\"}]");      
            }     
            
            // send grades to student class to be processed            
            $student = new Student; 
            $student->setName($elem->name);
            $student->setGrade($elem->grade);
            $student->passed();         
            
            $this->result[] = $student->printStudent();    
        }
        
        // output the result
        header('Content-Type: application/json'); 
        echo json_encode($this->result); 
    }
}  
  
$data = file_get_contents("php://input");
$api = new GradeProcess();
$api->process($data);

?>