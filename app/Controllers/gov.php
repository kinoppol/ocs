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

		$data=array(
			'title'=>'ข้อมูลพื้นฐาน อ.กรอ.อศ.',
			'mainMenu'=>view('_menu'),
            'content'=>'ข้อมูล อ.กรอ.อศ.',
			'notification'=>'',
			'task'=>'',
		);        

		return view('_main',$data);
	}
}