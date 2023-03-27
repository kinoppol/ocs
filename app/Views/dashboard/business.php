<?php 

helper('form');
?>
<div class="container-fluid">
<form action="<?php print site_url('public/dashboard/business'); ?>" method="post">
<div class="row">
		<div class="col-md-12">
			<div class="card">
        <h3>
				ค้นหาข้อมูลสถานประกอบการ
			</h3>
			<div class="row">
				<div class="col-md-8">
                <input type="text" class="form-control" id="q" name="q" <?php if(!empty($_POST['q'])) print ' value="'.$_POST['q'].'"' ?>/>
				</div>
				
				<div class="col-md-2">
					 <select name="province_code" class="form-control">
							<option value="">ในพื้นที่ทุกจังหวัด</option>
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
		</div>
	</div>
	</div>
</form>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
			<h3>
				สถานประกอบการ
			</h3>
			
			<?php 
				if(empty($_POST['q'])){
					print "<div align=\"center\"><h3>โปรดระบุคำค้น แล้วกดปุ่มค้นหา</h3></div>";
				}else{
					print $businessTable;
				}
			?>
		</div>
	</div>
	</div>
</div>