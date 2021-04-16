<?php

namespace App\Controllers;

class Mou extends BaseController
{
	public function list()
	{
		helper('user');
		$data=array(
			'title'=>'รายการความร่วมมือ',
			'systemName'=>'งานความร่วมมือ',
			'email'=>current_user('email'),
			'dispName'=>current_user('name').' '.current_user('surname'),
			'mainMenu'=>view('_menu'),
			'content'=>view('listMou'),
		);
		return view('_main',$data);
	}
	public function search()
	{
		
		helper('user');
		$data=array(
			'title'=>'ค้นห้าข้อมูลความร่วมมือ',
			'systemName'=>'งานความร่วมมือ',
			'email'=>current_user('email'),
			'dispName'=>current_user('name').' '.current_user('surname'),
			'mainMenu'=>view('_menu'),
		);
		return view('_main',$data);
	}
}
