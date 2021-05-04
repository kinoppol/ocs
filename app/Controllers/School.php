<?php

namespace App\Controllers;

class School extends BaseController
{
	public function detail()
	{
		helper('user');
		$orgModel = model('App\Models\OrgModel');
		$locationModel = model('App\Models\LocationModel');
		$data=array(
			'province'=>$locationModel->getProvince(),
			'district'=>$locationModel->getDistrict(),
			'subdistrict'=>$locationModel->getSubdistrict(),
			'schoolData'=>$orgModel->schoolData(current_user('org_code')),
		);
        $data=array(
			'title'=>'ข้อมูลสถานศึกษา',
			'systemName'=>'ระบบฐานข้อมูลความร่วมมือ',
			'mainMenu'=>view('_menu'),
			'notification'=>'',
			'task'=>'',
			'content'=>view('schoolDetail',$data),
		);
        return view('_main',$data);
    }
}