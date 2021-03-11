<?php

class Helper {
    public static function roundGrade($grade) {
        $next_multiple = ceil($grade / 5) * 5;
            if($next_multiple - $grade < 3) {
            return $next_multiple;      
        } else {
            return round($grade / 5) * 5;
        }
    }
}
 
?>