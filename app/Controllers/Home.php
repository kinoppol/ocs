<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		return view('welcome_message');
	}
	public function dashboard()
	{
		$data=array(
			'title'=>'ภาพรวม',
			'systemName'=>'งานความร่วมมือ',
			'mainMenu'=>view('_menu')
		);
		return view('_main',$data);
	}
}
