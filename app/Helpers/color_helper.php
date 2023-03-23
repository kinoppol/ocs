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
        'red','pink','blue','cyan','navy','teal','brown','orange','black','grey'
    );
    $n=$number%count($c);
    return $c[$n];
} 


//chatGPT function
function mapPercentageToColor($percentage) {
    // Calculate the amount of green based on the percentage
    $greenAmount = round($percentage / 100 * 255);
    
    // Determine the red and blue values
    $redAmount = 255 - $greenAmount;
    $blueAmount = 50;
    
    // Convert the RGB values to hex
    $hex = sprintf("#%02x%02x%02x", $redAmount, $greenAmount, $blueAmount);
    
    return $hex;
  }
  