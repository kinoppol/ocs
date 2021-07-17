<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		//$this->load->helper('url');
		return view('welcome_message');
	}
	public function dashboard()
	{
		helper('color');
		//print_r(unserialize($_COOKIE['current_user']));
		helper('user');
		$MouModel = model('App\Models\MouModel');
		$orgModel = model('App\Models\OrgModel');
		$DashboardModel = model('App\Models\DashboardModel');
		$locationModel = model('App\Models\LocationModel');
		$summaryModel = model('App\Models\SummaryModel');
		
		$schools=$orgModel->getSchool();
		$govs=$orgModel->getGov();
		$institute=$orgModel->getInstitute();
		
		$org_name='';
		if(isset($schools[current_user('org_code')]))$org_name=$schools[current_user('org_code')];
		else if(isset($govs[current_user('org_code')]))$org_name=$govs[current_user('org_code')];
		else if(isset($institute[current_user('org_code')]))$org_name=$institute[current_user('org_code')];
		else $org_name='ท่าน';
		$currentYear=date('Y');
		

		$data1=array(
			'title'=>'',
			'year'=>$currentYear,
			'mouCount'=>$MouModel->getMouCount(['active'=>'Y']),
			'mouLastYearCount'=>$MouModel->getMouYearCount(['year'=>$currentYear-1]),
			'mouYearCount'=>$MouModel->getMouYearCount(['year'=>$currentYear]),
			'businessCount'=>$MouModel->getBusinessCount(),
		);		
		$data2=array(
			'title'=>'ส่วนของ'.$org_name,
			'year'=>$currentYear,
			'mouCount'=>$MouModel->getMouCount(['org_code'=>current_user('org_code'),'active'=>'Y']),
			'mouLastYearCount'=>$MouModel->getMouYearCount(['org_code'=>current_user('org_code'),'year'=>$currentYear-1]),
			'mouYearCount'=>$MouModel->getMouYearCount(['org_code'=>current_user('org_code'),'year'=>$currentYear]),
			'businessCount'=>$MouModel->getBusinessCount(['org_code'=>current_user('org_code')]),
		);

		$dzm=$DashboardModel->getDivZoneMOU();
		$dzm=json_decode(json_encode($dzm), true);
		$sum_mou=array_sum(array_column($dzm,'mou'));
		$sum_school=array_sum(array_column($dzm,'school'));
		//print 'SUM : '.$sum_mou;
		$dnm_data=array();
		$dns_data=array();
		$dnt_data=array();
		$dnd_data=array();
		$dne_data=array();
		$dnstd_data=array();

		

		foreach($dzm as $row){
			$dnm_data[]=array(
				'label'=>'ภาค'.$row['zone_name'].' ('.number_format($row['mou'],0).' MOU)',
				'percent'=>$row['mou']/$sum_mou*100,
				'color'=>color($row['zone_id']+2),
			);
		}


		foreach($dzm as $row){
			$dns_data[]=array(
				'label'=>'ภาค'.$row['zone_name'].' ('.number_format($row['school'],0).' แห่ง)',
				'percent'=>$row['school']/$sum_school*100,
				'color'=>color($row['zone_id']+2),
			);
		}

		$traineeTotalYear=$MouModel->getResultTraineeYear(['year'=>date('Y')]);
		foreach($dzm as $row){
            $school=$locationModel->getSchoolZone($row['zone_id']); 
			$org_id=array();
            foreach($school as $srow){
                $org_id[]=$srow->school_id;
            }
			$data=array(
				'year'=>date('Y'),
				'org_code'=>$org_id,
			);
			$trainee=$MouModel->getResultTraineeYear($data);
			$dnt_data[]=array(
				'label'=>'ภาค'.$row['zone_name'].' ('.number_format($trainee,0).' คน)',
				'percent'=>$trainee/$traineeTotalYear*100,
				'color'=>color($row['zone_id']+2),
			);
		}


		$employeeTotalYear=$MouModel->getResultEmployeeYear(['year'=>date('Y')]);
		foreach($dzm as $row){
            $school=$locationModel->getSchoolZone($row['zone_id']); 
			$org_id=array();
            foreach($school as $srow){
                $org_id[]=$srow->school_id;
            }
			$data=array(
				'year'=>date('Y'),
				'org_code'=>$org_id,
			);
			$employee=$MouModel->getResultEmployeeYear($data);
			$dne_data[]=array(
				'label'=>'ภาค'.$row['zone_name'].' ('.number_format($employee,0).' คน)',
				'percent'=>$employee/$employeeTotalYear*100,
				'color'=>color($row['zone_id']+2),
			);
		}


		$donateTotalYear=$MouModel->getResultDonateYear(['year'=>date('Y')]);
		foreach($dzm as $row){
            $school=$locationModel->getSchoolZone($row['zone_id']); 
			$org_id=array();
            foreach($school as $srow){
                $org_id[]=$srow->school_id;
            }
			$data=array(
				'year'=>date('Y'),
				'org_code'=>$org_id,
			);
			$donate=$MouModel->getResultDonateYear($data);
			$dnd_data[]=array(
				'label'=>'ภาค'.$row['zone_name'].' ('.number_format($donate,0).' บาท)',
				'percent'=>$donate/$donateTotalYear*100,
				'color'=>color($row['zone_id']+2),
			);
		}

		$studentTotal=$summaryModel->getSummaryStudent();
		foreach($dzm as $row){
            $school=$locationModel->getSchoolZone($row['zone_id']); 
			$org_id=array();
            foreach($school as $srow){
                $org_id[]=$srow->school_id;
            }
			$data=array(
				'org_code'=>$org_id,
			);
			$student=$summaryModel->getSummaryStudent($data);
			$dnstd_data[]=array(
				'label'=>'ภาค'.$row['zone_name'].' ('.number_format($student,0).' คน)',
				'percent'=>$student/$studentTotal*100,
				'color'=>color($row['zone_id']+2),
			);
		}


		$chartData=array(
			'id'=>'dn_mou',
			'caption'=>'การลงนามความร่วมมือจำแนกรายภาค',
			'dn_data'=>$dnm_data,
			'alt'=>'การลงนามความร่วมมือที่ยังมีผลอยู่ทั้งหมด '.number_format($sum_mou,0).' MOU',
		);

		$schoolChartData=array(
			'id'=>'dn_school',
			'caption'=>'จำนวนสถานศึกษาจำแนกรายภาค',
			'dn_data'=>$dns_data,
			'alt'=>'สถานศึกษาภาครัฐทั้งหมด '.number_format($sum_school,0).' แห่ง',
		);

		$studentChartData=array(
			'id'=>'dn_student',
			'caption'=>'จำนวนผู้เรียนอาชีวศึกษาจำแนกรายภาค',
			'dn_data'=>$dnstd_data,
			'alt'=>'ผู้เรียนอาชีวศึกษาภาครัฐทั้งหมด '.number_format($studentTotal,0).' คน',
		);

		$donateChartData=array(
			'id'=>'dn_donate',
			'caption'=>'มูลค่าการสนับสนุนการศึกษาจำแนกรายภาค',
			'dn_data'=>$dnd_data,
			'alt'=>'มูลค่าการสนับสนุนการศึกษาทั้งหมด '.number_format($donateTotalYear,0).' บาท',
		);

		$traineeChartData=array(
			'id'=>'dn_trainee',
			'caption'=>'การรับนักศึกษาฝึกงาน',
			'dn_data'=>$dnt_data,
			'alt'=>'มีการรับนักศึกษาฝึกงานภายใต้ MOU '.number_format($traineeTotalYear,0).' คน',
		);

		$employeeChartData=array(
			'id'=>'dn_employee',
			'caption'=>'การรับผู้สำเร็จการศึกษาเข้าทำงาน',
			'dn_data'=>$dne_data,
			'alt'=>'มีการรับผู้สำเร็จการศึกษาเข้าทำงานภายใต้ MOU '.number_format($employeeTotalYear,0).' คน',
		);

		$data=array(
			'title'=>'ภาพรวม',
			'task'=>'',
			'notification'=>'',
			'mainMenu'=>view('_menu'),
			'content'=>	view('dashboard',$data1).
						view('dashboard',$data2).
						view('chart_dn',$schoolChartData).
						view('chart_dn',$studentChartData).
						view('chart_dn',$chartData).
						view('chart_dn',$donateChartData).
						view('chart_dn',$traineeChartData).
						view('chart_dn',$employeeChartData),
		);
		return view('_main',$data);
	}
}
