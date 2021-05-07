<?php

namespace App\Controllers;

class Mou extends BaseController
{
	public function list($year='')
	{
		if($year=='')$year=date('Y');
		$mouModel = model('App\Models\MouModel');
		$data=array(
			'data'=>$mouModel->getMou(['year'=>$year]),
			'year'=>$year,
		);
		$data=array(
			'title'=>'รายการความร่วมมือ',
			'mainMenu'=>view('_menu'),
			'content'=>view('listMou',$data),
			'notification'=>'',
			'task'=>'',
		);
		return view('_main',$data);
	}
	public function search()
	{
	
		$data=array(
			'title'=>'ค้นหาข้อมูลความร่วมมือ',
			'mainMenu'=>view('_menu'),
			'notification'=>'',
			'task'=>'',
		);
		return view('_main',$data);
	}
	public function add($business_id='')
	{
		$businessModel = model('App\Models\BusinessModel');
		$locationModel = model('App\Models\LocationModel');
		$data=array(
			'business_data'=>$businessModel->getBusiness($business_id),
			'province'=>$locationModel->getProvince(),
			'district'=>$locationModel->getDistrict(),
			'subdistrict'=>$locationModel->getSubdistrict(),
		);
		$data=array(
			'title'=>'เพิ่มข้อมูล MOU',
			'mainMenu'=>view('_menu'),			
			'content'=>view('detailMou',$data),
			'notification'=>'',
			'task'=>'',
		);
		return view('_main',$data);
	}
	public function edit($mou_id='')
	{
		$businessModel = model('App\Models\BusinessModel');
		$locationModel = model('App\Models\LocationModel');
		$mouModel = model('App\Models\MouModel');
		$mou_data=$mouModel->getMou(['mou_id'=>$mou_id]);
		//print_r($mou_data['mou']);
		$data=array(
			'mou_data'=>$mou_data['mou'][0],
			'business_data'=>$businessModel->getBusiness($mou_data['mou'][0]->business_id),
			'province'=>$locationModel->getProvince(),
			'district'=>$locationModel->getDistrict(),
			'subdistrict'=>$locationModel->getSubdistrict(),
		);
		$data=array(
			'title'=>'แก้ไขข้อมูล MOU',
			'mainMenu'=>view('_menu'),			
			'content'=>view('detailMou',$data),
			'notification'=>'',
			'task'=>'',
		);
		return view('_main',$data);
	}
	public function save(){
		//print_r($_POST);
		$businessModel = model('App\Models\MouModel');
		$data=array(
			'business_id'	=>$_POST['business_id'],
			'school_id'		=>$_POST['org_id'],
			'level'			=>$_POST['level'],
			'support_vc_edu'=>($_POST['support_vc_edu']=='Y'?'Y':'N'),
			'support_hvc_edu'=>($_POST['support_hvc_edu']=='Y'?'Y':'N'),
			'support_btech_edu'=>($_POST['support_btech_edu']=='Y'?'Y':'N'),
			'support_short_course'=>($_POST['support_short_course']=='Y'?'Y':'N'),
			'support_no_specific'=>($_POST['support_no_specific']=='Y'?'Y':'N'),
			'support_normal'=>($_POST['support_normal']=='Y'?'Y':'N'),
			'support_dve'	=>($_POST['support_dve']=='Y'?'Y':'N'),
			'support_local_training'=>($_POST['support_local_training']=='Y'?'Y':'N'),
			'support_oversea_training'=>($_POST['support_oversea_training']=='Y'?'Y':'N'),
			'director_name'	=>$_POST['govSignName'],
			'director_type'	=>$_POST['govSignNamePosition'],
			'ceo_name'		=>$_POST['businessSignName'],
			'ceo_type'		=>$_POST['businessSignNamePosition'],
			'mou_date'		=>$_POST['mou_date'],
			'mou_start_date'=>$_POST['mou_start_date'],
			'mou_end_date'	=>$_POST['mou_end_date'],
			'mou_sign_place'=>$_POST['mou_sign_place'],
			'major'			=>$_POST['major'],
			'object'		=>$_POST['object'],
			'dve_target'	=>$_POST['dve_target'],
			'wage'			=>$_POST['wage'],
			'benefits'		=>$_POST['benefits'],
			'obligation'	=>$_POST['obligation'],
		);
		if(isset($_POST['mou_id'])&&$_POST['mou_id']!='')$result=$businessModel->updateMou($_POST['mou_id'],$data);
		else $result=$businessModel->addMou($data);
		return '<meta http-equiv="refresh" content="0;url='.site_url('public/mou/list').'">';
	}
	public function pdf($id)
	{		
		error_reporting(0);
		helper('mpdf');
		$mouModel = model('App\Models\MouModel');
		$mou_data=$mouModel->getMou(['mou_id'=>$id]);
		//print_r($mou_data['mou'][0]);
		$data=array(
			'id'=>$id,
		);
		$html='<div align="center"><b>บันทึกข้อตกลงความร่วมมือ</b></div>';
		$html.='<div align="center"><b>ระหว่าง</b></div>';
		$html.='<div align="center"><b>สำนักงานคณะกรรมการการอาชีวศึกษา โดย '.$mou_data['school'][$mou_data['mou'][0]->school_id].'</b></div>';
		$html.='<div align="center"><b>'.$mou_data['business'][$mou_data['mou'][0]->business_id].'</b></div>';
		$html.='<div align="center">******************************************************</div>';
		$html.='<div align="left"><b>บันทึกข้อตกลงนี้ทำขึ้นระหว่าง</b></div>';
		$pdf_data=array(
			'html'=>$html,
			'size'=>"A4",
			'fontsize'=>16,
			'marginL'=>20,
			'marginR'=>10,
			'marginT'=>10,
			'marginB'=>10,
			'header'=>'',
			'wartermark'=>'',
			'wartermarkimage'=>'',
			'footer'=>'เอกสารนี้ออกโดย'.SYSTEMNAME.' สำนักความร่วมมือ สำนักงานคณะกรรมการการอาชีวศึกษา '.date('Y-m-d H:i:s'),
			//'header'=>'<div style="text-align: right; font-weight: normal;">หน้า {PAGENO}/{nbpg}</div>'
		);
		//print $html;
		$location=FCPATH.'/pdf/';
		$fname=$id.'.pdf';
		$filePdf=genPdf($pdf_data,$pageNo=NULL,$location,$fname);
		//return '';
		return '<meta http-equiv="refresh" content="0;url='.site_url('public/pdf/'.$filePdf).'">';
	}

