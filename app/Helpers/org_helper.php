<?php

function org_name($org_id=false){
    if(!$org_id) return false;
    $orgModel = model('App\Models\OrgModel');

        if(!isset($_SESSION['ORG'])){
            $schools=$orgModel->getSchool();
            $govs=$orgModel->getGov();
            $institute=$orgModel->getInstitute();
            $_SESSION['ORG']=$schools+$govs+$institute;
        }
        //print_r($_SESSION['ORG']);
        return $_SESSION['ORG'][$org_id];
}