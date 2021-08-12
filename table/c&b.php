<?php

$array = ['football','swimming','running','gym'];

foreach ($array as $index => $value) {
    if($value == 'swimming'){
        continue;
    }
    // echo $value .'<br>';
}

foreach ($array as $index => $value) {
    if($value == 'running'){
        break;
    }
    echo $value .'<br>';
}

?>