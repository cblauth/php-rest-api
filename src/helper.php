<?php

class Helper {
    public static function roundGrade($grade) {
    // If the difference between the grade and the next multiple of 5 is less than 3, round grade up to the next multiple of 5
        $next_multiple = ceil($grade / 5) * 5;
        if(($next_multiple - $grade) < 3) {
            return $next_multiple;      
        } else {
            return round($grade / 5) * 5;
        }
    }
}
 
?>