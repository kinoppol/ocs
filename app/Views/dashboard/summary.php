<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<h3>
				ภาพรวมของระบบฐานข้อมูล
			</h3>
		</div>
	</div>
	<div class="row">
	<div class="col-md-3">
		  <div class="card">
				<div class="info-box">
				<span class="info-box-icon bg-aqua"><i class="fa fa-book"></i></span>
				<div class="info-box-content">
				<span class="info-box-text">MOU ทั้งหมด</span>
				<span class="info-box-number"><?php print number_format($mouCountAll); ?> ฉบับ</span>
				<span class="info-box-text">&nbsp;</span>
				</div>
		  </div>
				<a href="<?php print site_url('public/dashboard/mou?s=all'); ?>">ดูรายละเอียด..</a>
		  </div>
		  </div>
		<div class="col-md-3">
		<div class="card">
				<div class="info-box">
				<span class="info-box-icon bg-green"><i class="fa fa-calendar-check-o"></i></span>
				<div class="info-box-content">
				<span class="info-box-text">MOU ที่มีผล</span>
				<span class="info-box-number"><?php print number_format($mouCountActive); ?> ฉบับ</span>
				<span class="info-box-text">&nbsp;</span>
				</div>
		  </div>
				<a href="<?php print site_url('public/dashboard/mou?s=aval'); ?>">ดูรายละเอียด..</a>
		  </div>
		</div>
		<div class="col-md-3">
		<div class="card">
				<div class="info-box">
				<span class="info-box-icon bg-yellow"><i class="fa fa-hourglass-half"></i></span>
				<div class="info-box-content">
				<span class="info-box-text">MOU ใกล้หมดอายุ</span>
				<span class="info-box-number"><?php print number_format($mouCountCloseToExpiration-($mouCountAll-$mouCountActive)); ?> ฉบับ</span>
				<span class="info-box-text">* กำลังจะหมดอายุใน 90 วัน</span>
				</div>
		  </div>
				<a href="<?php print site_url('public/dashboard/mou?s=mexp'); ?>">ดูรายละเอียด..</a>
		  </div>
		</div>
		<div class="col-md-3">
		<div class="card">
				<div class="info-box">
				<span class="info-box-icon bg-red"><i class="fa fa-calendar-times-o"></i></span>
				<div class="info-box-content">
				<span class="info-box-text">MOU ที่หมดอายุ</span>
				<span class="info-box-number"><?php print number_format($mouCountAll-$mouCountActive); ?> ฉบับ</span>
				<span class="info-box-text">&nbsp;</span>
				</div>
		  </div>
				<a href="<?php print site_url('public/dashboard/mou?s=exp'); ?>">ดูรายละเอียด..</a>
		  </div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<h5 class="card-header">
					การลงนามความร่วมมือล่าสุด
				</h5>
				<div class="card-body">
					<p class="card-text">
					<table class="table">
				<thead>
					<tr>
						<th>
							#
						</th>
						<th>
							MOU ระหว่าง
						</th>
						<th>
							สถานที่ลงนาม
						</th>
						<th>
							วันที่ลงนาม
						</th>
						<th>
							วันที่สิ้นสุด
						</th>
						<th>
							ดูเอกสาร
						</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					foreach($lastestMOU['mou'] as $mou){
					?>
					<tr>
						<td>
							<?php print $mou->mou_id; ?>
						</td>
						<td>
							<?php 
							if(mb_strlen($mou->school_id)<10){
								print $lastestMOU['gov'][$mou->school_id];
							}else{
								print $lastestMOU['school'][$mou->school_id];
							}
							print " และ ";
								print $lastestMOU['business'][$mou->business_id]['business_name'];
							?>
						</td>
						<td>
						<a href="https://www.google.co.th/maps/search/<?php print $mou->mou_sign_place; ?>" target="_blank">
						<?php print $mou->mou_sign_place; ?>
						</a>
						</td>
						<td>
						<?php print $mou->mou_date; ?>
						</td>
						<td>
						<?php print $mou->mou_end_date; ?>
						</td>
						<td>
							<?php 
							if(!empty($mou->mou_file)){
							?>
							<a href="<?php print site_url().'docs/mou/'.$mou->mou_file; ?>" class="btn btn-primary" target="_blank"><i class="fa fa-book"></i> MOU</a>
							<?php
							}
							?>
						</td>
					</tr>
					<?php 
					}
					?>
				</tbody>
			</table>
						<?php
						//print_r($lastestMOU);
						?>
					</p>
				</div>
				<div class="card-footer">
					<a href="<?php print site_url('public/dashboard/mou?orderBy=mou_date desc'); ?>">ดูเพิ่มเติม</a>
				</div>
			</div>
		</div>
	</div>
</div>