<?php

namespace App\Controllers;

class ReportGov extends BaseController
{
	public function gov_01($title,$print=false)
	{
		
		if(!isset($title))$title=$_POST['title'];
		helper('report');
		helper('table');
		helper('user');
		helper('org');
		helper('thai');
		
		$org_code=current_user('org_code');
		$org_name=org_name(current_user('org_code'));
		$data=array(
			'org_code'=>$org_code,
			'org_name'=>$org_name,
		);
		$org_type_name=org_type_name($data);
		$signBox=signBox($data);

		$form='
		<div class="row clearfix">
		<form method="post">
		<input type="hidden" name="title" value="'.$title.'">
		<div class="col-lg-2 col-md-6 col-sm-6 col-xs-3">
		ปีที่ประชุม
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
			'ครั้งที่',
			'วันที่ประชุม',
			'สถานที่ประชุม',
			'หัวข้อการประชุม',
			'หมายเหตุ',
		);
		if(isset($_POST['year'])){

			$caption='<b>'.$title.' ปี '.($_POST['year']+543).'</b><br>'.$org_name;


		    $govModel = model('App\Models\GovModel');
            $resultData=$govModel->getMeetting(['gov_id'=>current_user('org_code'),'year'=>$_POST['year']]);
			$i=0;
            $resultRows=array();
			foreach ($resultData as $meetting){
				$i++;
				$resultRows[]=array(
					$i,
					'meetting_date'=>dateThai($meetting['meetting_date'],true,false,true),
					'meetting_place'=>$meetting['meetting_place'],
					'subject'=>$meetting['subject'],
					'note'=>'',
				);
			}

			$mouArr=array(
					'caption'=>$caption,
					'thead'=>$resultHead,
					'tbody'=>$resultRows,
			);
			$result=genTable($mouArr,$export=true,$noFoot=true);
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
			$result.=$signBox;
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
				'header'=>'<div style="text-align: right; font-weight: normal;"><br> หน้า{PAGENO}/{nbpg}</div>'
			);
			$location=FCPATH.'/pdf/';
			$fname=current_user('org_code').'_school_01.pdf';
			$filePdf=genPdf($pdf_data,$pageNo=NULL,$location,$fname);
			//return '';
			return '<meta http-equiv="refresh" content="0;url='.site_url('public/pdf/'.$filePdf).'?'.time().'">';
		}
		return view('_main',$data);
	}

	public function gov_06($title,$print=false)
	{
		
		if(!isset($title))$title=$_POST['title'];
		helper('report');
		helper('table');
		helper('user');
		helper('org');
		helper('thai');
		
		$org_code=current_user('org_code');
		$org_name=org_name(current_user('org_code'));
		$data=array(
			'org_code'=>$org_code,
			'org_name'=>$org_name,
		);
		$org_type_name=org_type_name($data);
		$signBox=signBox($data);

		$form='
		<div class="row clearfix">
		<form method="post">
		<input type="hidden" name="title" value="'.$title.'">
		<div class="col-lg-2 col-md-6 col-sm-6 col-xs-3">
		ปีที่พัฒนาครูฝึก
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
			'ครั้งที่',
			'วันที่ประชุม',
			'สถานที่ประชุม',
			'หัวข้อการประชุม',
			'จำนวนผู้เข้า<br>รับการพัฒนา',
			'หมายเหตุ',
		);
		if(isset($_POST['year'])){

			$caption='<b>'.$title.' ปี '.($_POST['year']+543).'</b><br>'.$org_name;

			$data=array(
				'gov_id'=>current_user('org_code'),
				'year'=>$_POST['year'],
			);
		    $govModel = model('App\Models\GovModel');
            $resultData=$govModel->getTrainerDev($data);
			$i=0;
            $resultRows=array();
			foreach ($resultData as $td){
				$i++;
				$resultRows[]=array(
					$i,
					'dev_date'=>dateThai($td->start_date,true,false,true).' ถึง <br>'.dateThai($td->end_date,true,false,true),
					'dev_place'=>$td->dev_place,
					'subject'=>$td->subject,
					'person_count'=>0,
					'note'=>'',
				);
			}

			$mouArr=array(
					'caption'=>$caption,
					'thead'=>$resultHead,
					'tbody'=>$resultRows,
			);
			$result=genTable($mouArr,$export=true,$noFoot=true);
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
			$result.=$signBox;
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
				'header'=>'<div style="text-align: right; font-weight: normal;"><b>แบบฟอร์มที่ 6</b><br> หน้า{PAGENO}/{nbpg}</div>'
			);
			$location=FCPATH.'/pdf/';
			$fname=current_user('org_code').'_school_01.pdf';
			$filePdf=genPdf($pdf_data,$pageNo=NULL,$location,$fname);
			//return '';
			return '<meta http-equiv="refresh" content="0;url='.site_url('public/pdf/'.$filePdf).'?'.time().'">';
		}
		return view('_main',$data);
	}
	
	public function gov_07($title,$print=false)
	{
		
		if(!isset($title))$title=$_POST['title'];
		helper('report');
		helper('table');
		helper('user');
		helper('org');
		helper('thai');
		
		$org_code=current_user('org_code');
		$org_name=org_name(current_user('org_code'));
		$data=array(
			'org_code'=>$org_code,
			'org_name'=>$org_name,
		);
		$org_type_name=org_type_name($data);
		$signBox=signBox($data);

		$form='
		<div class="row clearfix">
		<form method="post">
		<input type="hidden" name="title" value="'.$title.'">
		<div class="col-lg-2 col-md-6 col-sm-6 col-xs-3">
		ปีที่ประชาสัมพันธ์
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
			'ครั้งที่',
			'ระยะเวลาดำเนินการ',
			'สถานที่ประชาสัมพันธ์',
			'วิธีการประชาสัมพันธ์',
			'จำนวนผู้เรียน<br>เป้าหมาย (คน)',
			'จำนวนผู้เรียน<br>ที่สมัครเรียน (คน)',
		);
		if(isset($_POST['year'])){

			$caption='<b>'.$title.' ปี '.($_POST['year']+543).'</b><br>'.$org_name;

			$data=array(
				'gov_id'=>current_user('org_code'),
				'year'=>$_POST['year'],
			);
		    $govModel = model('App\Models\GovModel');
            $resultData=$govModel->getPublic($data);
			$i=0;
            $resultRows=array();
			foreach ($resultData as $pr){
				$i++;
				$resultRows[]=array(
					$i,
					'date'=>dateThai($pr->start_date,true,false,true).' ถึง <br>'.dateThai($pr->end_date,true,false,true),
					'place'=>$pr->public_place,
					'method'=>$pr->public_method,
					'student_target'=>$pr->student_target,
					'student_apply'=>$pr->student_apply,
				);
			}

			$mouArr=array(
					'caption'=>$caption,
					'thead'=>$resultHead,
					'tbody'=>$resultRows,
			);
			$result=genTable($mouArr,$export=true,$noFoot=true);
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
			$result.=$signBox;
			error_reporting(0);
			helper('mpdf');
			//return $result;
			$pdf_data=array(
				'html'=>$result,
				'size'=>"A4",
				'fontsize'=>16,
				'marginL'=>20,
				'marginR'=>10,
				'marginT'=>10,
				'marginB'=>10,
				'header'=>'',
				'wartermark'=>'',
				'wartermarkimage'=>'',
				'footer'=>'เอกสารนี้ออกโดย'.SYSTEMNAME.' สำนักความร่วมมือ สำนักงานคณะกรรมการการอาชีวศึกษา '.date('Y-m-d H:i:s'),
				'header'=>'<div style="text-align: right; font-weight: normal;"><b>แบบฟอร์มที่ 7</b><br> หน้า{PAGENO}/{nbpg}</div>'
			);
			$location=FCPATH.'/pdf/';
			$fname=current_user('org_code').'_school_01.pdf';
			$filePdf=genPdf($pdf_data,$pageNo=NULL,$location,$fname);
			//return '';
			return '<meta http-equiv="refresh" content="0;url='.site_url('public/pdf/'.$filePdf).'?'.time().'">';
		}
		return view('_main',$data);
	}

	public function gov_08($title,$print=false)
	{
		
		if(!isset($title))$title=$_POST['title'];
		helper('report');
		helper('table');
		helper('user');
		helper('org');
		helper('thai');
		
		$org_code=current_user('org_code');
		$org_name=org_name(current_user('org_code'));
		$data=array(
			'org_code'=>$org_code,
			'org_name'=>$org_name,
		);
		$org_type_name=org_type_name($data);
		$signBox=signBox($data);

		$form='
		<div class="row clearfix">
		<form method="post">
		<input type="hidden" name="title" value="'.$title.'">
		<div class="col-lg-2 col-md-6 col-sm-6 col-xs-3">
		ปีที่ครูผู้สอนในสถานศึกษา
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
			'ครั้งที่',
			'ระยะเวลาดำเนินการ',
			'สถานที่ดำเนินการ',
			'หัวข้อการอบรม',
			'จำนวนผู้<br>เข้ารับการอบรม (คน)',
			'หมายเหตุ',
		);
		if(isset($_POST['year'])){

			$caption='<b>'.$title.' ปี '.($_POST['year']+543).'</b><br>'.$org_name;

			$data=array(
				'gov_id'=>current_user('org_code'),
				'year'=>$_POST['year'],
			);
		    $govModel = model('App\Models\GovModel');
            $resultData=$govModel->getTeacherDev($data);
			$i=0;
            $resultRows=array();
			foreach ($resultData as $td){
				$i++;
				$resultRows[]=array(
					$i,
					'date'=>dateThai($td->start_date,true,false,true).' ถึง <br>'.dateThai($td->end_date,true,false,true),
					'place'=>$td->dev_place,
					'subject'=>$td->subject,
					'person'=>$td->person,
					'note'=>'',
				);
			}

			$mouArr=array(
					'caption'=>$caption,
					'thead'=>$resultHead,
					'tbody'=>$resultRows,
			);
			$result=genTable($mouArr,$export=true,$noFoot=true);
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
			$result.=$signBox;
			error_reporting(0);
			helper('mpdf');
			//return $result;
			$pdf_data=array(
				'html'=>$result,
				'size'=>"A4",
				'fontsize'=>16,
				'marginL'=>20,
				'marginR'=>10,
				'marginT'=>10,
				'marginB'=>10,
				'header'=>'',
				'wartermark'=>'',
				'wartermarkimage'=>'',
				'footer'=>'เอกสารนี้ออกโดย'.SYSTEMNAME.' สำนักความร่วมมือ สำนักงานคณะกรรมการการอาชีวศึกษา '.date('Y-m-d H:i:s'),
				'header'=>'<div style="text-align: right; font-weight: normal;"><b>แบบฟอร์มที่ 8</b><br> หน้า{PAGENO}/{nbpg}</div>'
			);
			$location=FCPATH.'/pdf/';
			$fname=current_user('org_code').'_school_01.pdf';
			$filePdf=genPdf($pdf_data,$pageNo=NULL,$location,$fname);
			//return '';
			return '<meta http-equiv="refresh" content="0;url='.site_url('public/pdf/'.$filePdf).'?'.time().'">';
		}
		return view('_main',$data);
	}

	public function gov_09($title,$print=false)
	{
		
		if(!isset($title))$title=$_POST['title'];
		helper('report');
		helper('table');
		helper('user');
		helper('org');
		helper('thai');
		
		$org_code=current_user('org_code');
		$org_name=org_name(current_user('org_code'));
		$data=array(
			'org_code'=>$org_code,
			'org_name'=>$org_name,
		);
		$org_type_name=org_type_name($data);
		$signBox=signBox($data);

		$form='
		<div class="row clearfix">
		<form method="post">
		<input type="hidden" name="title" value="'.$title.'">
		<div class="col-lg-2 col-md-6 col-sm-6 col-xs-3">
		ปีที่พัฒนาผู้เรียน
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
			'ครั้งที่',
			'ระยะเวลาดำเนินการ',
			'สถานที่ดำเนินการ',
			'หัวข้อการอบรม',
			'จำนวนผู้<br>เข้ารับการอบรม (คน)',
			'หมายเหตุ',
		);
		if(isset($_POST['year'])){

			$caption='<b>'.$title.' ปี '.($_POST['year']+543).'</b><br>'.$org_name;

			$data=array(
				'gov_id'=>current_user('org_code'),
				'year'=>$_POST['year'],
			);
		    $govModel = model('App\Models\GovModel');
            $resultData=$govModel->getStudentDev($data);
			$i=0;
            $resultRows=array();
			foreach ($resultData as $td){
				$i++;
				$resultRows[]=array(
					$i,
					'date'=>dateThai($td->start_date,true,false,true).' ถึง <br>'.dateThai($td->end_date,true,false,true),
					'place'=>$td->dev_place,
					'subject'=>$td->subject,
					'person'=>$td->person,
					'note'=>'',
				);
			}

			$mouArr=array(
					'caption'=>$caption,
					'thead'=>$resultHead,
					'tbody'=>$resultRows,
			);
			$result=genTable($mouArr,$export=true,$noFoot=true);
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
			$result.=$signBox;
			error_reporting(0);
			helper('mpdf');
			//return $result;
			$pdf_data=array(
				'html'=>$result,
				'size'=>"A4",
				'fontsize'=>16,
				'marginL'=>20,
				'marginR'=>10,
				'marginT'=>10,
				'marginB'=>10,
				'header'=>'',
				'wartermark'=>'',
				'wartermarkimage'=>'',
				'footer'=>'เอกสารนี้ออกโดย'.SYSTEMNAME.' สำนักความร่วมมือ สำนักงานคณะกรรมการการอาชีวศึกษา '.date('Y-m-d H:i:s'),
				'header'=>'<div style="text-align: right; font-weight: normal;"><b>แบบฟอร์มที่ 9</b><br> หน้า{PAGENO}/{nbpg}</div>'
			);
			$location=FCPATH.'/pdf/';
			$fname=current_user('org_code').'_school_01.pdf';
			$filePdf=genPdf($pdf_data,$pageNo=NULL,$location,$fname);
			//return '';
			return '<meta http-equiv="refresh" content="0;url='.site_url('public/pdf/'.$filePdf).'?'.time().'">';
		}
		return view('_main',$data);
	}


	public function gov_10($title,$print=false)
	{
		
		if(!isset($title))$title=$_POST['title'];
		helper('report');
		helper('table');
		helper('user');
		helper('org');
		helper('thai');
		
		$org_code=current_user('org_code');
		$org_name=org_name(current_user('org_code'));
		$data=array(
			'org_code'=>$org_code,
			'org_name'=>$org_name,
		);
		$org_type_name=org_type_name($data);
		$signBox=signBox($data);

		$form='
		<div class="row clearfix">
		<form method="post">
		<input type="hidden" name="title" value="'.$title.'">
		<div class="col-lg-2 col-md-6 col-sm-6 col-xs-3">
		ปีที่ดำเนินโครงการ
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
			'ครั้งที่',
			'โครงการ',
			'ระยะเวลาดำเนินการ',
			'สถานที่ดำเนินการ',
			'วิธีดำเนินการ',
			'วัตถุประสงค์',
			'กลุ่ม<br>เป้าหมาย',
			'จำนวน<br>เป้าหมาย (คน)',
			'ผลผลิต',
			'ผลลัพธ์',
			'หมายเหตุ',
		);
		if(isset($_POST['year'])){

			$caption='<b>'.$title.' ปี '.($_POST['year']+543).'</b><br>'.$org_name;

			$data=array(
				'gov_id'=>current_user('org_code'),
				'year'=>$_POST['year'],
			);
		    $govModel = model('App\Models\GovModel');
            $resultData=$govModel->getProject($data);
			$i=0;
            $resultRows=array();
			foreach ($resultData as $td){
				$i++;
				$resultRows[]=array(
					$i,
					'subject'=>$td->subject,
					'date'=>dateThai($td->start_date).' ถึง <br>'.dateThai($td->end_date),
					'place'=>$td->project_place,
					'method'=>$td->method,
					'objective'=>$td->objective,
					'target'=>$td->target,
					'target_amount'=>$td->target_amount,
					'product'=>$td->product,
					'result'=>$td->result,
					'note'=>'',
				);
			}

			$mouArr=array(
					'caption'=>$caption,
					'thead'=>$resultHead,
					'tbody'=>$resultRows,
			);
			$result=genTable($mouArr,$export=true,$noFoot=true);
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
			$result.=$signBox;
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
				'header'=>'<div style="text-align: right; font-weight: normal;"><b>แบบฟอร์มที่ 10</b><br> หน้า{PAGENO}/{nbpg}</div>'
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