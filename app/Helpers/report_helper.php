<?php

function filterSelectYear($id,$MAXY=false,$MINY=false,$def=false){
    if(!$MAXY)$MAXY=date('Y')+1;
    if(!$MINY)$MINY=date('Y')-5;
    $ret='<select id="'.$id.'" name="'.$id.'" class="form-control">';

$option='';
    for($i=$MAXY;$i>$MINY;$i--){
        $select='';
        if($def==$i)$select=' selected';
        $option.='<option value="'.$i.'"'.$select.'>'.($i+543).'</option>
        ';
    }
    

$ret.=$option.'</select>  ';

return $ret;
}