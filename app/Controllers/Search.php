<?php

namespace App\Controllers;

class Search extends BaseController
{
	public function result()
	{
		helper('user');
		$data=array(
			'title'=>'ผลลัพธ์การค้นหา',
			'systemName'=>'งานความร่วมมือ',
			'email'=>current_user('email'),
			'dispName'=>current_user('name').' '.current_user('surname'),
			'mainMenu'=>view('_menu'),
		);
		return view('_main',$data);
	}
}
