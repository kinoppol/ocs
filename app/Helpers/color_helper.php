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
function mapPercentageToGreen($percentage) {
    // Clamp percentage value between 0 and 100
    $percentage = max(0, min(100, $percentage));
  
    // Calculate red, green, and blue values based on percentage
    $red = 255 - floor($percentage / 100 * (255 - 50));
    $green = 255 - floor($percentage / 100 * (255 - 229));
    $blue = 255 - floor($percentage / 100 * (255 - 50));
  
    // Convert red, green, and blue values to hexcode
    $hexcode = sprintf("#%02x%02x%02x", $red, $green, $blue);
  
    return $hexcode;
  }
  