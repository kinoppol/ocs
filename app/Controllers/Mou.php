<?php

namespace App\Controllers;

class Mou extends BaseController
{
	public function list()
	{
		$mouModel = model('App\Models\MouModel');
		$data=array(
			'data'=>$mouModel->getMou(),
		);
		$data=array(
			'title'=>'รายการความร่วมมือ',
			'systemName'=>'งานความร่วมมือ',
			'mainMenu'=>view('_menu'),
			'content'=>view('listMou',$data),
		);
		return view('_main',$data);
	}
	public function search()
	{
	
		$data=array(
			'title'=>'ค้นหาข้อมูลความร่วมมือ',
			'systemName'=>'งานความร่วมมือ',
			'mainMenu'=>view('_menu'),
		);
		return view('_main',$data);
	}
	
	public function pdf()
	{		
		$mouModel = model('App\Models\MouModel');
		$data=array();
		return view('mouPDF',$data);
	}
}
