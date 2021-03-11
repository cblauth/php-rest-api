<?php


class UnitTest {

    public function __construct() {

        $this->url = "http://localhost/api/src/grade_process.php";
        $this->ch = curl_init($this->url);
        curl_setopt($this->ch, CURLOPT_POST, 1);     
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, 1);  
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true );  
    }

    public function grades_test() {
        $i = 0;
        $status = "error";
        $payload = '[
            { "name": "John", "grade": 53 },
            { "name": "Jane", "grade": 68 },
            { "name": "Emma", "grade": 32 },
            { "name": "Sophia", "grade": 39 }
        ]';
        $expected_result = json_decode('[
            { "name": "John", "grade": 54, "pass": true },
            { "name": "Jane", "grade": 70, "pass": true },
            { "name": "Emma", "grade": 30, "pass": false },
            { "name": "Sophia", "grade": 40, "pass": true }
        ]', TRUE);
        
        
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, $payload );
          
        $output = curl_exec($this->ch);
        
        if($output === false) {
            echo 'Connection error: ' . curl_error($this->ch);
            exit();
        }
        
        echo "Output: \n$output\n\n";
       
        $result = json_decode($output, TRUE);
        if ($result === null && json_last_error() !== JSON_ERROR_NONE) {
            echo "\nJson error\n";
            exit();
        }    
        foreach($result as $r) {
            if($r['grade'] != $expected_result[$i]['grade']) {
                echo "\nGrade error for {$r['name']}. Expected: {$expected_result[$i]['grade']}, found {$r['grade']}\n";
            }  else {
                echo "\nGrade correct for {$r['name']}. Expected: {$expected_result[$i]['grade']}, found {$r['grade']}\n";
            }
            if($r['pass'] != $expected_result[$i]['pass']) {
                echo "Pass error for {$r['name']}. Expected: {$expected_result[$i]['pass']}, found {$r['pass']}\n";
            }   else {
                echo "Pass correct for {$r['name']}. Expected: {$expected_result[$i]['pass']}, found {$r['pass']}\n";
            }
            $i++;  
        }
        
       
        
        curl_close($this->ch);
                
    }
}    

$test = new UnitTest;
$test->grades_test();


?>