<?php

namespace App\Controllers;

class School extends BaseController
{
	public function detail()
	{
        $data=array(
			'title'=>'ข้อมูลสถานศึกษา',
			'systemName'=>'ระบบฐานข้อมูลความร่วมมือ',
			'mainMenu'=>view('_menu'),
			'content'=>'-แสดงข้อมูลสถานศึกษา-',
		);
        return view('_main',$data);
    }
}