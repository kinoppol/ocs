<?php

namespace App\Controllers;

class Business extends BaseController
{
	public function list()
	{
        helper('system');
		$businessModel = model('App\Models\BusinessModel');
		$locationModel = model('App\Models\LocationModel');
        if(isset($_POST['q'])&&$_POST['q']!=''){
            $data=array(            
                'province'=>$locationModel->getProvince(),
                'district'=>$locationModel->getDistrict(),
                'subdistrict'=>$locationModel->getSubdistrict(),
                'business'=>$businessModel->searchBusiness($_POST['q']),
            );
        }else{
            $data=array(            
                'province'=>$locationModel->getProvince(),
                'district'=>$locationModel->getDistrict(),
                'subdistrict'=>$locationModel->getSubdistrict(),
                'business'=>$businessModel->getBusiness(),
            );
        }
		$data=array(
			'title'=>'รายชื่อสถานประกอบการ',
			'mainMenu'=>view('_menu'),
            'content'=>view('listBusiness',$data)
		);        

		return view('_main',$data);
	}
}