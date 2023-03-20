<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
	public function index()
	{

        helper('system');
        helper('thai');
		$MouModel = model('App\Models\MouModel');
		$data=array(
			'mouCountAll'=>$MouModel->getMouCount(),
			'mouCountActive'=>$MouModel->getMouCount(['active'=>'Y']),
			'mouCountCloseToExpiration'=>$MouModel->getMouCount(['active'=>'Y','ref_date'=>date('Y-m-d',strtotime('+90 days'))]),
			'lastestMOU'=>$MouModel->getMou(['limit'=>10,'orderBy'=>'mou_date desc']),
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

        helper('system');
		$data=array(
			'title'=>'ข้อมูลการลงนามความร่วมมือ',
			'mainMenu'=>'',
			'content'=>view('dashboard/mou'),
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
}
