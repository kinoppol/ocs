<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
	public function index()
	{

        helper('system');
		$data=array(
			'title'=>'ภาพรวม',
			'mainMenu'=>'',
			'content'=>view('dashboard/summary'),
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
}
