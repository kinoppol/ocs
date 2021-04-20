<?php

namespace App\Controllers;

class Report extends BaseController
{
	public function list()
	{
		helper('user');
		$data=array(
			'title'=>'รายงานผลการดำเนินงาน',
			'mainMenu'=>view('_menu'),
            'content'=>view('report'),
		);
		return view('_main',$data);
	}
}