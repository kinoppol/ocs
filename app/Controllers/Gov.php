<?php

namespace App\Controllers;

class Gov extends BaseController
{
	public function meetingRecode()
	{
		helper('user');
        
		$govModel = model('App\Models\GovModel');
        $data=array(
            'meettingData'=>$govModel->getMeetting(current_user('org_code')),
        );
		$data=array(
			'title'=>'รายงานการประชุม',
			'mainMenu'=>view('_menu'),
            'content'=>view('gov_meetingRecode',$data),
			'notification'=>'',
			'task'=>'',
		);        

		return view('_main',$data);
	}
	public function meettingAdd()
	{
		helper('user');
        
		$govModel = model('App\Models\GovModel');
        $data=array(
            'meettingData'=>$govModel->getMeetting(current_user('org_code')),
        );
		$data=array(
			'title'=>'รายงานการประชุม',
			'mainMenu'=>view('_menu'),
            'content'=>view('gov_meettingDetail',$data),
			'notification'=>'',
			'task'=>'',
		);        

		return view('_main',$data);
	}
	public function detail()
	{
		helper('user');
		$govModel = model('App\Models\GovModel');

		$orgModel = model('App\Models\OrgModel');
		$schools=$orgModel->getSchool();

		$govData=$govModel->getGovData(current_user('org_code'));
		$gov_school_id=explode(',',$govData->gov_school_id);
		
		$schoolModel = model('App\Models\SchoolModel');

		$sumStudentCount=$schoolModel->getSumStudent($gov_school_id);
		$sumStudentDVECount=$schoolModel->getSumStudent($gov_school_id,'dve');

		$data=array(
			'govData'=>$govData,
			'schools'=>$schools,
		);

		$data=array(
			'govData'=>$govData,
			'totalStudent'=>$sumStudentCount->count_val,
			'totalDVEStudent'=>$sumStudentDVECount->count_dve_val,
			'editForm'=>view('editGov',$data),
		);
        $data=array(
			'title'=>'ข้อมูลพื้นฐาน อ.กรอ.อศ.',
			'mainMenu'=>view('_menu'),
            'content'=>'ข้อมูล อ.กรอ.อศ.',
			'notification'=>'',
			'task'=>'',
			'content'=>view('govDetail',$data),
		);
		return view('_main',$data);
	}
    public function saveGov(){

		$orgModel = model('App\Models\OrgModel');
		$data=array();
		//print_r($_POST);
		foreach($_POST as $k=>$v){
			if($k=='gov_school_id'){
				$data[$k]=implode(',',$v);
			}else{
				$data[$k]=$v;
			}
		}
		//print_r($data);
		$result=$orgModel->updateGov($data['gov_id'],$data);
		$data=array(
			'title'=>'บันทึกข้อมูล อ.กรอ.อศ.',
			'mainMenu'=>view('_menu'),
			'notification'=>'',
			'task'=>'',
			'content'=>'บันทึกข้อมูลสำเร็จ<br>โปรดรอสักครู่..<meta http-equiv="refresh" content="1;url='.site_url('public/gov/detail').'">',
		);
		return view('_main',$data);
	}
}