<?php
        helper('table');
        $mouRows=array();
        //print_r($data['mou']);
        $school=$data['school'];
        $business=$data['business'];
        foreach($data['mou'] as $mou){
            $mou = get_object_vars($mou);
            if(!isset($business[$mou['business_id']]))continue;
            $buninessRows[]=array(
                'business_id'=>$business[$mou['business_id']],
                'address'=>$school[$mou['school_id']],
                '<button class="btn btn-xs btn-warning waves-effect"><i class="material-icons">book</i>ทำ MOU</button>',
            );
        }
        $businessArr=array('thead'=>array(
                                'สถานประกอบการ',
                                'ที่อยู่',
                                'จัดการ',
                        ),
                        'tbody'=>$buninessRows,
        );
    ?>

<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                    <div class="header">
                               เลือกสถานประกอบการเพื่อทำ MOU
                        <button class="btn btn-primary" id="addMou"><i class="material-icons">add</i> เพิ่มข้อมูลสถานประกอบการ</button>
                        <div class="body">
                        <div class="table-responsive">
                        <?php
                                print genTable($businessArr);
                             ?>
                            </div>
                    </div>
                            </div>
                            </div>
                    </div>
                    <script>
                    </script>
                    
                    <div class="modal fade" id="addMouModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">เพิ่มข้อมูล MOU</h4>
                        </div>
                        <div class="modal-body">
                            โปรดรอสักครู่..
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">ปิด</button>
                        </div>
                    </div>