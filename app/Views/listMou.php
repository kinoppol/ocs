<?php
        helper('table');
        $mouRows=array();
        //print_r($data['mou']);
        $school=$data['school'];
        $business=$data['business'];
        foreach($data['mou'] as $mou){
            $mou = get_object_vars($mou);
            $mouRows[]=array(
                'business_id'=>$business[$mou['business_id']],
                'school_id'=>$school[$mou['school_id']],
                'mou_date'=>$mou['mou_date'],
                'mou_sign_place'=>$mou['mou_sign_place'],
                '<button class="btn btn-xs btn-warning waves-effect"><i class="material-icons">edit</i></button>
                <a href="'.site_url('public/mou/pdf/id/'.$mou['mou_id']).'" target="_blank" class="btn btn-xs btn-danger waves-effect"><i class="material-icons">print</i></a>',
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