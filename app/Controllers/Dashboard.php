<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
	public function index()
	{

		$data=array(
			'title'=>'ภาพรวม',
			'mainMenu'=>view('_menu'),
			'content'=>view('dashboard/summary'),
			'notification'=>'',
			'task'=>'',
		);
		return view('_main',$data);
	}
}
