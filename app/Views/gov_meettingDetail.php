<?php
    //print_r($schoolData);
    helper('form');
    $data=array(array(
        'label'=>'หัวข้อการประชุม',
        'type'=>'text',
        'id'=>'subject',
        'def'=>'',
        'placeholder'=>'เช่น ประชุมหารือทั่วไป',
        'required'=>true,
         ),
         array(
            'label'=>'เลขที่คำสั่ง/หนังสือเชิญประชุม',
            'type'=>'text',
            'id'=>'book_no',
            'def'=>'',
            'placeholder'=>'',
            //'required'=>true,
             ),
         array(
            'label'=>'สถานที่ประชุม',
            'type'=>'text',
            'id'=>'meetting_place',
            'def'=>'',
            'placeholder'=>'เช่น โรงแรมทาวน์อินทาวน์',
            'required'=>true,
             ),
         array(
            'label'=>'วันที่ประชุม',
            'type'=>'date',
            'id'=>'meetting_date',
            'def'=>date('Y-m-d'),
            'required'=>true,
             ),
         array(
            'label'=>'บันทึกการประชุม (สแกนเอกสารบันทึกการประชุมเป็นไฟล์ PDF)',
            'type'=>'file',
            'id'=>'meettingRecord',
            'def'=>'',
            'accept'=>'application/pdf',
            'required'=>true,
             ),
         array(
            'label'=>'ภาพถ่ายขณะประชุม (อย่างน้อย 2 ภาพ)',
            'type'=>'file',
            'id'=>'pictures',
            'def'=>'',
            'accept'=>'image/jpeg',
            'required'=>true,
            'multiple'=>true,
             ),
         array(
             'label'=>'บันทึกข้อมูล',
             'type'=>'submit',
             'required'=>true,
         ),
    );

    $form=array(
        'formName'=>'ข้อมูลการประชุม',
        'inputs'=>$data,
        'action'=>site_url('public/gov/saveMeetting'),
        'method'=>'post',
        'enctype'=>'multipart/form-data',
    );
    
    print genForm($form);