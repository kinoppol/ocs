<?php
helper('form');

$userType=array(
    'board'=>'ผู้บริหาร สอศ.',
    'gov'=>'เลขานุการ อ.กรอ.อศ.',
    'instute'=>'สถาบันการอาชีวศึกษา',
    'school'=>'สถานศึกษา (งานความร่วมมือ)',
);

$data=array(array(
                'label'=>'ประเภทผู้ใช้งาน',
                'type'=>'select',
                'id'=>'user_type',
                'items'=>$userType,
                'noneLabel'=>'โปรดเลือกประเภทผู้ใช้งาน',
                'required'=>true,
            ),
            array(
                'label'=>'สถานศึกษา',
                'type'=>'text',
                'id'=>'school',
                'placeholder'=>'วิทยาลัย...',
                'required'=>true,
            ),
            array(
                'label'=>'ลงทะเบียนผู้ใช้งาน',
                'type'=>'submit',
            ),
        );
$form=array(
    'formName'=>'ลงทะเบียนผู้ใช้งาน',
    'inputs'=>$data,
    'action'=>site_url('public/user/register'),
    'method'=>'post',
);
print genForm($form);
?>