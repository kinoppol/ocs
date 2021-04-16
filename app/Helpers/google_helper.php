<?php
//print_r($_POST);
function checkToken($data){
    $API_URL="https://www.googleapis.com/oauth2/v3/tokeninfo?id_token=".$data['token'];
    $data=json_decode(file_get_contents($API_URL),true);

    if($data['email']==$data['email']){
        $message=array(
            'status'=>'ok',
            'text'=>'Token is correct',
            'data'=>$data
        );
    }else{
        $message=array(
            'status'=>'false',
            'text'=>'Token is invalid',
        );
    }
    return $message;
}

?>