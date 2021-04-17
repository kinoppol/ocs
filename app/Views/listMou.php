<?php
        helper('table');
        $mouRows=array();
        //print_r($data['mou']);
        $school=$data['school'];
        $business=$data['business'];
        foreach($data['mou'] as $mou){
            $mou = get_object_vars($mou);
            if(!isset($business[$mou['business_id']]))continue;
            $mouRows[]=array(
                'business_id'=>$business[$mou['business_id']],
                'school_id'=>$school[$mou['school_id']],
                'mou_date'=>$mou['mou_date'],
                'mou_sign_place'=>$mou['mou_sign_place'],
                '<button class="btn btn-xs btn-warning waves-effect"><i class="material-icons">edit</i></button>
                <a href="'.site_url('public/mou/pdf/'.$mou['mou_id']).'" target="_blank" class="btn btn-xs btn-danger waves-effect"><i class="material-icons">print</i></a>',
            );
        }
        $mouArr=array('thead'=>array(
                                'สถานประกอบการ',
                                'หน่วยงานภาครัฐ',
                                'วันที่ลงนาม',
                                'สถานที่ลงนาม',
                                'จัดการ',
                        ),
                        'tbody'=>$mouRows,
        );
    ?>

<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                    <div class="header">
                                แสดงรายชื่อ MOU ที่ลงนามในปี
                                <select id="selectYearMou">
                                <?php
                                $option='';
                                    for($i=date('Y');$i>date('Y')-10;$i--){
                                        $select='';
                                        if($year==$i)$select=' selected';
                                        $option.='<option value="'.$i.'"'.$select.'>'.($i+543).'</option>
                                        ';
                                    }
                                    print $option;
                                ?>
                                </select>  
                        <button class="btn btn-primary" id="addMou"><i class="material-icons">add</i> เพิ่มข้อมูล MOU</button>
                        <div class="body">
                        <div class="table-responsive">
                        <?php
                                print genTable($mouArr);
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