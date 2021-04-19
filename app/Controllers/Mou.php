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
			'systemName'=>'ระบบฐานข้อมูลความร่วมมือ',
			'mainMenu'=>view('_menu'),
			'content'=>view('listMou',$data),
		);
		return view('_main',$data);
	}
	public function search()
	{
	
		$data=array(
			'title'=>'ค้นหาข้อมูลความร่วมมือ',
			'systemName'=>'ระบบฐานข้อมูลความร่วมมือ',
			'mainMenu'=>view('_menu'),
		);
		return view('_main',$data);
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
			'title'=>'ค้นหาสถานประกอบการเพื่อทำ MOU',
			'mainMenu'=>view('_menu'),
            'content'=>view('listBusiness',$data)
		);        

		return view('_main',$data);
	}
}
