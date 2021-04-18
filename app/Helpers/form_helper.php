<?php
helper('array');

function genForm($data){
    $ret='<div class="card">
    <div class="header">
        <h2>
            '.$data['formName'].'
        </h2>
        <div class="body">
                            <form action="'.$data['action'].'" method="'.$data['method'].'">'.
                            genInput($data['inputs'])
                            .'</form>
                            </div>
                            </div>';

    return $ret;
}

function genInput($data){
    $ret='';
    if(is_marray($data)&&!isset($data['type'])){
        foreach($data as $row){
            $ret.=genInput($row);
        }
    }else{
        if(!isset($data['type']))return '';
        if(is_numeric(array_search($data['type'],array('text','password','email','date','time')))){
            $ret.=genInput_textbox($data);
        }else if(is_numeric(array_search($data['type'],array('select')))){
            $ret.=genInput_select($data);
        }else if(is_numeric(array_search($data['type'],array('submit')))){
            $ret.=genInput_submit($data);
        }

        }
    
    return $ret;
}

function genInput_textbox($data){
    $ret='<label for="'.$data['id'].'">'.$data['label'].(isset($data['required'])&&$data['required']?'*':'').'</label>
            <div class="form-group">
                <div class="form-line">
                    <input type="'.$data['type'].'" name="'.$data['id'].'" id="'.$data['id'].'" class="form-control '.$data['class'].'" placeholder="'.$data['placeholder'].'" value="'.$data['def'].'" '.(isset($data['required'])&&$data['required']?'required':'').'/>
                </div>
            </div>';
        return $ret;
}


function genInput_select($data){
    $ret='<label for="'.$data['id'].'">'.$data['label'].(isset($data['required'])&&$data['required']?'*':'').'</label>
            <div class="form-group">
                <div class="form-line">
                    <select name="'.$data['id'].'" id="'.$data['id'].'" class="form-control '.$data['class'].'" '.(isset($data['required'])&&$data['required']?'required':'').'/>
                    '.genOption($data['items'],$data['def'],$data['noneLabel']).'
                    </select>
                </div>
            </div>';
        return $ret;
}

function genOption($data,$def=false,$noneSelectLable=false){
    $ret='';
    if(!is_array($data)) return $ret;
    
    if(isset($noneSelectLable)&&$noneSelectLable!="")$ret.='<option value="">'.$noneSelectLable.'</option>';

    if(is_marray($data)){
        foreach($data as $k=>$v){
            $ret.='<optgroup label="'.$k.'">';
            $ret.=genOption($v,$def);
            $ret.='</optgroup>
            ';
        }
        return $ret;
    }
    foreach($data as $k=>$v){
        $selected='';
        if($k==$def)$selected='selected';
        $ret.='<option value="'.$k.'"'.$selected.'>'.$v.'</option>';
    }
    return $ret;
}

function genInput_submit($data){
    $ret='<button type="'.$data['type'].'" class="btn btn-'.(isset($data['color'])?$data['color']:'primary').' m-t-15 waves-effect">'.(isset($data['label'])?$data['label']:'บันทึก').'</button>';
    return $ret;
}