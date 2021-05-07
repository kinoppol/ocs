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
		
		$org_name=org_name(current_user('org_code'));

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
			'ที่',
			'สถานประกอบการ',
			'ลักษณะงาน',
			'ระดับความร่วมมือ',
			'ระดับการศึกษา',
			'วันที่ลงนาม',
			'วันที่สิ้นสุดความร่วมมือ',
			'สถานที่ลงนาม',
			'หมายเหตุ',
		);
		if(isset($_POST['year'])){

			$caption='<b>'.$title.'ระหว่างสถานศึกษาและสถานประกอบการ ปี '.($_POST['year']+543).'</b><br>'.$org_name;

			$mouModel = model('App\Models\MouModel');
			$resultData=$mouModel->getMou(['year'=>$_POST['year'],
											'school_id'=>current_user('org_code')]);
			
			$school=$resultData['school'];
			$business=$resultData['business'];
			$gov=$resultData['gov'];
			$resultRows=array();
			$i=0;
			foreach ($resultData['mou'] as $mou){
				$i++;
				$mou = get_object_vars($mou);

				$supEdu='';
				if($mou['support_vc_edu']=='Y')$supEdu='ปวช.';
				if($mou['support_hvc_edu']=='Y'){if($supEdu!='')$supEdu.='<br>'; $supEdu.='ปวส.';}
				if($mou['support_btech_edu']=='Y'){if($supEdu!='')$supEdu.='<br>'; $supEdu.='ทล.บ.';}
				if($mou['support_short_course']=='Y'){if($supEdu!='')$supEdu.='<br>'; $supEdu.='ระยะสั้น';}
				if($mou['support_no_specific']=='Y'){if($supEdu!='')$supEdu.='<br>'; $supEdu.='ไม่ระบุ';}

				$trainingPlace='';
				if($mou['support_local_training']=='Y')$trainingPlace='ฝึกงานในประเทศ';
				if($mou['support_oversea_training']=='Y'){if($trainingPlace!='')$trainingPlace.='<br>'; $trainingPlace.='ฝึกงานต่างประเทศ';}

				$org_name='';
					if(isset($school[$mou['school_id']]))$org_name=$school[$mou['school_id']];
					else if(isset($gov[$mou['school_id']]))$org_name=$gov[$mou['school_id']];

				$resultRows[]=array(
					$i,
					'business_id'=>$business[$mou['business_id']]['business_name'],
					'job_description'=>$business[$mou['business_id']]['job_description'],
					'level'=>'',
					'support_edu'=>$supEdu,
					'mou_date'=>dateThai($mou['mou_date'],true,false,true),
					//'mou_start_date'=>dateThai($mou['mou_start_date'],true,false,true),
					'mou_end_date'=>dateThai($mou['mou_end_date'],true,false,true),
					'mou_sign_place'=>$mou['mou_sign_place'],
					'note'=>$trainingPlace,
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
			$result.='
			<u>หมายเหตุ</u><br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ระดับ ๑ หมายถึง ดำเนินกิจกรรมเกี่ยวกับ CSR การฝึกงาน กิจกรรมเฉพาะกิจ (รวมระยะสั้น)<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ระดับ ๒ หมายถึง ดำเนินกิจกรรมเกี่ยวกับ CSR การฝึกงาน กิจกรรมเฉพาะกิจ (รวมระยะสั้น) และจัดการเรียนการสอนทวิภาคี<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ระดับ ๓ หมายถึง ดำเนินกิจกรรมเกี่ยวกับ CSR การฝึกงาน กิจกรรมเฉพาะกิจ (รวมระยะสั้น) และจัดการเรียนการสอนทวิภาคี และมีการร่วมลงทุนระหว่างสถานประกอบการและสถานศึกษา
			<table width="100%">
			<tr>
				<td style="text-align:center;">
				<br>
				.......................................<br>
				(.....................................)<br>
				หัวหน้างานความร่วมมือ
				</td>
				<td style="text-align:center;">
				<br>
				.......................................<br>
				(.....................................)<br>
				รองผู้อำนวยการฝ่ายแผนงานและความร่วมมือ
				</td>
				<td style="text-align:center;">
				<br>
				.......................................<br>
				(.....................................)<br>
				ผู้อำนวยการ'.$org_name.'
				</td>
			</tr>
			</table>
			';
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
				'header'=>'<div style="text-align: right; font-weight: normal;">หน้า {PAGENO}/{nbpg}</div>'
			);
			$location=FCPATH.'/pdf/';
			$fname=current_user('org_code').'_school_01.pdf';
			$filePdf=genPdf($pdf_data,$pageNo=NULL,$location,$fname);
			//return '';
			return '<meta http-equiv="refresh" content="0;url='.site_url('public/pdf/'.$filePdf).'?'.time().'">';
		}
		return view('_main',$data);
	}

	///// Report 2
	public function school_02($title,$print=false)
	{
		$skill=array(
			'1'=>'1. ยานยนต์สมัยใหม่',
			'2'=>'2. อิเล็กทรอนิกส์อัจฉริยะ',
			'3'=>'3. ท่องเที่ยวกลุ่มรายได้ดี',
			'4'=>'4. เกษตรและเทคโนโลยีชีวภาพ',
			'5'=>'5. แปรรูปอาหาร',
			'6'=>'6. หุ่นยนต์เพื่อการอุตสาหกรรม',
			'7'=>'7. การบินและโลจิสติกส์',
			'8'=>'8. เชื้อเพลิงชีวภาพเคมีชีวภาพ',
			'9'=>'9. ดิจิตอล',
			'10'=>'10. การแพทย์ครบวงจร',
		);
        $check='✔';
		if($print)$check='<img src="'.site_url('images/check.jpg').'" width="16">';
		
		if(!isset($title))$title=$_POST['title'];
		helper('report');
		helper('table');
		helper('user');
		helper('org');
		helper('thai');
		
		$org_name=org_name(current_user('org_code'));

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
			'ชื่อหลักสูตร',
			'ปวช.',
			'ปวส.',
			'ทล.บ.',
			'ระยะสั้น',
			'ไม่กำหนด',
			'Skill Gap',
			'จำนวน<br>ชั่วโมง',
			'เป้าหมาย<br>(คน)',
			'ผู้เข้าอบรม<br>(คน)',
			'หมายเหตุ',
		);
		if(isset($_POST['year'])){

			$caption='<b>'.$title.' ปี '.($_POST['year']+543).' </b><br>'.$org_name;

			$mouModel = model('App\Models\MouModel');
			$resultData=$mouModel->curriculumGet(['curriculum_year'=>$_POST['year'],
											'school_id'=>current_user('org_code')]);
			
			//$school=$resultData['school'];
			$business=$resultData['business'];
			//$gov=$resultData['gov'];
			$resultRows=array();
			foreach ($resultData['curriculum'] as $cur){
				//$cur = get_object_vars($curriculum);

				$KG='';

				if($cur->skill_01=='Y'){$KG.=$skill['1'];}				
				if($cur->skill_02=='Y'){if($KG!='')$KG.='<br>';$KG.=$skill['2'];}				
				if($cur->skill_03=='Y'){if($KG!='')$KG.='<br>';$KG.=$skill['3'];}				
				if($cur->skill_04=='Y'){if($KG!='')$KG.='<br>';$KG.=$skill['4'];}				
				if($cur->skill_05=='Y'){if($KG!='')$KG.='<br>';$KG.=$skill['5'];}				
				if($cur->skill_06=='Y'){if($KG!='')$KG.='<br>';$KG.=$skill['6'];}				
				if($cur->skill_07=='Y'){if($KG!='')$KG.='<br>';$KG.=$skill['7'];}				
				if($cur->skill_08=='Y'){if($KG!='')$KG.='<br>';$KG.=$skill['8'];}				
				if($cur->skill_09=='Y'){if($KG!='')$KG.='<br>';$KG.=$skill['9'];}				
				if($cur->skill_10=='Y'){if($KG!='')$KG.='<br>';$KG.=$skill['10'];}

				$resultRows[]=array(
					'business_id'=>$business[$cur->business_id]['business_name'],
					'curriculum_name'=>$cur->curriculum_name,	
					'support_vc_edu'=>$cur->support_vc_edu=='Y'?$check:'',
					'support_hvc_edu'=>$cur->support_hvc_edu=='Y'?$check:'',
					'support_btech_edu'=>$cur->support_btech_edu=='Y'?$check:'',
					'support_short_course'=>$cur->support_short_course=='Y'?$check:'',
					'support_no_specific'=>$cur->support_no_specific=='Y'?$check:'',	
					'Skill_Gap'=>$KG,			
					'curriculum_hour'=>$cur->curriculum_hour,			
					'curriculum_target'=>$cur->curriculum_target,	
					'training_amount'=>$cur->training_amount,
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
			$result.='
			<table width="100%">
			<tr>
				<td style="text-align:center;">
				<br>
				.......................................<br>
				(.....................................)<br>
				หัวหน้างานความร่วมมือ
				</td>
				<td style="text-align:center;">
				<br>
				.......................................<br>
				(.....................................)<br>
				รองผู้อำนวยการฝ่ายแผนงานและความร่วมมือ
				</td>
				<td style="text-align:center;">
				<br>
				.......................................<br>
				(.....................................)<br>
				ผู้อำนวยการ'.$org_name.'
				</td>
			</tr>
			</table>
			';
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
				'header'=>'<div style="text-align: right; font-weight: normal;">หน้า {PAGENO}/{nbpg}</div>'
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