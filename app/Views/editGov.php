<?php
    //print_r($schoolData);
    helper('form');
    $data=array(array(
        'label'=>'ชื่อประธาน อ.กรอ.อศ.',
        'type'=>'text',
        'id'=>'president_name',
        'def'=>$govData->president_name,
        'required'=>true,
         ),
         array(
        'type'=>'hidden',
        'id'=>'gov_id',
        'def'=>$govData->gov_id,
         ),
        array(
        'label'=>'สถานศึกษาเลขานุการ อ.กรอ.อศ.',
        'type'=>'select',
        'id'=>'secretary_school_id',
        'class'=>'show-tick',
        'items'=>$schools,
        'noneLabel'=>'โปรดเลือกสถานศึกษาที่ทำหน้าที่เลขานุการฯ',
        'def'=>$govData->secretary_school_id,
        'required'=>true,
        ),
        array(
        'label'=>'สถานศึกษาใน อ.กรอ.อศ.',
        'type'=>'select',
        'id'=>'gov_school_id[]',
        'class'=>'show-tick',
        'items'=>$schools,
        'noneLabel'=>'โปรดเลือกสถานศึกษาที่อยู่ใน อ.กรอ.อศ.',
        'def'=>explode(',',$govData->gov_school_id),
        'multiple'=>true,
        'required'=>true,
        ),
         array(
             'label'=>'บันทึกข้อมูล',
             'type'=>'submit',
         ),
    );

    $form=array(
        'formName'=>'ข้อมูล อ.กรอ.อศ.',
        'inputs'=>$data,
        'action'=>site_url('public/gov/saveGov'),
        'method'=>'post',
        'enctype'=>'multipart/form-data',
    );
    
    print genForm($form);

