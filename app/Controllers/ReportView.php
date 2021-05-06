<?php

namespace App\Controllers;

class ReportView extends BaseController
{
	public function school_01($title,$print=false)
	{
		
		if(!isset($title))$title=$_POST['title'];
		helper('report');
		helper('table');
		helper('user');
		helper('org');
		helper('thai');
		$form='
		<div class="row clearfix">
		<form method="post">
		<input type="hidden" name="title" value="'.$title.'">
		<div class="col-lg-2 col-md-6 col-sm-6 col-xs-3">
		ปีที่ลงนาม
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-3">
		<div class="form-group">
		<div class="form-line">'.filterSelectYear('year',false,false,(isset($_POST['year'])?$_POST['year']:false)).'
		</div>
		</div>
		</div>
		<div class="col-lg-2 col-md-6 col-sm-6 col-xs-3">
		<div class="form-group">
		<div class="form-line">
		<button class="btn btn-primary form-control"><i class="material-icons">search</i> ตกลง</button>
		</div>
		</div>
		</div>
		<div class="col-lg-2 col-md-6 col-sm-6 col-xs-3">
		<div class="form-group">
		<div class="form-line">
		<button name="export" formaction="'.$title.'/print" formtarget="_blank" class="btn btn-danger form-control"><i class="material-icons">picture_as_pdf</i> พิมพ์รายงาน</button>
		</div>
		</div>
		</div>
		</form>
		</div>';
		$result='';
		$resultHead=array(
			'สถานประกอบการ',
			'หน่วยงานภาครัฐ',
			'วันที่ลงนาม',
			'สถานที่ลงนาม',
		);
		if(isset($_POST['year'])){

			$mouModel = model('App\Models\MouModel');
			$resultData=$mouModel->getMou(['year'=>$_POST['year'],
											'school_id'=>current_user('org_code')]);
			
			$school=$resultData['school'];
			$business=$resultData['business'];
			$gov=$resultData['gov'];
			$resultRows=array();
			foreach ($resultData['mou'] as $mou){
				$mou = get_object_vars($mou);

				$org_name='';
					if(isset($school[$mou['school_id']]))$org_name=$school[$mou['school_id']];
					else if(isset($gov[$mou['school_id']]))$org_name=$gov[$mou['school_id']];

				$resultRows[]=array(
					'business_id'=>$business[$mou['business_id']],
					'school_id'=>$org_name,
					'mou_date'=>dateThai($mou['mou_date'],true,false,true),
					'mou_sign_place'=>$mou['mou_sign_place'],
				);
			}

			$mouArr=array('thead'=>$resultHead,
					'tbody'=>$resultRows,
			);
			$result=genTable($mouArr,$export=true);
		}else{

			$result='โปรดกดปุม "ตกลง" เพื่อดูรายงาน';
		}
		$data=array(
			'form'=>$form,
			'result'=>$result,
		);
		if($print==false){
		$data=array(
			'title'=>$title,
			'mainMenu'=>view('_menu'),
            'content'=>view('reportView',$data),
			'notification'=>'',
			'task'=>'',
		);
		}else{
			error_reporting(0);
			helper('mpdf');
			//return $result;
			$pdf_data=array(
				'html'=>$result,
				'size'=>"A4-L",
				'fontsize'=>16,
				'marginL'=>20,
				'marginR'=>10,
				'marginT'=>10,
				'marginB'=>10,
				'header'=>'',
				'wartermark'=>'',
				'wartermarkimage'=>'',
				'footer'=>'เอกสารนี้ออกโดย'.SYSTEMNAME.' สำนักความร่วมมือ สำนักงานคณะกรรมการการอาชีวศึกษา '.date('Y-m-d H:i:s'),
				//'header'=>'<div style="text-align: right; font-weight: normal;">หน้า {PAGENO}/{nbpg}</div>'
			);
			$location=FCPATH.'/pdf/';
			$fname=current_user('org_code').'_school_01.pdf';
			$filePdf=genPdf($pdf_data,$pageNo=NULL,$location,$fname);
			//return '';
			return '<meta http-equiv="refresh" content="0;url='.site_url('public/pdf/'.$filePdf).'?'.time().'">';
		}
		return view('_main',$data);
	}
}