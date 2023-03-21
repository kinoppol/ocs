<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<h3>
				ภาพรวมของระบบฐานข้อมูลสำนักความร่วมมือ
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
				<span class="info-box-number"><?php print number_format($mouCountActive-$mouCountActiveOver90Days); ?> ฉบับ</span>
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
		<div class="col-md-6">
			<div class="card">
				<h5 class="card-header">
					การลงนามความร่วมมือล่าสุด
				</h5>
				<div class="card-body">
					<p class="card-text">
					
						<?php
						print $mouTable;
						//print_r($lastestMOU);
						?>
					</p>
				</div>
				<div class="card-footer">
					<a href="<?php print site_url('public/dashboard/mou?orderBy=mou_date desc'); ?>">ดูเพิ่มเติม</a>
				</div>
			</div>
		</div>

		<div class="col-md-6">
			<div class="card">
				<h5 class="card-header">
					แผนที่แสดงจำนวน MOU
				</h5>
				<div class="card-body">
					<p class="card-text">
					<div class="embed-responsive" style="--bs-aspect-ratio: 150%;">
  						<iframe class="embed-responsive-item" src="<?php print site_url('public/dashboard/map?disp=embed'); ?>"></iframe>
					</div>
					</p>
				</div>
				<div class="card-footer">
					<a href="<?php print site_url('public/dashboard/map'); ?>">ดูเพิ่มเติม</a>
				</div>
			</div>
		</div>
	</div>
</div>