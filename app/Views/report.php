<?php
        helper('table');
        helper('modal');
        helper('user');

        $reports=array(array(
            'title'=>'รายงานการลงนามความร่วมมือ',
            'file'=>'school_01',
            'cond'=>current_user('user_type')=='school',
            ),
            array(
            'title'=>'รายงานการพัฒนาหลักสูตรร่วมกับสถานประกอบการ',
            'file'=>'school_02',
            'cond'=>current_user('user_type')=='school',
            ),
            array(
            'title'=>'รายงานผลสัมฤทธิ์ของการร่วมมือกับสถานประกอบการ',
            'file'=>'school_03',
            'cond'=>current_user('user_type')=='school',
            ),
        );


        $reportRows=array();
        $i=0;
        foreach($reports as $row){
            if(!$row['cond'])continue;
            $i++;
            $reportRows[]=array(
                'i'=>$i,
                'reportName'=>$row['title'],
                'manage'=>'<a href="'.site_url('public/report/view/'.$row['file']).'" class="btn btn-primary"> <i class="material-icons">search</i> ดูรายงาน</a>'
            );
        }
        $reportArr=array('thead'=>array(
                                'ที่',
                                'ชื่อรายงาน',
                                'จัดการ',
                        ),
                        'tbody'=>$reportRows,
        );
    ?>

<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                    <div class="header">
                               <h3>รายงาน</h3>
                        <div class="body">
                        <div class="table-responsive">
                        <?php
                                print genTable($reportArr);
                             ?>
                            </div>
                    </div>
                            </div>
                            </div>
                    </div>
                    <script>
                    </script>
                    
                    
                    <?php
                    $data=array(
                        'id'=>'addBusinessModal',
                        'title'=>'เพิ่มข้อมูลสถานประกอบการ',
                        'content'=>'โปรดรอสักครู่...',
                        //'size'=>'modal-lg',
                    );
                    print genModal($data);
                    $_SESSION['FOOTSCRIPT'].='
                    $("#addBusiness").click(function(){
                        $("#addBusinessModal").modal("show");
                    });';
                    ?>