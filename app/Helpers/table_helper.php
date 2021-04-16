<?php

function genTable($arr){
    $ret='';
        $ret.='<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
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
                               