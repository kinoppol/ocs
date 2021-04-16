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
		helper('user');
		
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
			'systemName'=>'งานความร่วมมือ',
			'email'=>current_user('email'),
			'dispName'=>current_user('name').' '.current_user('surname'),
			'mainMenu'=>view('_menu'),
			'content'=>view('dashboard',$data),
		);
		return view('_main',$data);
	}
}
