<?php

namespace App\Controllers;

class Business extends BaseController
{
	public function list()
	{
        helper('system');
		$businessModel = model('App\Models\BusinessModel');
		$locationModel = model('App\Models\LocationModel');
        $province_id='10';
        if(isset($_POST['province_id']))$province_id=$_POST['province_id'];
        if(isset($_POST['q'])&&$_POST['q']!=''){
            $data=array(            
                'province'=>$locationModel->getProvince(),
                'district'=>$locationModel->getDistrict(),
                'subdistrict'=>$locationModel->getSubdistrict(),
                'business'=>$businessModel->searchBusiness(['province_id'=>$province_id,'q'=>$_POST['q']]),
            );
        }else{
            $data=array(            
                'province'=>$locationModel->getProvince(),
                'district'=>$locationModel->getDistrict(),
                'subdistrict'=>$locationModel->getSubdistrict(),
                'business'=>$businessModel->searchBusiness(['province_id'=>$province_id]),
            );
        }
		$data=array(
			'title'=>'รายชื่อสถานประกอบการ',
			'mainMenu'=>view('_menu'),
            'content'=>view('listBusiness',$data),
			'notification'=>'',
			'task'=>'',
		);        

		return view('_main',$data);
	}
    public function add(){
		$orgModel = model('App\Models\OrgModel');
        $province = $orgModel->getProvince();
        $data=array(
            'province'=>$province,
        );
		$data=array(
			'title'=>'เพิ่มข้อมูลสถานประกอบการ',
			'mainMenu'=>view('_menu'),
            'content'=>view('businessDetail',$data),
			'notification'=>'',
			'task'=>'',
		);        

		return view('_main',$data);
    }
    public function districtInProvince($province_id){
		$orgModel = model('App\Models\OrgModel');
        $data = $orgModel->getDistrict($province_id);
        return json_encode($data);
    }

    public function subdistrictInDistrict($district_id){
		$orgModel = model('App\Models\OrgModel');
        $data = $orgModel->getSubDistrict($district_id);
        return json_encode($data);
    }

    public function saveBusiness(){
        helper('user');
		$businessModel = model('App\Models\BusinessModel');
        $data=array();
        foreach($_POST as $k=>$v){
            $data[$k]=$v;
        }
        $data['school_id']=current_user('org_code');
        if(isset($_POST['business_id'])&&$_POST['business_id']!=''){
            $result=$businessModel->businessUpdate($_POST['business_id'],$data);
        }else{
            $result=$businessModel->businessAdd($data);
        }
        
		$data=array(
			'title'=>'บันทึกข้อมูลสถานประกอบการ',
			'mainMenu'=>view('_menu'),
            'content'=>$result?'บันทึกข้อมูลสำเร็จ <meta http-equiv="refresh" content="2;url='.site_url('public/business/list').'">':'บันทึกข้อมูลไม่สำเร็จ',
			'notification'=>'',
			'task'=>'',
		);      
		return view('_main',$data);
    }

    public function detail($id){
		$businessModel = model('App\Models\BusinessModel');
        $businessData=$businessModel->getBusiness($id);
        $data=array(
            'businessData'=>$businessData,
        );
		$data=array(
			'title'=>'ข้อมูลสถานประกอบการ',
			'mainMenu'=>view('_menu'),
            'content'=>view('businessDetail',$data),
			'notification'=>'',
			'task'=>'',
		);        

		return view('_main',$data);
    }
}