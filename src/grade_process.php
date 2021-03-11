<?php

require_once("api.php");
require_once("validation.php");
require_once("helper.php");
require_once("student.php");
  
class GradeProcess implements Api {

    // using PHP 8 new contructor property
    function __construct(public $counter = 0) {
        $this->result = [];
        $this->request = "";
    }
     
    public function process(string $data) {
        
        $this->request = json_decode($data);       
        if ($this->request === null && json_last_error() !== JSON_ERROR_NONE) {
            exit("[{\"error\" : \"invalid json\"}]");
        }             
        foreach($this->request as $elem) {
             
            $counter ++;
            
            // validations to ensure the structure is valid                       
            if ((!isset($elem->name)) OR (!isset($elem->grade))) {
                exit("[{\"error\" : \"missing name or grade, element $counter\"}]");
            }             
            if(!(Validation::validateName($elem->name))) {
                exit("[{\"error\": \"name invalid, element $counter\"}]");      
            }   
            if(!(Validation::validateGrade($elem->grade))) {
                exit("[{\"error\" : \"grade invalid, element $counter\"}]");      
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
// only accepting POST requests
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    exit("[{\"error\" : \"invalid request\"}]");
}  
$api = new GradeProcess();
$api->process($data);
  
?>