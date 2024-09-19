<?php
function Multiplo($num) {
    if ($num % 5 == 0 && $num % 7 == 0) {
        return true; 
    } else {
        return false; 
    }
}
?>