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
		//print_r(unserialize($_COOKIE['current_user']));
		helper('user');
		$MouModel = model('App\Models\MouModel');
		$orgModel = model('App\Models\OrgModel');
		
		$schools=$orgModel->getSchool();
		$govs=$orgModel->getGov();
		$institute=$orgModel->getInstitute();
		
		$org_name='';
		if(isset($schools[current_user('org_code')]))$org_name=$schools[current_user('org_code')];
		else if(isset($govs[current_user('org_code')]))$org_name=$govs[current_user('org_code')];
		else if(isset($institute[current_user('org_code')]))$org_name=$institute[current_user('org_code')];
		else $org_name='ท่าน';
		$currentYear=date('Y');
		

		$data=array(
			'title'=>'',
			'year'=>$currentYear,
			'mouCount'=>$MouModel->getMouCount(),
			'mouLastYearCount'=>$MouModel->getMouYearCount(['year'=>$currentYear-1]),
			'mouYearCount'=>$MouModel->getMouYearCount(['year'=>$currentYear]),
			'businessCount'=>$MouModel->getBusinessCount(),
		);		
		$data2=array(
			'title'=>'ส่วนของ'.$org_name,
			'year'=>$currentYear,
			'mouCount'=>$MouModel->getMouCount(['org_code'=>current_user('org_code')]),
			'mouLastYearCount'=>$MouModel->getMouYearCount(['org_code'=>current_user('org_code'),'year'=>$currentYear-1]),
			'mouYearCount'=>$MouModel->getMouYearCount(['org_code'=>current_user('org_code'),'year'=>$currentYear]),
			'businessCount'=>$MouModel->getBusinessCount(['org_code'=>current_user('org_code')]),
		);

		$data=array(
			'title'=>'ภาพรวม',
			'mainMenu'=>view('_menu'),
			'content'=>view('dashboard',$data).view('dashboard',$data2),
		);
		return view('_main',$data);
	}
}
