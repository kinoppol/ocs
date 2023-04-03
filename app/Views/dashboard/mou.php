<?php 

helper('form');

$aval_chk='';
$mexp_chk='';
$exp_chk='';
$spc_chk='';
$selectedSt='';


	if((empty($_GET['s'])&&empty($_POST['exp'])&&empty($_POST['mexp']))||(!empty($_POST['status'])&&$_POST['status']=='available')){
		/*$aval_chk=' checked';
		$mexp_chk=' checked';
		*/
		$selectedSt='available';
	}
	if((!empty($_GET['s'])&&($_GET['s']=='mexp')||(!empty($_POST['status'])&&$_POST['status']=='closeExpire'))){
		//$mexp_chk=' checked';
		$selectedSt='closeExpire';
	}
	if((!empty($_GET['s'])&&($_GET['s']=='exp')||(!empty($_POST['status'])&&$_POST['status']=='expired'))){
		//$exp_chk=' checked';
		$selectedSt='expired';
	}

	if(!empty($_POST['showBy'])&&$_POST['showBy']=='bySpc'){
		$spc_chk=' checked';
		$aval_chk='';
		$mexp_chk='';
		$exp_chk='';
		$_SESSION['FOOTSCRIPT'].='
			$(function(){
				bySpc();
					$("#bySpc").prop("checked",true);
			});
		';
	}else{
		$_SESSION['FOOTSCRIPT'].='
		$(function(){
			bySt();
				$("#byStatus").prop("checked",true);
		});
	';

	}

?>
<div class="container-fluid">
	<form action="<?php print site_url('public/dashboard/mou'); ?>" method="post">
<div class="row">
		<div class="col-md-12">
			<div class="card">
        <h3>
				ค้นหาข้อมูล MOU
			</h3>
			<div class="row">
				<div class="col-md-8">
                <input type="text" class="form-control" id="q" name="q" <?php if(!empty($_POST['q'])) print ' value="'.$_POST['q'].'"' ?> required/>
			
								 
				</div>
				<div class="col-md-2">
					 <select name="province_code" class="form-control" >
							<option value="">แสดงทุกจังหวัด</option>
							<?php print genOption($province,$province_code);
							?>
						 </select>

				</div>
				<div class="col-md-2">
					 
					<button type="submit" class="btn btn-success btn-block">
						ค้นหา
					</button>
				</div>
			</div>
			
			<div class="row">
				
			<div class="col-md-2">
				<div class="form-group">
				<label>
						 <input type="radio" name="showBy" id="byStatus" value="byStatus"/> แสดงตามสถานะ MOU 
					 </label>	
					 <label>
						 <input type="radio" name="showBy" id="bySpc" value="bySpc"/> แสดงตามวันที่ระบุ
					 </label>	
				 </div>
				</div>

			<div class="col-md-4" id="statusOption">
				<div class="form-group">
	
					 <label for="exampleInputPassword1">
					 แสดงตามสถานะของ MOU 
					 </label>
					 <select name="status" class="form-control">
						<?php
						$st_option=array(
							'available'=>'MOU ที่ยังมีผลอยู่',
							'closeExpire'=>'MOU ที่ใกล้หมดอายุ',
							'expired'=>'MOU ที่หมดอายุแล้ว',
						);
							print genOption($st_option,$selectedSt);
						?>
					 </select>
				 </div>
				</div>
				

				<div class="col-md-2" id="dateStartOption">
				<div class="form-group">
					 
					 <label for="exampleInputPassword1">
					 มีผลระหว่างวันที่
					 </label>
					 <input type="date" name="start_date" class="form-control" value="<?php 
					 if(!empty($_POST['start_date'])){
						print $_POST['start_date'];
					 }else{
						print date('Y-m-d',strtotime('- 3 years'));
					 }
					  ?>"/>
				 </div>
				</div>

				<div class="col-md-2" id="dateEndOption">
				<div class="form-group">
	
					 <label for="exampleInputPassword1">
					 ถึงวันที่
					 </label>
					 <input type="date" name="end_date" class="form-control" value="<?php
					 if(!empty($_POST['end_date'])){
						print $_POST['end_date'];
					 }else{
						print date('Y-m-d');
					 }
					  ?>"/>
				 </div>
				</div>
				
				<div class="col-md-4">
				<div class="form-group">
	
					<label for="exampleInputPassword1">
					ระดับการลงนามความร่วมมือ 
					</label>
					<select name="level" class="form-control">
					<?php
					$selectedLv='';
					if(!empty($level))$selectedLv=$level;
					$level_option=array(
						''=>'ทุกระดับ',
						'vec'=>'สำนักงานคณะกรรมการการอาชีวศึกษา',
						'institute'=>'สถาบันการอาชีวศึกษา',
						'school'=>'สถานศึกษา',
						'gov'=>'อ.กรอ.อศ.',
					);
						print genOption($level_option,$selectedLv);
					?>
					</select>
				</div>
				</div>
			</div>
		</div>
		</div>
	</div>
</form>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
			<h3>
				รายการ MOU
			</h3>
			<?php 
				if(empty($province_code)&&empty($_POST['q'])&&empty($_GET['gid'])&&(empty($_GET['s'])||(!empty($_GET['s'])&&$_GET['s']=='aval'||$_GET['s']=='all'||$_GET['s']=='exp'))){
					print "<div align=\"center\"><h3>โปรดระบุคำค้น แล้วกดปุ่มค้นหา</h3></div>";
				}else{
					print $mouTable;
					//print_r($resultMOU);
				}
			?>
		</div>
	</div>
	</div>
</div>
<?php
$_SESSION['FOOTSCRIPT'].='
		$(function(){
			$("#byStatus").change(function(){
				if($("#byStatus").is(":checked")){
					bySt();
				}
			});

			
			$("#bySpc").change(function(){
				if($("#bySpc").is(":checked")){
					bySpc();
				}
			});
		});

		function bySt(){
			$("#statusOption").show();
			$("#dateStartOption").hide();
			$("#dateEndOption").hide();
		}

		function bySpc(){
			$("#statusOption").hide();
			$("#dateStartOption").show();
			$("#dateEndOption").show();
		}
';