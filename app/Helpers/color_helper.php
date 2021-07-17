<?php
function color($number){
    $c=array(
        'red','pink','purple','indigo','blue','cyan','teal','green','lime','yellow','orange','brown','grey'
    );
    $n=$number%count($c);
    return $c[$n];
} 