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
            //'content'=>view('login',$data)
			'content'=>view('ggLogin',$data)
        );
        return view('_authen',$data);
	}
	public function checkGoogle(){
		$userModel = model('App\Models\UserModel');
		helper('google');
		$result=checkToken($_POST);
		if($result['status']=='ok'){
			$user=$userModel->checkEmail($result['data']['email']);
			
			$loginTime=time()+3600;
			if(count($user)>=1){
				$data=array(
					'name'=>$result['data']['given_name'],
					'surname'=>$result['data']['family_name'],
					'picture'=>$result['data']['picture'],
				);
				$userModel->updateUser($result['data']['email'],$data);
			}else{
				$data=array(
				'username'=>$result['data']['email'],
				'email'=>$result['data']['email'],
				'name'=>$result['data']['given_name'],
				'surname'=>$result['data']['family_name'],
				'password'=>md5(time()),
				'picture'=>$result['data']['picture'],
			);				
				$userModel->addUser($data);
			}
			$user=$userModel->checkEmail($result['data']['email']);
			setcookie("current_user", serialize($user), $loginTime,'/');
		}
		return json_encode($result);
	}

	public function register(){
		$data=array(
			'title'=>'ลงทะเบียนผู้ใช้งาน',
			'systemName'=>'งานความร่วมมือ',
			'mainMenu'=>view('_menu'),
			'content'=>view('register')
		);
        return view('_main',$data);
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
