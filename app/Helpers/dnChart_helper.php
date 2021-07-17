<?php

function dn_gen_data($dn_data){
    $ret='';
    foreach($dn_data as $row){
        if($ret!='')$ret.=',';
        $ret.="{
            label: '".$row['label']."',
            value: '".number_format($row['percent'],2)."'
        }";

    }
    return $ret;
}

function dn_gen_color($dn_data){
    $ret='';
    foreach($dn_data as $row){
        if($ret!='')$ret.=',';
        $ret.="'".$row['color']."'";
    }
    return $ret;
}