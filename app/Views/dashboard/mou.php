<?php 
$aval_chk='';
$mexp_chk='';
$exp_chk='';
	if((empty($_GET['s'])&&empty($_POST['exp'])&&empty($_POST['mexp']))||(!empty($_GET['s'])&&($_GET['s']=='aval'||$_GET['s']=='all'))||!empty($_POST['aval'])){
		$aval_chk=' checked';
		$mexp_chk=' checked';
	}
	if((!empty($_GET['s'])&&($_GET['s']=='mexp')||!empty($_POST['mexp']))){
		$mexp_chk=' checked';
	}
	if((!empty($_GET['s'])&&($_GET['s']=='exp'||$_GET['s']=='all'))||!empty($_POST['exp'])){
		$exp_chk=' checked';
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
				<div class="col-md-10">
                <input type="text" class="form-control" id="q" name="q" <?php if(!empty($_POST['q'])) print ' value="'.$_POST['q'].'"' ?>/>
				<div class="checkbox">
					<label>
						 <input type="checkbox" name="aval" value="show"<?php print $aval_chk; ?>/> แสดง MOU ที่มีผล
					 </label>
					 <label>
						 <input type="checkbox" name="mexp" value="show"<?php print $mexp_chk; ?>/> แสดง MOU ที่ใกล้หมดอายุ
					 </label>			
					 <label>
						 <input type="checkbox" name="exp" value="show"<?php print $exp_chk; ?>/> แสดง MOU ที่หมดอายุ
					 </label>	
				 </div> 
				</div>
				<div class="col-md-2">
					 
					<button type="submit" class="btn btn-success btn-block">
						ค้นหา
					</button>
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
				if(empty($_POST['q'])&&empty($_GET['s'])){
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