<?php
        helper('table');
        helper('modal');
        $reportRows=array(array(
                            'i'=>'1',
                            'reportName'=>'รายงานการลงนามความร่วมมือ',
                            'manage'=>'<button class="btn btn-success">ส่งออก</button>
                                       <button class="btn btn-danger">พิมพ์</button>',
                            ),
                        array(
                            'i'=>'2',
                            'reportName'=>'รายงานการพัฒนาหลักสูตรร่วมกับสถานประกอบการ',
                            'manage'=>'<button class="btn btn-success">ส่งออก</button>
                                       <button class="btn btn-danger">พิมพ์</button>',
                            ),
                        array(
                            'i'=>'3',
                            'reportName'=>'รายงานผลสัมฤทธิ์ของการร่วมมือกับสถานประกอบการ',
                            'manage'=>'<button class="btn btn-success">ส่งออก</button>
                                       <button class="btn btn-danger">พิมพ์</button>',
                            ),
                        );
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