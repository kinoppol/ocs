<?php 

helper('thai');
helper('org');
?>
<table class="table js-exportable">
				<thead>
					<tr>
						<th>
							#
						</th>
						<th>
						ชื่อสถานประกอบการ
						</th>
						<th>
							จังหวัดที่ตั้ง
						</th>
						<th>
							จำนวน MOU
						</th>
						<th>
							รายละเอียด
						</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					if(!empty($business))foreach($business as $b){
					?>
					<tr>
						<td>
							<?php print $b['business_id']; ?>
						</td>
						<td>
                        <a href="https://www.google.co.th/maps/search/<?php print $b['business_name']; ?>" target="_blank">
						<?php print $b['business_name']; ?>
						</a>
						</td>
						<td>
						<?php print $province[$b['province_id']]; ?>
						</td>
						<td>
						<?php print number_format(empty($mouCount[$b['business_id']])?0:$mouCount[$b['business_id']]); ?>
						</td>
						<td>
							<a href="http://www.google.com/maps/place/<?php
                            print $b['location'];
                            ?>" class="btn btn-success" target="_blank" title="ที่ตั้ง"><i class="fa fa-map-marker"></i></a>
							<a href="<?php
                            print site_url('dashboard/business_detail').'?id='.$b['business_id'];
                            ?>" class="btn btn-warning" title="รายละเอียด"><i class="fa fa-file-text-o"></i></a>
						</td>
					</tr>
					<?php 
					}
					?>
				</tbody>
			</table>