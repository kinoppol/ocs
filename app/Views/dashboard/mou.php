<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<h3>
				ค้นหา MOU
			</h3>
			<form role="form" class="form-inline" action="<?php print site_url('public/dashboard/mou'); ?>" method="post">
				<div class="form-group">
					 
					<label for="exampleInputEmail1">
						คำค้น
					</label>
					<input type="email" class="form-control" id="exampleInputEmail1" />
				</div>
				<button type="submit" class="btn btn-primary">
					ค้นหา
				</button>
			</form>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<h3>
				รายการ MOU
			</h3>
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
					<tr>
						<td>
							1
						</td>
						<td>
							TB - Monthly
						</td>
						<td>
							01/04/2012
						</td>
						<td>
							01/04/2015
						</td>
						<td>
							<a href="#" class="btn btn-primary"><i class="fa fa-report"></i> MOU</a>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>