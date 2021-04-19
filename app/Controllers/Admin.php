<?php

namespace App\Controllers;

class Admin extends BaseController
{
	public function systemSetting()
	{
		helper('user');
		$data=array(
			'title'=>'ตั้งค่าระบบ',
			'systemName'=>'ระบบฐานข้อมูลความร่วมมือ',
			'mainMenu'=>view('_menu'),
		);
		return view('_main',$data);
	}
	public function userManage()
	{
		$userModel = model('App\Models\UserModel');
		$data=array(
			'title'=>'ผู้ใช้งานระบบ',
			'user_status'=>'registered',
			'users'=>$userModel->getUsers($onlyRegistered=true),
		);
		$data2=array(
			'title'=>'ผู้ใช้งานที่ยังไม่อนุมัติ',
			'user_status'=>'unregister',
			'registerData'=>$userModel->getRegister(),
			'users'=>$userModel->getUnregisterUsers(),
		);
		$data=array(
			'title'=>'จัดการผู้ใช้',
			'systemName'=>'ระบบฐานข้อมูลความร่วมมือ',
			'mainMenu'=>view('_menu'),
			'content'=>view('manageUser',$data).
			view('manageUser',$data2),
		);

		
		return view('_main',$data);
	}

	public function approveUser($user_id){
		$userModel = model('App\Models\UserModel');
		$userData=$userModel->getUser($user_id);
		$registerData=$userModel->getRegister($user_id);
		//print_r($registerData);
		$data=array(
			'user_type'=>$registerData[0]->user_type,
		);
		$result=$userModel->updateUser($userData->email,$data);
		$data=array(
			'user_id'=>$registerData[0]->user_id,
			'user_type'=>$registerData[0]->user_type,
			'org_code'=>$registerData[0]->org_code,
			'register_status'=>'approved'
		);
		$userModel->register($data);
		return '<meta http-equiv="refresh" content="0;url='.site_url('public/admin/userManage').'">';
	}
	public function disapproveUser($user_id){
		$userModel = model('App\Models\UserModel');
		$registerData=$userModel->getRegister($user_id);
		$data=array(
			'user_id'=>$registerData[0]->user_id,
			'user_type'=>$registerData[0]->user_type,
			'org_code'=>$registerData[0]->org_code,
			'register_status'=>'disapproval'
		);
		$userModel->register($data);
		return '<meta http-equiv="refresh" content="0;url='.site_url('public/admin/userManage').'">';
	}
}
