<?php
        helper('table');
        helper('modal');
        helper('form');
        helper('thai');

        $tableRows=array();
        //print_r($meettingData);
        $i=0;
        foreach($teacherDevData as $k=>$v){
            $i++;
            $tableRows[]=array(
                'no'=>$i,
                'teacherDev_duration'=>dateThai($v->start_date,true,false,true).'-'.dateThai($v->end_date,true,false,true),
                'teacherDev_plcae'=>$v->dev_place,
                'teacherDev_subject'=>$v->subject,
                'manage'=>'
                <a href="'.site_url('public/gov/teacherDevDetail/'.$v->id).'" class="btn btn-xs btn-warning waves-effect"><i class="material-icons">edit</i>แก้ไข</a>
                <a href="'.site_url('public/gov/teacherDevDelete/'.$v->id).'" class="btn btn-xs btn-danger" onclick="return confirm(\'ยืนยันการลบข้อมูล\');"><i class="material-icons">delete</i> ลบ</a>',
            );
        }
        $tableArr=array('thead'=>array(
            'ที่',
            'ช่วงเวลา',
            'สถานที่จัดอบรม',
            'หัวข้อ',
            'จัดการ',
    ),
    'tbody'=>$tableRows,
);
    ?>

<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                    <div class="header">
                               <form action="<?php print site_url('public/'.$_SERVER['PATH_INFO']); ?>" method="post">
                                    <div class="row clearfix"><div class="row clearfix">
                                      <div class="col-lg-8 col-md-12 col-sm-12 col-xs-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="q" placeholder="คำค้น.." value="<?php print isset($_POST['q'])?$_POST['q']:''; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-1 col-md-2 col-sm-2 col-xs-3">
                                        <div class="form-group">
                                                <button class="btn btn-primary"><i class="material-icons">search</i> ค้นหา</button>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-3 col-sm-3 col-xs-3">
                                        <div class="form-group">
                                                <!--<button  type="button" class="btn btn-warning" id="addBusiness"><i class="material-icons">add</i> เพิ่มรายงานการประชุม</button>-->
                                                <a  href="<?php print site_url('public/gov/teacherDevAdd'); ?>" class="btn btn-warning" id="addTrainerDev"><i class="material-icons">add</i> เพิ่มรายการพัฒนาครูผู้สอน</a>
                                        </div>
                                    </div>
                                </div>
                               </form>
                        <div class="body">
                        <div class="table-responsive">
                        <?php
                                print genTable($tableArr);
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