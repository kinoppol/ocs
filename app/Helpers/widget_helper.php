<?php
function genWidget($data){
    $ret='';
    if(is_marray($data)){
        foreach($data as $row){
            $ret.=genWidget($row);
        }
    }else{
    $ret='<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box hover-zoom-effect bg-'.($data['color']==''?'blue':$data['color']).' hover-expand-effect">
                    <div class="icon">
                            <i class="material-icons">'.$data['icon'].'</i>
                        </div>
                        <div class="content">
                            <div class="text">'.$data['text'].'</div>
                            <div class="number count-to" data-from="0" data-to="'.$data['number'].'" data-speed="2000" data-fresh-interval="1"></div>
                        </div>
                    </div>
                </div>';
    }
    if(isset($data['url']))$ret='<a href="'.$data['url'].'">'.$ret.'</a>';
    return $ret;
}

function is_marray($array){
    if (count($array) == count($array, COUNT_RECURSIVE)){
        return false;
    }
    else{
        return true;
    }
}