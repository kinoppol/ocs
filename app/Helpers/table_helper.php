<?php

function genTable($arr,$export=false,$noFoot=false){
    $class=' js-basic-example';
    if($export)$class=' js-exportable';
    $ret='';
        $ret.='<table width="100%" class="table table-bordered table-striped table-hover'.$class.' dataTable"  border="1" cellspacing="0" style="border-collapse: collapse; ">';
        if(isset($arr['caption'])){
            $ret.='<caption>
            '.$arr['caption'].'
            </caption>';
        }
        $ret.='
        <thead>
            <tr>';
            $ths='';
    foreach($arr['thead'] as $th){
        $ths.='<th>'.$th.'</th>';
    }
    $ret.=$ths.'</tr>
    </thead>';
    if(!$noFoot){
        $ret.='<tfoot>
        <tr>
        '.$ths.'
        </tr>
    </tfoot>';
    }
    $ret.='<tbody>';
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
                               