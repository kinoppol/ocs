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
			'mouCountVec'=>$MouModel->getMouCount(['active'=>'Y','level'=>'vec']),
			'mouCountInstitute'=>$MouModel->getMouCount(['active'=>'Y','level'=>'institute']),
			'mouCountSchool'=>$MouModel->getMouCount(['active'=>'Y','level'=>'school']),'mouCountGov'=>$MouModel->getMouCount(['active'=>'Y','level'=>'gov']),
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
		if(empty($_POST['spc'])){
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

			if(empty($_POST['status'])){
				//print 'DEFAULT';
			}else if(!empty($_POST['status'])&&$_POST['status']=='avaliable'){
				$detail['active']='Y';
			}else if(!empty($_POST['status'])&&$_POST['status']=='closeExpire'){
				$detail['active']='C';
				$detail['ref_date']=date('Y-m-d',strtotime('+90 days'));
				//print 555;
			}else if(!empty($_POST['status'])&&$_POST['status']=='expired'){
				$detail['active']='N';
			}
			//print_r($detail);
		}else{
			$detail['ref_date']=$_POST['end_date'];
			$detail['available_date']=$_POST['start_date'];
		}
		if(!empty($_POST['level'])){
			$detail['level']=$_POST['level'];
		}
		if(!empty($_GET['l'])){
			$detail['level']=$_GET['l'];
		}

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
				'level'=>!empty($detail['level'])?$detail['level']:'',
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
		
		$businessModel = model('App\Models\BusinessModel');
		$locationModel = model('App\Models\LocationModel');
		$MouModel = model('App\Models\MouModel');
		$orgModel = model('App\Models\OrgModel');
		$province = $orgModel->getProvince();

		$province_code='';
		if(!empty($_POST['province_code'])){
			$province_code=$_POST['province_code'];
		}

		$province=$locationModel->getProvince();
		if(empty($_POST['q'])){
			$business=array();			
		}else{
			$business=$businessModel->searchBusiness(['province_id'=>$_POST['province_code'],'q'=>$_POST['q']]);
		}
		$mc=array();
		foreach($business as $b){
			//print $b['business_id'];
			$c=$MouModel->getMouCount(['business_id'=>$b['business_id']]);
			//print $c;
			$mc[$b['business_id']]=$c;
		}
		//print_r($mc);
		if(!empty($_POST['q'])){
			$data=array(
				'business'=>$business,
				'province_code'=>$province_code,
				'province'=>$province,
				'mouCount'=>$mc,
			);
			$data=array(
				'businessTable'=>view('dashboard/businessTable',$data),
			);
		}else{
			$data=array(
				'province_code'=>$province_code,
				'province'=>$province,
			);
		}
		$data=array(
			'title'=>'รายชื่อสถานประกอบการ',
			'mainMenu'=>'',
            'content'=>view('dashboard/business',$data),
			'notification'=>'',
			'task'=>'',
		);        
		/*
		$data=array(
			'title'=>'ข้อมูลสถานประกอบการ',
			'mainMenu'=>'',
			'content'=>view('dashboard/business'),
			'notification'=>'',
			'task'=>'',
		);*/
		return view('landing/_template',$data);
	}
	public function school()
	{
		
		$orgModel = model('App\Models\OrgModel');
		$MouModel = model('App\Models\MouModel');
		$province = $orgModel->getProvince();
		$sc=$orgModel->getSchool();
		$school=array();		
		$mc=array();
		foreach($sc as $k=>$v){
			$school[$k]=$orgModel->schoolData($k);
			$c=$MouModel->getMouCount(['org_code'=>$k]);
			$mc[$k]=$c;
		}

		$data=array(
			'school'=>$school,
			'province'=>$province,
			'mouCount'=>$mc,
		);
		
		
		$data=array(
			'schoolTable'=>view('dashboard/schoolTable',$data),
		);
        helper('system');
		$data=array(
			'title'=>'ข้อมูลสถานศึกษา',
			'mainMenu'=>'',
			'content'=>view('dashboard/school',$data),
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
