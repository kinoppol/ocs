<?php
function color($number){
    $c=array(
        'red','pink','purple','indigo','blue','teal','green','orange','brown','grey'
    );
    $n=$number%count($c);
    return $c[$n];
} 