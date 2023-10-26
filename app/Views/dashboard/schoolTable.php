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
						ชื่อสถานศึกษา
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
					if(!empty($school))foreach($school as $s){
					?>
					<tr>
						<td>
							<?php print $s->school_id; ?>
						</td>
						<td>
                        <a href="https://www.google.co.th/maps/search/<?php print $s->school_name; ?>" target="_blank">
						<?php print $s->school_name; ?>
						</a>
						</td>
						<td>
						<?php print $province[$s->province_id]; ?>
						</td>
						<td>
						<?php print number_format(empty($mouCount[$s->school_id])?0:$mouCount[$s->school_id]); ?>
						</td>
						<td>
							<a href="http://www.google.com/maps/place/<?php
                            print $s->latitude_longitude;
                            ?>" class="btn btn-success" target="_blank" title="ที่ตั้ง"><i class="fa fa-map-marker"></i></a>
							<a href="<?php
                            print site_url('public/dashboard/mou').'?gid='.$s->school_id;
                            ?>" class="btn btn-warning" title="รายละเอียด"><i class="fa fa-file-text-o"></i></a>
						</td>
					</tr>
					<?php 
					}
					?>
				</tbody>
			</table>