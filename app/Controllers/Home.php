<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		//$this->load->helper('url');
		return view('welcome_message');
	}
	public function dashboard()
	{
		
		$MouModel = model('App\Models\MouModel');
		
		
		$currentYear=date('Y');
		

		$data=array(
			'year'=>$currentYear,
			'mouCount'=>$MouModel->getMouCount(),
			'mouLastYearCount'=>$MouModel->getMouYearCount($currentYear-1),
			'mouYearCount'=>$MouModel->getMouYearCount($currentYear),
			'businessCount'=>$MouModel->getBusinessCount(),
		);
		$data=array(
			'title'=>'ภาพรวม',
			'systemName'=>'ระบบฐานข้อมูลความร่วมมือ',
			'mainMenu'=>view('_menu'),
			'content'=>view('dashboard',$data),
		);
		return view('_main',$data);
	}
}
