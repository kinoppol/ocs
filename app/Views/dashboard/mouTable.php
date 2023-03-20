<?php 

helper('thai');
?>
<table class="table">
				<thead>
					<tr>
						<th>
							#
						</th>
						<th>
						การลงนามความร่วมมือระหว่าง
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
					foreach($resultMOU['mou'] as $mou){
					?>
					<tr>
						<td>
							<?php print $mou->mou_id; ?>
						</td>
						<td>
							<?php 
							if(mb_strlen($mou->school_id)<10){
								print $resultMOU['gov'][$mou->school_id];
							}else{
								print $resultMOU['school'][$mou->school_id];
							}
							print " และ ";
								print $resultMOU['business'][$mou->business_id]['business_name'];
							?>
						</td>
						<td>
						<a href="https://www.google.co.th/maps/search/<?php print $mou->mou_sign_place; ?>" target="_blank">
						<?php print $mou->mou_sign_place; ?>
						</a>
						</td>
						<td>
						<?php print dateThai($mou->mou_date,false,false,true); ?>
						</td>
						<td>
						<?php print dateThai($mou->mou_end_date,false,false,true); ?>
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