	public function searchBusiness()
	{
        helper('system');
		$businessModel = model('App\Models\BusinessModel');
		$locationModel = model('App\Models\LocationModel');
        $province_id='10';
        if(isset($_POST['province_id']))$province_id=$_POST['province_id'];
        if(isset($_POST['q'])&&$_POST['q']!=''){
            $data=array(            
                'province'=>$locationModel->getProvince(),
                'district'=>$locationModel->getDistrict(),
                'subdistrict'=>$locationModel->getSubdistrict(),
                'business'=>$businessModel->searchBusiness(['province_id'=>$province_id,'q'=>$_POST['q']]),
            );
        }else{
            $data=array(            
                'province'=>$locationModel->getProvince(),
                'district'=>$locationModel->getDistrict(),
                'subdistrict'=>$locationModel->getSubdistrict(),
                'business'=>$businessModel->searchBusiness(['province_id'=>$province_id]),
            );
        }
		$data=array(
			'title'=>'ค้นหาสถานประกอบการที่ทำ MOU',
			'mainMenu'=>view('_menu'),
            'content'=>view('listBusiness',$data),
			'notification'=>'',
			'task'=>'',
		);        

		return view('_main',$data);
	}

	public function curriculumDev(){
		
		helper('user');
		$mouModel = model('App\Models\MouModel');
		$curriculum=$mouModel->curriculumGet(['school_id'=>current_user('org_code')]);
		$data=array(
			'curriculum'=>$curriculum,
		);

		$data=array(
			'title'=>'หลักสูตรที่ร่วมกับสถานประกอบการ',
			'mainMenu'=>view('_menu'),
            'content'=>view('curriculumList',$data),
			'notification'=>'',
			'task'=>'',
		);       
		return view('_main',$data);
	}

	public function curriculumAdd(){
		helper('user');
		$mouModel = model('App\Models\MouModel');
		$resultData=$mouModel->getMou(['school_id'=>current_user('org_code')]);
		$data=array(
			'mouData'=>$resultData,
		);
		$data=array(
			'title'=>'ข้อมูลหลักสูตร',
			'mainMenu'=>view('_menu'),
            'content'=>view('curriculumDetail',$data),
			'notification'=>'',
			'task'=>'',
		);       
		return view('_main',$data);
	}

	public function curriculumDetail($id){
		helper('user');
		$mouModel = model('App\Models\MouModel');
		$resultData=$mouModel->getMou(['school_id'=>current_user('org_code')]);
		$curriculumData=$mouModel->curriculumGet(['id'=>$id]);
		$data=array(
			'mouData'=>$resultData,
			'curriculumData'=>$curriculumData['curriculum'][0],
		);
		$data=array(
			'title'=>'ข้อมูลหลักสูตร',
			'mainMenu'=>view('_menu'),
            'content'=>view('curriculumDetail',$data),
			'notification'=>'',
			'task'=>'',
		);       
		return view('_main',$data);
	}

