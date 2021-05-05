<?php
    //print_r($schoolData);
    $years=array();
    for($i=date('Y')+1;$i>(date('Y')-5);$i--){
        $years[$i]=$i+543;
    }
    helper('form');
    $data=array(array(
        'label'=>'ชื่อสถานประกอบการ',
        'type'=>'text',
        'id'=>'business_id',
        'def'=>'',
         ),
         array(
            'label'=>'ปีที่เกิดผลสัมฤทธิ์',
            'type'=>'select',
            'id'=>'curriculum_year',
            'items'=>$years,
            'def'=>date('Y'),
            'required'=>true,
             ),    
               
         array(
            'label'=>'สาขาที่รับนักศึกษาฝึกงาน/ฝึกอาชีพ',
            'type'=>'text',
            'id'=>'trainee_majors',
            'def'=>'',
            'placeholder'=>'เช่น ช่างไฟฟ้า,ช่างอิเล็กทรอนิกส์ ขั้นแต่ละสาขาด้วยเครื่องหมายจุลภาค (,)',
            'required'=>true,
             ),   
         array(
            'label'=>'จำนวนนักศึกษาฝึกงาน/ฝึกอาชีพ (จำนวนรวม)',
            'type'=>'number',
            'id'=>'trainee_amount',
            'def'=>'',
            'required'=>true,
             ),    
        array(
            'label'=>'สาขาที่รับผู้สำเร็จการศึกษาเข้าเป็นพนักงาน',
            'type'=>'text',
            'id'=>'employee_majors',
            'def'=>'',
            'placeholder'=>'เช่น ช่างไฟฟ้า,ช่างอิเล็กทรอนิกส์ ขั้นแต่ละสาขาด้วยเครื่องหมายจุลภาค (,)',
            'required'=>true,
             ),   
         array(
            'label'=>'จำนวนการรับผู้สำเร็จการศึกษาเข้าเป็นพนักงาน (จำนวนรวม)',
            'type'=>'number',
            'id'=>'employee_amount',
            'def'=>'',
            'required'=>true,
             ),    
         array(
            'label'=>'การสนับสนุนการจัดการศึกษาด้วยการบริจาค (หากมีการบริจาตหลายรายการให้บันทึกข้อมูลสัมฤทธิ์แยกรายการ)',
            'type'=>'text',
            'id'=>'donate_detail',
            'def'=>'',
            'placeholder'=>'เช่น บริจาครถกระบะสี่ประตู',
            'required'=>true,
             ),    
         array(
            'label'=>'มูลค่าการสนับสนุนการจัดการศึกษา (บาท)',
            'type'=>'number',
            'id'=>'donate_value',
            'placeholder'=>'900,000 บาท',
            'def'=>'',
            'required'=>true,
             ),    
         array(
            'label'=>'การสนับสนุนการศึกษารูปแบบอื่นๆ',
            'type'=>'textarea',
            'id'=>'donate_other',
            'def'=>'',
            'placeholder'=>'เช่น
1) การจัดแข่งขั้นทักษะ
2) การ',
            'required'=>true,
             ),    
              
         array(
             'label'=>'บันทึกข้อมูล',
             'type'=>'submit',
         ),
    );

    $form=array(
        'formName'=>'ข้อมูลผลสัมฤทธิ์',
        'inputs'=>$data,
        'action'=>site_url('public/mou/saveResult'),
        'method'=>'post',
        'enctype'=>'multipart/form-data',
    );
    
    print genForm($form);