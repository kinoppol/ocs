<?php

namespace App\Controllers;

class Gov extends BaseController
{
	public function meettingRecord()
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
	public function saveMeetting(){

		$govModel = model('App\Models\GovModel');

		$data=array();
		foreach($_POST as $k=>$v){
				$data[$k]=$v;
		}
		helper('user');
		$data['recorder_id']=current_user('user_id');
		$data['gov_id']=current_user('org_code');
		$data['record_time']=date('y-m-d H:i:s');

		if(!isset($_POST['id'])){
			$file_name=$result=$govModel->meettingAdd($data);
		}else{
			$result=$govModel->meettingUpdate($_POST['id'],$data);
			$file_name=$govModel->$_POST['id'];
		}

		$mettingFilePath=FCPATH.'../meettingRecord/';

		if($_FILES['meettingRecord']['type']=='application/pdf'){
			$meettingRecord=$mettingFilePath.'doc/'.$file_name.'.pdf';
			move_uploaded_file($_FILES['meettingRecord']['tmp_name'],$meettingRecord);
		}
		//เรียง Array File ภาพ ใหม่
		$hFiles=array();
		$hFiles['pictures']=array();
		foreach($_FILES['pictures'] as $k=>$v){
			foreach($v as $sk=>$sv){
				$hFiles['pictures'][$sk][$k]=$sv;
			}
		}

		$pictures=array();
		$i=0;
		foreach($hFiles['pictures'] as $pic){
			if($pic['type']!='image/jpeg')continue;
			$i++;
			$picture=$mettingFilePath.'images/'.$file_name.'_'.$i.'.jpg';
			$pictures[]=$picture;
			move_uploaded_file($pic['tmp_name'],$picture);
		}
		//อัพเดตข้อมูลไฟล์แนบ
			$mRecord_id=$file_name;
			$data=array(
				'meettingRecord'=>$meettingRecord,
				'pictures'=>implode(',',$pictures),
			);
			$govModel->meettingUpdate($mRecord_id,$data);

		$data=array(
			'title'=>'บันทึกข้อมูลการประชุม อ.กรอ.อศ.',
			'mainMenu'=>view('_menu'),
			'notification'=>'',
			'task'=>'',
			'content'=>'บันทึกข้อมูลสำเร็จ<br>โปรดรอสักครู่..<meta http-equiv="refresh" content="1;url='.site_url('public/gov/meettingRecord').'">',
		);
		return view('_main',$data);
	}
}