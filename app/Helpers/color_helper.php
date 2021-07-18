<?php
function color($number){
    $c=array(
        'red','pink','purple','indigo','blue','teal','green','orange','brown','grey'
    );
    $n=$number%count($c);
    return $c[$n];
} 


function color2($number){
    $c=array(
        'red','pink','blue','cyan','navy','teal','orange','yellow','brown','grey'
    );
    $n=$number%count($c);
    return $c[$n];
} 