<?php

namespace App\Controllers;

class Admin extends BaseController
{
	public function systemSetting()
	{
		helper('user');
		$data=array(
			'title'=>'ตั้งค่าระบบ',
			'systemName'=>'งานความร่วมมือ',
			'email'=>current_user('email'),
			'dispName'=>current_user('name').' '.current_user('surname'),
			'mainMenu'=>view('_menu'),
		);
		return view('_main',$data);
	}
	public function userManage()
	{
		
		helper('user');
		$data=array(
			'title'=>'จัดการผู้ใช้',
			'systemName'=>'งานความร่วมมือ',
			'email'=>current_user('email'),
			'dispName'=>current_user('name').' '.current_user('surname'),
			'mainMenu'=>view('_menu'),
		);
		return view('_main',$data);
	}
}
