<?php

function current_user($key){
    $userData=unserialize($_COOKIE['current_user']);
    return $userData[0]->$key;
}

function user_type($type){
    $userType=array(
        'admin'=>'ผู้ดูแลระบบ',
        'board'=>'ผู้บริหาร สอศ.',
        'boc'=>'สำนักความร่วมมือ',
        'gov'=>'เลขานุการ กรอ.อศ.',
        'institute'=>'สถาบันการอาชีวศึกษา',
        'school'=>'สถานศึกษา',
    );
    return $userType[$type];
}