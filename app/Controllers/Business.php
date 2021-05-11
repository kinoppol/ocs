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
        
		$data=array(
			'title'=>'เพิ่มข้อมูลสถานประกอบการ',
			'mainMenu'=>view('_menu'),
            'content'=>view('businessDetail'),
			'notification'=>'',
			'task'=>'',
		);        

		return view('_main',$data);
    }

    public function saveBusiness(){
		$businessModel = model('App\Models\BusinessModel');
        $data=array();
        foreach($_POST as $k=>$v){
            $data[$k]=$v;
        }
        if(isset($_POST['business_id'])&&$_POST['business_id']!=''){
            $result=$businessModel->businessUpdate($_POST['business_id'],$data);
        }else{
            $result=$businessModel->businessAdd($data);
        }
    }
}