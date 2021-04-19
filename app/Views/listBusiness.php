<?php
        helper('table');
        $buninessRows=array();
        foreach($business as $k=>$v){
            $buninessRows[]=array(
                'business_name'=>$v['business_name'],
                'address'=>'จังหวัด'.$province[$v['province_id']].' อำเภอ'.$district[$v['district_id']].' ตำบล'.$subdistrict[$v['subdistrict_id']].' ถนน'.($v['road']!=''?$v['road']:'-').' เลขที่ '.($v['address_no']!=''?$v['address_no']:'-'),
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
                               <form action="<?php print site_url('public/'.$_SERVER['PATH_INFO']); ?>" method="post">
                                    <div class="row clearfix">
                                      <div class="col-lg-8 col-md-6 col-sm-6 col-xs-3">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="q" placeholder="ชื่อสถานประกอบการบางส่วน.." minlength="3" value="<?php print isset($_POST['q'])?$_POST['q']:''; ?>" required>
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
                                                <button  type="button" class="btn btn-warning" id="addMou"><i class="material-icons">add</i> เพิ่มข้อมูลสถานประกอบการ</button>
                                        </div>
                                    </div>
                                </div>
                               </form>
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