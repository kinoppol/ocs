<?php

function genTable($arr,$export=false){
    $class=' js-basic-example';
    if($export)$class=' js-exportable';
    $ret='';
        $ret.='<table class="table table-bordered table-striped table-hover'.$class.' dataTable">
        <thead>
            <tr>';
            $ths='';
    foreach($arr['thead'] as $th){
        $ths.='<th>'.$th.'</th>';
    }
    $ret.=$ths.'</tr>
    </thead>
    <tfoot>
        <tr>
        '.$ths.'
        </tr>
    </tfoot>
    <tbody>';
    $trs='';
    foreach($arr['tbody'] as $row){
        $trs.='<tr>';
        foreach($row as $td){
            $trs.='<td>'.$td.'</td>';
        }
        $trs.='</tr>';
    }
    $ret.=$trs.'</tbody>
    </table>';
    return $ret;
}
                               