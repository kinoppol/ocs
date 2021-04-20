<?php

namespace App\Controllers;

class Mou extends BaseController
{
	public function list($year='')
	{
		ini_set('memory_limit', '2048M');
		if($year=='')$year=date('Y');
		$mouModel = model('App\Models\MouModel');
		$data=array(
			'data'=>$mouModel->getMou($year),
			'year'=>$year,
		);
		$data=array(
			'title'=>'รายการความร่วมมือ',
			'mainMenu'=>view('_menu'),
			'content'=>view('listMou',$data),
		);
		return view('_main',$data);
	}
	public function search()
	{
	
		$data=array(
			'title'=>'ค้นหาข้อมูลความร่วมมือ',
			'mainMenu'=>view('_menu'),
		);
		return view('_main',$data);
	}
	public function add($business_id='')
	{
		$businessModel = model('App\Models\businessModel');
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
		);
		return view('_main',$data);
	}
	public function save(){
		$businessModel = model('App\Models\MouModel');
		$data=array(
			'business_id'	=>$_POST['business_id'],
			'school_id'		=>$_POST['org_id'],
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
		);
		$result=$businessModel->addMou($data);
		return '<meta http-equiv="refresh" content="0;url='.site_url('public/mou/list').'">';
	}
	public function pdf($id)
	{		
		$mouModel = model('App\Models\MouModel');
		$data=array(
			'id'=>$id,
		);
		return view('mouPDF',$data);
	}

	public function searchBusiness()
	{
        helper('system');
		$businessModel = model('App\Models\BusinessModel');
		$locationModel = model('App\Models\LocationModel');
        if(isset($_POST['q'])&&$_POST['q']!=''){
            $data=array(            
                'province'=>$locationModel->getProvince(),
                'district'=>$locationModel->getDistrict(),
                'subdistrict'=>$locationModel->getSubdistrict(),
                'business'=>$businessModel->searchBusiness($_POST['q']),
            );
        }else{
            $data=array(           
                'province'=>array(),
                'district'=>array(),
                'subdistrict'=>array(),
                'business'=>array(),
            );
        }
		$data=array(
			'title'=>'ค้นหาสถานประกอบการที่ทำ MOU',
			'mainMenu'=>view('_menu'),
            'content'=>view('listBusiness',$data)
		);        

		return view('_main',$data);
	}
}
