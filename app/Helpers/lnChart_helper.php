<?php

function ln_gen_data($data){
    $ret='';
        foreach($data['data'] as $row){
            if($ret!='')$ret.=',';
            $r='';
            foreach($row as $k=>$v){
                if($r!='')$r.=',';
                    $r.=$k.':"'.$v.'"';
            }
            $ret.='{'.$r.'}';
        }

    return $ret;

}



function ln_gen_param($data,$lineWidth=3){
    $color='';
    foreach($data['color'] as $c){
        if($color!='')$color.=',';
        $color.="'".$c."'";
    }
    $label='';
    foreach($data['label'] as $l){
        if($label!='')$label.=',';
        $label.="'".$l."'";
    }
    $first_set=array_shift($data['data']);
    $keys=array();
    foreach($first_set as $k=>$v){
        $keys[]=$k;
    }
    $xkey=array_shift($keys);

    $ykey='';
    foreach($keys as $k){
        if($ykey!='')$ykey.=',';
        $ykey.="'".$k."'";
    }

    $ret="xkey: '".$xkey."',
    ykeys: [".$ykey."],
    labels: [".$label."],
    lineColors: [".$color."],
    lineWidth: ".$lineWidth;

    return $ret;

}