<?php

namespace App\Controllers;

class User extends BaseController
{
	public function login()
	{
        
        $data=array(
			'title'=>'เข้าสู่ระบบ',
			'systemName'=>'งานความร่วมมือ',
		);
		$data=array(
            'content'=>view('login',$data)
        );
        return view('_authen',$data);
	}

	public function checkLogin(){
		$userModel = model('App\Models\UserModel');
        $data=array(
			'username'=>$_POST['username'],
			'password'=>md5($_POST['password']),
			'user_active'=>'Y'
		);
		$loginTime=time()+3600;// ล็อกอิน 1 ชั่วโมง
		if($_POST['rememberme']=='yes')$loginTime=time()+3600*365;//ล็อกอิน 1 ปี
		$result=$userModel->checkUser($data);
		if($result){
			setcookie("current_user", serialize($result), $loginTime,'/');
			return '<meta http-equiv="refresh" content="0;url='.site_url('public/home/dashboard').'">';
		}else{
			$_SESSION['message']="Username or password Invalid.";
			return '<meta http-equiv="refresh" content="0;url='.site_url('public/user/login').'">';
		}
	}
	public function logout(){
			setcookie("current_user", "", time() - 3600,'/');
			return '<meta http-equiv="refresh" content="0;url='.site_url('public/user/login').'">';
	}
}
