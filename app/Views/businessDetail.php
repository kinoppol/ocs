<?php
    //print_r($schoolData);
    helper('form');
    $data=array(array(
        'label'=>'ชื่อสถานประกอบการ',
        'type'=>'text',
        'id'=>'business_name',
        'def'=>'',
        'required'=>true,
         ),
         array(\
            'type'=>'hidden',
            'id'=>'business_id',
            'def'=>isset($businessData->bussiness_id)?$businessData->bussiness_id:'',
             ),
         array(
            'label'=>'หมายเลขประจำตัวผู้เสียภาษี',
            'type'=>'text',
            'id'=>'vat_id',
            'def'=>isset($businessData->vat_id)?$businessData->vat_id:'',
             ),
         array(
            'label'=>'ที่อยู่',
            'type'=>'text',
            'id'=>'address_no',
            'def'=>isset($businessData->address_no)?$businessData->address_no:'',
            'required'=>true,
             ),
         array(
            'label'=>'ลักษณะของกิจการ',
            'type'=>'text',
            'id'=>'job_description',
            'def'=>isset($businessData->job_description)?$businessData->job_description:'',
            'required'=>true,
            'placeholder'=>'เช่น ค้าปลีก,บริการหลังการขาย',
             ),
         array(
            'label'=>'จำนวนพนักงาน',
            'type'=>'number',
            'id'=>'amount_emp',
            'def'=>isset($businessData->amount_emp)?$businessData->amount_emp:'',
            'required'=>true,
             ),
         array(
            'label'=>'อีเมล',
            'type'=>'email',
            'id'=>'email',
            'def'=>isset($businessData->email)?$businessData->email:'',
             ),
         array(
            'label'=>'สิทธิ์ลดหย่อนภาษี',
            'type'=>'check_group',
            'id'=>'tax_break',
            'def'=>'',
            'items'=>array(
                'tax_break'=>array(
                    'text'=>'ใช้สิทธิ์ลดหย่อนภาษี',
                    'value'=>'Y',
                    'checked'=>isset($businessData->tax_break)&&$businessData->tax_break=='ใช้สิทธิ์'?true:false,
                                )
            ),
            'required'=>true,
             ),
         array(
            'label'=>'ประเทศที่ตั้งของสถานประกอบการ',
            'type'=>'text',
            'id'=>'country',
            'def'=>isset($businessData->country)?$businessData->country:'ประเทศไทย',
            'required'=>true,
             ),
         array(
            'label'=>'พิกัดที่ตั้ง <a href="'.site_url('images/map.jpg').'" target="_blank">คลิกเพื่อดูวิธีทำ</a> (เข้า GoogleMap คลิกขวาที่ตั้งสถานประกอบการแล้วคัดลอกพิกัดที่ตั้งมาวาง) ',
            'type'=>'text',
            'id'=>'location',
            'placeholder'=>'เช่น 13.60502042693827, 100.5964253312417',
            'def'=>isset($businessData->location)?$businessData->location:'',
             ),
             
         array(
            'label'=>'ภาพถ่ายหน้าสถานประกอบการ',
            'type'=>'file',
            'id'=>'picture',
            'def'=>'',
             ),
         array(
             'label'=>'บันทึกข้อมูล',
             'type'=>'submit',
         ),
    );

    $form=array(
        'formName'=>'ข้อมูลสถานประกอบการ',
        'inputs'=>$data,
        'action'=>site_url('public/business/saveBusiness'),
        'method'=>'post',
        'enctype'=>'multipart/form-data',
    );
    
    print genForm($form);