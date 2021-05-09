<?php

helper('org');
helper('tab');
		
?>
<div class="row clearfix">
                <div class="col-xs-12 col-sm-4">
                    <div class="card profile-card">
                        <div class="profile-header">&nbsp;</div>
                        <div class="profile-body">
                            <div class="image-area">
                                <img src="<?php print site_url('public/images/vec_logo.jpg'); ?>" alt="AdminBSB - Profile Image" width="128"/>
                            </div>
                            <div class="content-area">
                                <h3>ข้อมูล อ.กรอ.อศ.</h3>
                                <p><?php print '#'.current_user('org_code'); ?></p>
                                <p><?php print org_name(current_user('org_code')); ?></p>
                            </div>
                        </div>
                        <div class="profile-footer">
                            <ul>
                                <li>
                                    <span>นักเรียนนักศึกษา</span>
                                    <span><?php print number_format($totalStudent,0,",","."); ?> คน</span>
                                </li>
                                <li>
                                    <span>ระบบปกติ</span>
                                    <span><?php print number_format($totalStudent-$totalDVEStudent,0,",","."); ?> คน</span>
                                </li>
                                <li>
                                    <span>ระบบทวิภาคี</span>
                                    <span><?php print number_format($totalDVEStudent,0,",","."); ?> คน</span>
                                </li>
                            </ul>
                            <!-- <button class="btn btn-primary btn-lg waves-effect btn-block">ประสานข้อมูลจากระบบ ศธ. ๐๒ ออนไลน์</button> -->
                        </div>
                    </div>
                </div>
            <!-- ////////////////////////////// -->
            <div class="col-xs-12 col-sm-8">
                    <div class="card">
                        <div class="body">
                            <div>

                            <?php
                            $gov_school_id=explode(',',$govData->gov_school_id);
                            $gov_school='';
                            $i=0;
                            $total=count($gov_school_id);
                            foreach($gov_school_id as $school){
                                $i++;
                                if($gov_school!=''){
                                    if($i==$total){
                                        $gov_school.=' และ';
                                    }else{
                                        $gov_school.=', ';
                                    }
                                }
                                $gov_school.=org_name($school);
                            }

                            $gov_data='
                            <b>ประธาน อ.กรอ.อศ.</b> '.$govData->president_name.'<br>
                            <b>เลขานุการ อ.กรอ.อศ.</b> '.org_name($govData->secretary_school_id).'<br>
                            <b>สถานศึกษาใน อ.กรอ.อศ.</b> '.$gov_school.'<br>
                            ';

                            $tab=array(
                                'detail'=>array(
                                    'title'=>'ข้อมูลทั่วไป',
                                    'content'=>$gov_data,
                                ),
                                'form'=>array(
                                    'title'=>'แก้ไขข้อมูล',
                                    'content'=>$editForm,
                                ),
                            );
                            print gen_tab($tab);
                            ?>
                            </div>
                            </div>
                        </div>
                    </div>