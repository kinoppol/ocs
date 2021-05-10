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

function genSignBox($data=array()){
    $signLine='.......................................';
    $nameP1=$nameP2=$nameP3='.......................................';
    $positionP1=$positionP2=$positionP3='.......................................';
    if(isset($data['nameP1'])&&$data['nameP1']!='')$nameP1=$data['nameP1'];
    if(isset($data['nameP2'])&&$data['nameP2']!='')$nameP2=$data['nameP2'];
    if(isset($data['nameP3'])&&$data['nameP3']!='')$nameP3=$data['nameP3'];
    
    if(isset($data['positionP1'])&&$data['positionP1']!='')$positionP1=$data['positionP1'];
    if(isset($data['positionP2'])&&$data['positionP2']!='')$positionP2=$data['positionP2'];
    if(isset($data['positionP3'])&&$data['positionP3']!='')$positionP3=$data['positionP3'];

    $ret='<table width="100%">
    <tr>
        <td style="text-align:center;" vlign="top">
        <br>
        '.$signLine.'<br>
        ('.$nameP1.')<br>
        '.$positionP1.'<br>&nbsp;<br>
        </td>
        <td style="text-align:center;" vlign="top">
        <br>
        '.$signLine.'<br>
        ('.$nameP2.')<br>
        '.$positionP2.'
        </td>
        <td style="text-align:center;" vlign="top">
        <br>
        '.$signLine.'<br>
        ('.$nameP3.')<br>
        '.$positionP3.'
        </td>
    </tr>
    </table>';

    return $ret;
}