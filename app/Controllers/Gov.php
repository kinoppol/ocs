<?php

namespace App\Controllers;

class Gov extends BaseController
{
	public function meettingRecord()
	{
		helper('user');
        
		$govModel = model('App\Models\GovModel');
        $data=array(
            'meettingData'=>$govModel->getMeetting(current_user('org_code')),
        );
		$data=array(
			'title'=>'รายงานการประชุม',
			'mainMenu'=>view('_menu'),
            'content'=>view('gov_meetingRecode',$data),
			'notification'=>'',
			'task'=>'',
		);        

		return view('_main',$data);
	}
	public function meettingAdd()
	{
		helper('user');
        
		$govModel = model('App\Models\GovModel');
        /*$data=array(
            'meettingData'=>$govModel->getMeetting(current_user('org_code')),
        );*/
		$data=array(
			'title'=>'รายงานการประชุม',
			'mainMenu'=>view('_menu'),
            'content'=>view('gov_meettingDetail'),
			'notification'=>'',
			'task'=>'',
		);        

		return view('_main',$data);
	}
	public function meettingDetail($id)
	{
		helper('user');
        
		$govModel = model('App\Models\GovModel');
        $data=array(
            'meettingData'=>$govModel->getMeettingData($id),
        );
		$data=array(
			'title'=>'รายงานการประชุม',
			'mainMenu'=>view('_menu'),
            'content'=>view('gov_meettingDetail',$data),
			'notification'=>'',
			'task'=>'',
		);        

		return view('_main',$data);
	}
	public function detail()
	{
		helper('user');
		$govModel = model('App\Models\GovModel');

		$orgModel = model('App\Models\OrgModel');
		$schools=$orgModel->getSchool();

		$govData=$govModel->getGovData(current_user('org_code'));
		$gov_school_id=explode(',',$govData->gov_school_id);
		
		$schoolModel = model('App\Models\SchoolModel');

		$data=array(
			'minor_code'=>explode(',',$govData->gov_minor),
		);
		$sumStudentCount=$schoolModel->getSumStudent($gov_school_id,false,$data);
		//print $sumStudentCount->count_val;
		$sumStudentDVECount=$schoolModel->getSumStudent($gov_school_id,'dve',$data);

		$minorModel = model('App\Models\MinorModel');
		$minors=$minorModel->getMinor();

		$student_school=array();
		foreach($gov_school_id as $school_id){
			$student_school[$school_id]=$schoolModel->getSumStudent($school_id,false,$data);
		}

		$data=array(
			'govData'=>$govData,
			'schools'=>$schools,
			'minors'=>$minors,
		);

		$data=array(
			'govData'=>$govData,
			'totalStudent'=>$sumStudentCount->count_val,
			'totalDVEStudent'=>$sumStudentDVECount->count_dve_val,
			'student_school'=>$student_school,
			'editForm'=>view('editGov',$data),
		);
        $data=array(
			'title'=>'ข้อมูลพื้นฐาน อ.กรอ.อศ.',
			'mainMenu'=>view('_menu'),
            'content'=>'ข้อมูล อ.กรอ.อศ.',
			'notification'=>'',
			'task'=>'',
			'content'=>view('govDetail',$data),
		);
		return view('_main',$data);
	}
    public function saveGov(){

		$orgModel = model('App\Models\OrgModel');
		$data=array();
		//print_r($_POST);
		foreach($_POST as $k=>$v){
			if($k=='gov_school_id'){
				$data[$k]=implode(',',$v);
			}else if($k=='gov_minor'){
				$data[$k]=implode(',',$v);				
			}else{
				$data[$k]=$v;
			}
		}
		//print_r($data);
		$result=$orgModel->updateGov($data['gov_id'],$data);
		$data=array(
			'title'=>'บันทึกข้อมูล อ.กรอ.อศ.',
			'mainMenu'=>view('_menu'),
			'notification'=>'',
			'task'=>'',
			'content'=>'บันทึกข้อมูลสำเร็จ<br>โปรดรอสักครู่..<meta http-equiv="refresh" content="1;url='.site_url('public/gov/detail').'">',
		);
		return view('_main',$data);
	}
	public function saveMeetting(){

		$govModel = model('App\Models\GovModel');

		$data=array();
		foreach($_POST as $k=>$v){
				$data[$k]=$v;
		}
		helper('user');
		$data['recorder_id']=current_user('user_id');
		$data['gov_id']=current_user('org_code');
		$data['record_time']=date('y-m-d H:i:s');

		if(!isset($_POST['id'])){
			$file_name=$result=$govModel->meettingAdd($data);
		}else{
			$result=$govModel->meettingUpdate($_POST['id'],$data);
			$file_name=$_POST['id'];
		}

		$mettingFilePath=FCPATH.'../meettingRecord/';

		if($_FILES['meettingRecord']['type']=='application/pdf'){
			$pdf_file=$file_name.'.pdf';
			$meettingRecord=$mettingFilePath.'doc/'.$pdf_file;
			move_uploaded_file($_FILES['meettingRecord']['tmp_name'],$meettingRecord);
		}
		//เรียง Array File ภาพ ใหม่
		$hFiles=array();
		$hFiles['pictures']=array();
		foreach($_FILES['pictures'] as $k=>$v){
			foreach($v as $sk=>$sv){
				$hFiles['pictures'][$sk][$k]=$sv;
			}
		}

		$pictures=array();
		$i=0;
		foreach($hFiles['pictures'] as $pic){
			if($pic['type']!='image/jpeg')continue;
			$i++;
			$pic_name=$file_name.'_'.$i.'.jpg';
			$picture=$mettingFilePath.'images/'.$pic_name;
			$pictures[]=$pic_name;
			move_uploaded_file($pic['tmp_name'],$picture);
		}
		//อัพเดตข้อมูลไฟล์แนบ
			$mRecord_id=$file_name;
			$data=array();
			if(isset($pdf_file)&&$pdf_file!='')$data['meettingRecord']=$pdf_file;
			if(isset($pictures)&&count($pictures)>0)$data['pictures']=implode(',',$pictures);
			if(count($data)>0){
				$govModel->meettingUpdate($mRecord_id,$data);
			}

		$data=array(
			'title'=>'บันทึกข้อมูลการประชุม อ.กรอ.อศ.',
			'mainMenu'=>view('_menu'),
			'notification'=>'',
			'task'=>'',
			'content'=>'บันทึกข้อมูลสำเร็จ<br>โปรดรอสักครู่..<meta http-equiv="refresh" content="1;url='.site_url('public/gov/meettingRecord').'">',
		);
		return view('_main',$data);
	}
	public function viewMeettingRecord($id){		
		$govModel = model('App\Models\GovModel');
		$report=$govModel->getMeettingData($id);
		$pdfUrl=site_url('meettingRecord/doc/'.$report->meettingRecord);
		$data=array(
			'title'=>'รายงานการประชุม อ.กรอ.อศ.',
			'mainMenu'=>view('_menu'),
			'content'=>'<iframe id="iframepdf" src="'.$pdfUrl.'" width="100%" height="600"></iframe>',
		  'notification'=>'',
		  'task'=>'',
		);
		return view('_main',$data);
	}
	public function meettingDelete($id){

		$govModel = model('App\Models\GovModel');
		 
			$result=$govModel->meettingDelete(['id'=>$id]);

		$data=array(
			'title'=>'ลบข้อมูลผลการประชุม',
			'mainMenu'=>view('_menu'),
            'content'=>$result?'ลบข้อมูลสำเร็จ <meta http-equiv="refresh" content="2;url='.site_url('public/gov/meettingRecord').'">':'ลบข้อมูลไม่สำเร็จ',
			'notification'=>'',
			'task'=>'',
		);      
		return view('_main',$data);

	} 
	public function meettingPrint($id){		
		$govModel = model('App\Models\GovModel');
		$report=$govModel->getMeettingData($id);
		$pdfUrl=site_url('meettingRecord/doc/'.$report->meettingRecord);
		$budYear=mb_substr($report->meetting_date,0,4);
		$mount=mb_substr($report->meettingRecord,5,2);
		if($mount>=10)$budYear=(int)$budYear+1;
		$budYear=(int)$budYear+543;

		error_reporting(0);
		helper('mpdf');
		helper('user');
		helper('org');
		helper('thai');
			//return $result;
			$html='<table width="100%">
			<tr>
				<td style="text-align:center;">
					<h3>แบบรายงานผลการประชุม อ.กรอ.อศ. ปีงบประมาณ พ.ศ. '.$budYear.'</h3>
					อ.กรอ.อศ. '.org_name($report->gov_id).'<br>
					ครั้งที่ '.$report->book_no.' วันที่ '.dateThai($report->meetting_date,true,false,true).' สถานที่ '.$report->meetting_place.'<br>
				</td>
			</tr>
			</table>';
			$html.='<table width="100%" class="table table-bordered table-striped table-hover'.$class.' dataTable"  border="1" cellspacing="0" style="border-collapse: collapse; ">';
			$html.='
			<thead>
				<tr>
					<th width="50%">
					ผลการประชุม
					</th>
					<th width="50%">
					ข้อเสนอแนะ
					</th>
				</tr>
			</thead>
			<tbody>
			<tr>
				<td valign="top" height="600">
				'.$report->meetting_result.'
				</th>
				<td valign="top">
				'.$report->meetting_comment.'
				</th>
			</tr>
			</tbody>
			</table>
			<table width="100%">
				<tr>
					<td valign="top" width="12%"><u>หมายเหตุ</u></td>
					<td valign="top" width="88%">ส่งรายงานการประชุม สารบรรณอิเล็กทรอนิกส์ : (AMS e-office) : bocadmin<br> ผู้ประสานงาน : อรพิน  พรมนอก  โทรศัพท์ 09 9281 8842 E-mail: ora.ovec@gmail.com</td>
				</tr>
			</table>
			<table width="100%">
				<tr>
					<td valign="top" width="50%">&nbsp;</td>
					<td valign="top" width="50%" style="text-align:center;"><br>ผู้รายงาน.........................................................<br>
					(...................................................)<br>
					เลขานุการ อ.กรอ.อศ. '.org_name($report->gov_id).'<br>
					วันที่รายงานผล.................................
					</td>
				</tr>
			</table>
			';
			$pdf_data=array(
				'html'=>$html,
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
				'header'=>'<div style="text-align: right; font-weight: normal;">แบบฟอร์มที่ 1</div>'
			);
			$location=FCPATH.'/pdf/';
			$fname=current_user('org_code').'_school_01.pdf';
			$filePdf=genPdf($pdf_data,$pageNo=NULL,$location,$fname);
			//return '';
			return '<meta http-equiv="refresh" content="0;url='.site_url('public/pdf/'.$filePdf).'?'.time().'">';
		return view('_main',$data);
	}
}