	public function curriculumSave(){
		//print_r($_POST);

		$data=array(
			'business_id'		=>$_POST['business_id'],
			'school_id'			=>$_POST['school_id'],
			'curriculum_name'	=>$_POST['curriculum_name'],
			'curriculum_year'	=>$_POST['curriculum_year'],
			'skill_01'			=>isset($_POST['skill_01'])?$_POST['skill_01']:'N',
			'skill_02'			=>isset($_POST['skill_02'])?$_POST['skill_02']:'N',
			'skill_03'			=>isset($_POST['skill_03'])?$_POST['skill_03']:'N',
			'skill_04'			=>isset($_POST['skill_04'])?$_POST['skill_04']:'N',
			'skill_05'			=>isset($_POST['skill_05'])?$_POST['skill_05']:'N',
			'skill_06'			=>isset($_POST['skill_06'])?$_POST['skill_06']:'N',
			'skill_07'			=>isset($_POST['skill_07'])?$_POST['skill_07']:'N',
			'skill_08'			=>isset($_POST['skill_08'])?$_POST['skill_08']:'N',
			'skill_09'			=>isset($_POST['skill_09'])?$_POST['skill_09']:'N',
			'skill_10'			=>isset($_POST['skill_10'])?$_POST['skill_10']:'N',
			'support_vc_edu'	=>isset($_POST['support_edu'])&&$_POST['support_edu']=='support_vc_edu'?'Y':'N',
			'support_hvc_edu'	=>isset($_POST['support_edu'])&&$_POST['support_edu']=='support_hvc_edu'?'Y':'N',
			'support_btech_edu'	=>isset($_POST['support_edu'])&&$_POST['support_edu']=='support_btech_edu'?'Y':'N',
			'support_short_course'=>isset($_POST['support_edu'])&&$_POST['support_edu']=='support_short_course'?'Y':'N',
			'support_no_specific'=>isset($_POST['support_edu'])&&$_POST['support_edu']=='support_no_specific'?'Y':'N',
			'curriculum_hour'	=>$_POST['curriculum_hour'],
			'curriculum_target'	=>$_POST['curriculum_target'],
			'business_action'	=>$_POST['business_action'],
			'training_amount'	=>$_POST['training_amount'],
		);
		
		$mouModel = model('App\Models\MouModel');
		 
		if(!isset($_POST['id'])){
			$result=$mouModel->curriculumAdd($data);
		}else{
			$result=$mouModel->curriculumUpdate($_POST['id'],$data);
		}

		$data=array(
			'title'=>'บันทึกข้อมูลหลักสูตร',
			'mainMenu'=>view('_menu'),
            'content'=>$result?'บันทึกข้อมูลสำเร็จ <meta http-equiv="refresh" content="2;url='.site_url('public/mou/curriculumDev').'">':'บันทึกข้อมูลไม่สำเร็จ',
			'notification'=>'',
			'task'=>'',
		);      
		return view('_main',$data);

	} 

	public function curriculumDelete($id){

		$mouModel = model('App\Models\MouModel');
		 
			$result=$mouModel->curriculumDelete(['id'=>$id]);

		$data=array(
			'title'=>'ลบข้อมูลหลักสูตร',
			'mainMenu'=>view('_menu'),
            'content'=>$result?'ลบข้อมูลสำเร็จ <meta http-equiv="refresh" content="2;url='.site_url('public/mou/curriculumDev').'">':'ลบข้อมูลไม่สำเร็จ',
			'notification'=>'',
			'task'=>'',
		);      
		return view('_main',$data);

	} 

	
	public function result(){

		$data=array(
			'title'=>'ผลสัมฤทธิ์ของความร่วมมือ',
			'mainMenu'=>view('_menu'),
            'content'=>view('mouResultList'),
			'notification'=>'',
			'task'=>'',
		);       
		return view('_main',$data);
	}

	public function resultAdd(){
		helper('user');
		$mouModel = model('App\Models\MouModel');
		$resultData=$mouModel->getMou(['school_id'=>current_user('org_code')]);
		//$curriculumData=$mouModel->curriculumGet(['id'=>$id]);
		$data=array(
			'mouData'=>$resultData,
			//'curriculumData'=>$curriculumData['curriculum'][0],
		);

		$data=array(
			'title'=>'เพิ่มข้อมูลผลสัมฤทธิ์ของความร่วมมือ',
			'mainMenu'=>view('_menu'),
            'content'=>view('resultDetail',$data),
			'notification'=>'',
			'task'=>'',
		);       
		return view('_main',$data);
	}
}
