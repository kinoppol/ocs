<?php
helper('form');
helper('user');
//print_r($business_data);

$data=array(array(
                    'label'=>'ชื่อสถานประกอบการ',
                    'type'=>'text',
                    'id'=>'business_name',
                    'def'=>$business_data->business_name,
                    'disabled'=>true,
                ),
                array(
                    'type'=>'hidden',
                    'id'=>'business_id',
                    'def'=>$business_data->business_id,
                ),
                array(
                    'type'=>'hidden',
                    'id'=>'org_id',
                    'def'=>current_user('org_code'),
                ),
                array(
                    'label'=>'ที่อยู่',
                    'type'=>'text',
                    'id'=>'address',
                    'def'=>'เลขที่ '.($business_data->address_no!=''?$business_data->address_no:'-').' ถนน'.($business_data->road!=''?$business_data->road:'-').' ตำบล'.$subdistrict[$business_data->subdistrict_id].' อำเภอ'.$district[$business_data->district_id].'จังหวัด'.$province[$business_data->province_id],
                    'disabled'=>true,
                ),
                array(
                    'label'=>'ชื่อผู้บริหารฝั่งรัฐที่ลงนาม',
                    'type'=>'text',
                    'id'=>'govSignName',
                    'required'=>true,
                ),
                array(
                    'label'=>'ตำแหน่งผู้บริหาร',
                    'type'=>'text',
                    'id'=>'govSignNamePosition',
                    'required'=>true,
                ),
                array(
                    'label'=>'ชื่อตัวแทนสถานประกอบการที่ลงนาม',
                    'type'=>'text',
                    'id'=>'businessSignName',
                    'required'=>true,
                ),
                array(
                    'label'=>'ตำแหน่งตัวแทน',
                    'type'=>'text',
                    'id'=>'businessSignNamePosition',
                    'required'=>true,
                ),
                array(
                    'label'=>'วันที่ลงนามความร่วมมือ',
                    'type'=>'date',
                    'id'=>'mou_date',
                    'def'=>date('Y-m-d'),
                    'max'=>date(('Y-m-d'),strtotime(' + 365 day')),
                    'min'=>date(('Y-m-d'),strtotime(' - 100 year')),
                    'required'=>true,
                ),
                array(
                    'label'=>'วันที่เริ่มความร่วมมือ',
                    'type'=>'date',
                    'id'=>'mou_start_date',
                    'def'=>date('Y-m-d'),
                    'max'=>date(('Y-m-d'),strtotime(' + 365 day')),
                    'min'=>date(('Y-m-d'),strtotime(' - 100 year')),
                    'required'=>true,
                ),
                array(
                    'label'=>'วันที่สิ้นสุดความร่วมมือ',
                    'type'=>'date',
                    'id'=>'mou_end_date',
                    'def'=>date('Y-m-d',strtotime(' + 3 year')),
                    'max'=>date(('Y-m-d'),strtotime(' + 10 year')),
                    'min'=>date(('Y-m-d'),strtotime(' - 100 year')),
                    'required'=>true,
                ),
                array(
                    'label'=>'สถานที่ลงนาม',
                    'type'=>'text',
                    'id'=>'mou_sign_place',
                    'required'=>true,
                ),
                array(
                    'label'=>'สาขาวิชาที่ลงนาม',
                    'type'=>'text',
                    'id'=>'major',
                    'required'=>false,
                ),
                array(
                    'label'=>'วัตถุประสงค์ในการทำ MOU',
                    'type'=>'text',
                    'id'=>'object',
                    'required'=>true,
                ),
                array(
                    'label'=>'เป้าหมายการรับนักศึกษาฝึกงาน/ฝึกอาชีพ (ระบุจำนวนคน)',
                    'type'=>'number',
                    'id'=>'dve_target',
                    'def'=>0,
                    'required'=>true,
                ),
                array(
                    'label'=>'ค่าตอบแทนการฝึกงาน/ฝึกอาชีพต่อเดือนโดยประมาณ (0 หมายถึงไม่ได้ให้)',
                    'type'=>'number',
                    'id'=>'wage',
                    'def'=>0,
                    'required'=>true,
                ),
                array(
                    'label'=>'สิทธิประโยชน์อื่นนอกจากค่าตอบแทน',
                    'type'=>'text',
                    'id'=>'benefits',
                    'required'=>false,
                ),
                array(
                    'label'=>'ไฟล์ MOU',
                    'type'=>'file',
                    'id'=>'mou',
                    'accept'=>'.pdf,.PDF',
                    'required'=>false,
                ),
                array(
                    'label'=>'ภาพถ่ายขณะลงนาม',
                    'type'=>'file',
                    'id'=>'mou',
                    'accept'=>'.jpg,.JPG',
                    'required'=>false,
                ),
            array(
                'label'=>'บันทึกข้อมูล',
                'type'=>'submit',
            ),
        );
$form=array(
    'formName'=>'ข้อมูลการทำความร่วมมือ',
    'inputs'=>$data,
    'action'=>site_url('public/mou/save'),
    'method'=>'post',
);

print genForm($form);
?>