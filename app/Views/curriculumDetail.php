<?php
    //print_r($schoolData);
    $years=array();
    for($i=date('Y')+1;$i>(date('Y')-5);$i--){
        $years[$i]=$i+543;
    }
    //print_r($mouData['business']);
    $businessData=array();
    foreach($mouData['business'] as $k=>$v){
        $businessData[$k]=$v['business_name'];
    }
    //print_r($curriculumData);
    helper('form');
    helper('user');
    $def_edu='';
    if(isset($curriculumData)&&$curriculumData->support_vc_edu=='Y')$def_edu='support_vc_edu';
    if(isset($curriculumData)&&$curriculumData->support_hvc_edu=='Y')$def_edu='support_hvc_edu';
    if(isset($curriculumData)&&$curriculumData->support_btech_edu=='Y')$def_edu='support_btech_edu';
    if(isset($curriculumData)&&$curriculumData->support_short_course=='Y')$def_edu='support_short_course';
    if(isset($curriculumData)&&$curriculumData->support_no_specific=='Y')$def_edu='support_no_specific';

    $data=array(array(
        'label'=>'ชื่อสถานประกอบการ',
        'type'=>'select',
        'items'=>$businessData,
        'class'=>'show-tick',
        'noneLabel'=>'โปรดเลือกสถานประกอบการ',
        'id'=>'business_id',
        'def'=>isset($curriculumData->business_id)?$curriculumData->business_id:'',
         ),       
         array(
            'type'=>'hidden',
            'id'=>'id',
            'def'=>isset($curriculumData->id)?$curriculumData->id:'',
            'disabled'=>isset($curriculumData->id)?false:true,
            ),
         array(
            'type'=>'hidden',
            'id'=>'school_id',
            'def'=>current_user('org_code'),
            ),
         array(
            'label'=>'ชื่อหลักสูตรที่พัฒนา',
            'type'=>'text',
            'id'=>'curriculum_name',
            'def'=>isset($curriculumData->curriculum_name)?$curriculumData->curriculum_name:'',
            'required'=>true,
             ),      
         array(
            'label'=>'ประเภทการพัฒนาหลักสูตร',
            'type'=>'select',
            'id'=>'curriculum_type',
            'items'=>array(
                'shortCourse'=>'หลักสูตรระยะสั้น/ฝึกอบรม',
                'subjectCourse'=>'หลักสูตรรายวิชา',
            ),
            'def'=>isset($curriculumData->curriculum_type)?$curriculumData->curriculum_type:date('shortCourse'),
            'required'=>true,
             ),      
         array(
            'label'=>'ปีที่พัฒนาหลักสูตร',
            'type'=>'select',
            'id'=>'curriculum_year',
            'items'=>$years,
            'def'=>isset($curriculumData->curriculum_year)?$curriculumData->curriculum_year:date('Y'),
            'required'=>true,
             ),
         array(
            'label'=>'การพัฒนา Skill Gap ',
            'type'=>'text',
            'id'=>'skill_gap',
            'placeholder'=>'ระบุชื่อ Skill Gap ที่จะถูกพัฒนาด้วยหลักสูตรนี้',
            'def'=>isset($curriculumData->skill_gap)?$curriculumData->skill_gap:'',
             ),         
         array(
            'label'=>'หลักสูตรนี้ตอบสนองภาคการผลิตและบริการใน 10 กลุ่มอุตสาหกรรมหลักด้านใดบ้าง',
            'type'=>'check_group',
            'id'=>'scurve',
            'def'=>'',
            'items'=>array(
                'skill_01'=>array(
                    'text'=>'ยานยนต์สมัยใหม่',
                    'value'=>'Y',
                    'checked'=>isset($curriculumData->skill_01)&&$curriculumData->skill_01=='Y'?true:false,
                    ),
                
                'skill_02'=>array(
                    'text'=>'อิเล็กทรอนิกส์อัฉริยะ',
                    'value'=>'Y',
                    'checked'=>isset($curriculumData->skill_02)&&$curriculumData->skill_02=='Y'?true:false,
                    ),                
                'skill_03'=>array(
                    'text'=>'ท่องเที่ยวรายได้ดี',
                    'value'=>'Y',
                    'checked'=>isset($curriculumData->skill_03)&&$curriculumData->skill_03=='Y'?true:false,
                    ),                
                'skill_04'=>array(
                    'text'=>'เกษตรและเทคโนโลยีชีวภาพ',
                    'value'=>'Y',
                    'checked'=>isset($curriculumData->skill_04)&&$curriculumData->skill_04=='Y'?true:false,
                    ),               
                'skill_05'=>array(
                    'text'=>'แปรรูปอาหาร',
                    'value'=>'Y',
                    'checked'=>isset($curriculumData->skill_05)&&$curriculumData->skill_05=='Y'?true:false,
                    ),          
                'skill_06'=>array(
                    'text'=>'หุ่นยนต์',
                    'value'=>'Y',
                    'checked'=>isset($curriculumData->skill_06)&&$curriculumData->skill_06=='Y'?true:false,
                    ),          
                'skill_07'=>array(
                    'text'=>'การบินและโลจิสติกส์',
                    'value'=>'Y',
                    'checked'=>isset($curriculumData->skill_07)&&$curriculumData->skill_07=='Y'?true:false,
                    ),          
                'skill_08'=>array(
                    'text'=>'เชื้อเพลิงเคมีชีวภาพ',
                    'value'=>'Y',
                    'checked'=>isset($curriculumData->skill_08)&&$curriculumData->skill_08=='Y'?true:false,
                    ),          
                'skill_09'=>array(
                    'text'=>'ดิจิตอล',
                    'value'=>'Y',
                    'checked'=>isset($curriculumData->skill_09)&&$curriculumData->skill_09=='Y'?true:false,
                    ),          
                'skill_10'=>array(
                    'text'=>'การแพทย์ครบวงจร',
                    'value'=>'Y',
                    'checked'=>isset($curriculumData->skill_10)&&$curriculumData->skill_10=='Y'?true:false,
                    ),
                ),
            ),
         array(
             'label'=>'ระดับของหลักสูตร',
             'type'=>'select',
             'id'=>'support_edu',
             'items'=>array(
                 'support_vc_edu'=>'ปวช.',
                 'support_hvc_edu'=>'ปวส.',
                 'support_btech_edu'=>'ทล.บ.',
                 'support_short_course'=>'ระยะสั้น',
                 'support_no_specific'=>'อื่นๆ',
                ),
                'def'=>$def_edu,
             ),
         array(
            'label'=>'สาขาวิชา',
            'type'=>'text',
            'id'=>'majors',
            'placeholder'=>'เช่น ช่างไฟฟ้ากำลัง,ช่างอิเล็กทรอนิกส์ โดยขั้นแต่ละสาขาด้วยเครื่องหมายจุลภาค (,)',
            'def'=>isset($curriculumData->majors)?$curriculumData->majors:'',
             ),
         array(
            'label'=>'จำนวนชั่วโมงการอบรม',
            'type'=>'number',
            'id'=>'curriculum_hour',
            'placeholder'=>'ระบุจำนวนชั่วโมงที่ใช้ในการอบรม',
            'def'=>isset($curriculumData->curriculum_hour)?$curriculumData->curriculum_hour:'',
             ),
         array(
            'label'=>'เป้าหมายการอบรม',
            'type'=>'number',
            'id'=>'curriculum_target',
            'placeholder'=>'ระบุจำนวนผู้เข้าอบรมที่คาดหวัง',
            'def'=>isset($curriculumData->curriculum_target)?$curriculumData->curriculum_target:'',
             ),
         array(
            'label'=>'การสนับสนุนของสถานประกอบการ',
            'type'=>'textarea',
            'id'=>'business_action',
            'placeholder'=>'เช่น
1) จัดหาบุคลากรที่เชียวชาญมาอบรมให้
2) นำผู้เรียนเข้ารับการอบรมในสถานประกอบการ
3) มอบวัสดุแบะอุปกรณ์ในการฝึกอบรม',
            'def'=>isset($curriculumData->business_action)?$curriculumData->business_action:'',
             ),
         array(
            'label'=>'ไฟล์หลักสูตร สแกนเอกสารหลักสูตรเป็นไฟล์ PDF',
            'type'=>'file',
            'id'=>'attach_file',
            'def'=>'',
             ),
         array(
            'label'=>'ภาพถ่ายขณะพัฒนาหลักสูตร',
            'type'=>'file',
            'id'=>'pictures',
            'def'=>'',
            'multiple'=>true,
             ),
         array(
            'label'=>'จำนวนผู้เข้ารับอบรม (กรอกเมื่อการดำเนินการอมรมเสร็จสิ้น)',
            'type'=>'number',
            'id'=>'training_amount',
            'def'=>isset($curriculumData->training_amount)?$curriculumData->training_amount:'',
             ),
         array(
            'label'=>'ภาพถ่ายขณะจัดการอบรม',
            'type'=>'file',
            'id'=>'training_pictures',
            'def'=>'',
            'multiple'=>true,
             ),
         array(
             'label'=>'บันทึกข้อมูล',
             'type'=>'submit',
         ),
    );

    $form=array(
        'formName'=>'ข้อมูลหลักสูตร',
        'inputs'=>$data,
        'action'=>site_url('public/mou/curriculumSave'),
        'method'=>'post',
        'enctype'=>'multipart/form-data',
    );
    
    print genForm($form);