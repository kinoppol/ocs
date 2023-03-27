<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
	public function index()
	{

        helper('system');
		$MouModel = model('App\Models\MouModel');
		$data=array(
			'resultMOU'=>$MouModel->getMou(['limit'=>10,'orderBy'=>'mou_date desc']),
		);
		$data=array(
			'mouCountAll'=>$MouModel->getMouCount(),
			'mouCountActive'=>$MouModel->getMouCount(['active'=>'Y']),
			'mouCountActiveOver90Days'=>$MouModel->getMouCount(['active'=>'Y','ref_date'=>date('Y-m-d',strtotime('+90 days'))]),
			'mouTable'=>view('dashboard/mouTable',$data),
		);
		$data=array(
			'title'=>'ภาพรวม',
			'mainMenu'=>'',
			'content'=>view('dashboard/summary',$data),
			'notification'=>'',
			'task'=>'',
		);
		return view('landing/_template',$data);
	}
	public function mou()
	{
		$MouModel = model('App\Models\MouModel');
		$detail=array();
		if(!empty($_POST['q'])){
			$detail['keyword']=$_POST['q'];
			
		}
		if(!empty($_GET['s'])){
			if($_GET['s']=='aval'){
				$detail['active']='Y';
			}else if($_GET['s']=='mexp'){
				$detail['active']='C';
				$detail['ref_date']=date('Y-m-d',strtotime('+90 days'));
			}else if($_GET['s']=='exp'){
				$detail['active']='N';
			}
		}

		if(!empty($_POST['aval'])&&!empty($_POST['mexp'])&&!empty($_POST['exp'])){
			//print 'DEFAULT';
		}else if(!empty($_POST['exp'])&&empty($_POST['aval'])&&empty($_POST['mexp'])){
			$detail['active']='N';
		}else if(empty($_POST['exp'])&&empty($_POST['aval'])&&!empty($_POST['mexp'])){
			$detail['active']='C';
			$detail['ref_date']=date('Y-m-d',strtotime('+90 days'));
			//print 555;
		}else if(empty($_POST['exp'])&&!empty($_POST['aval'])&&empty($_POST['mexp'])){
			$detail['active']='Y';
		}
		//print_r($detail);
		$province_code='';
		if(!empty($_POST['province_code'])){
			$province_code=$_POST['province_code'];
		}
		
		if(!empty($_GET['province'])){
			$province_code=$_GET['province'];
		}
		if(!empty($province_code)){
			$detail['province_code']=$province_code;
		}

			if(!empty($detail)){
				//print_r($detail);
				if(isset($detail['active'])&&$detail['active']=='Y'&&empty($_POST['q'])&&empty($detail['province_code'])){

					$data=array(
						'resultMOU'=>'',
					);
				}else{
					$data=array(
						'resultMOU'=>$MouModel->getMou($detail),
					);
				}
			
			}else{
				$data=array(
					'resultMOU'=>'',
				);
			}
			
			$orgModel = model('App\Models\OrgModel');
			$province = $orgModel->getProvince();

			$data=array(
				'province_code'=>$province_code,
				'province'=>$province,
				//'resultMOU'=>$MouModel->getMou($detail),
				'mouTable'=>view('dashboard/mouTable',$data),
			);
        helper('system');
		
		$data=array(
			'title'=>'ข้อมูลการลงนามความร่วมมือ',
			'mainMenu'=>'',
			'content'=>view('dashboard/mou',$data),
			'notification'=>'',
			'task'=>'',
		);
		return view('landing/_template',$data);
	}
	public function business()
	{

        helper('system');
		$data=array(
			'title'=>'ข้อมูลสถานประกอบการ',
			'mainMenu'=>'',
			'content'=>view('dashboard/business'),
			'notification'=>'',
			'task'=>'',
		);
		return view('landing/_template',$data);
	}
	public function school()
	{

        helper('system');
		$data=array(
			'title'=>'ข้อมูลสถานศึกษา',
			'mainMenu'=>'',
			'content'=>view('dashboard/school'),
			'notification'=>'',
			'task'=>'',
		);
		return view('landing/_template',$data);
	}
	public function inv()
	{

        helper('system');
		$data=array(
			'title'=>'ข้อมูล อ.กรอ.อศ.',
			'mainMenu'=>'',
			'content'=>view('dashboard/inv'),
			'notification'=>'',
			'task'=>'',
		);
		return view('landing/_template',$data);
	}
	public function about()
	{

        helper('system');
		$data=array(
			'title'=>'เกี่ยวกับระบบ',
			'mainMenu'=>'',
			'content'=>view('dashboard/about'),
			'notification'=>'',
			'task'=>'',
		);
		return view('landing/_template',$data);
	}
	public function map(){
		
		$ProvinceModel = model('App\Models\ProvinceModel');
		$data=array(
			'mou'=>$ProvinceModel->getProvinceMouCount(),
		);
		return view('dashboard/map',$data);
	} 
	public function mapdata()
	{
		
		$ProvinceModel = model('App\Models\ProvinceModel');
		$data=array(
			'provinces'=>$ProvinceModel->getProvince(),
			'mou'=>$ProvinceModel->getProvinceMouCount(),
		);
		return view('dashboard/mapdata',$data);
	}
}
