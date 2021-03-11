<?php

class UnitTest {

    function __construct() {

        $this->url = "http://localhost/grade_process.php";
        $this->url = "http://localhost/api/src/grade_process.php";
        $this->ch = curl_init($this->url);
        curl_setopt($this->ch, CURLOPT_POST, 1);     
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, 1);  
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true );  
    }

    public function grades_test($payload, $expected_result) {
        $expected_result = json_decode($expected_result, TRUE);
        $i = 0;
        $status = "Success";      
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, $payload );          
        $output = curl_exec($this->ch);
        curl_close($this->ch);
        if($output === false) {
            echo 'Connection error: ' . curl_error($this->ch);
            exit();
        }
        
        echo "Output: \n$output\n\n";
       
        $result = json_decode($output, TRUE);
        if ($result === null && json_last_error() !== JSON_ERROR_NONE) {
            echo "\nJson error, fail\n";
            exit();
        }    
        foreach($result as $r) {
            if($r['grade'] != $expected_result[$i]['grade']) {
                echo "\nGrade error for {$r['name']}. Expected: {$expected_result[$i]['grade']}, found {$r['grade']}\n";
                $status = "Fail";
            }  else {
                echo "\nGrade correct for {$r['name']}. Expected: {$expected_result[$i]['grade']}, found {$r['grade']}\n";
            }
            if($r['pass'] != $expected_result[$i]['pass']) {
                echo "Pass error for {$r['name']}. Expected: {$expected_result[$i]['pass']}, found {$r['pass']}\n";
                $status = "Fail";
            }   else {
                echo "Pass correct for {$r['name']}. Expected: {$expected_result[$i]['pass']}, found {$r['pass']}\n";         
            }
            $i++;  
        }
        echo "\nTEST RESULT: $status\n";                
    }
}    

$test = new UnitTest;
$payload = '[
            { "name": "John", "grade": 53 },
            { "name": "Jane", "grade": 68 },
            { "name": "Emma", "grade": 32 },
            { "name": "Sophia", "grade": 39 }
        ]';
$expected_result =  '[
            { "name": "John", "grade": 55, "pass": true },
            { "name": "Jane", "grade": 70, "pass": true },
            { "name": "Emma", "grade": 30, "pass": false },
            { "name": "Sophia", "grade": 40, "pass": true }
        ]';       

$test->grades_test($payload, $expected_result);


?>