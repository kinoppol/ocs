
<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                    <div class="header">
                               <form action="<?php print site_url('public/'.$_SERVER['PATH_INFO']); ?>" method="post">
                                    <div class="row clearfix">
                                      <div class="col-lg-4 col-md-6 col-sm-6 col-xs-3">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <select name="province_id" id="province_id" class="form-control">
                                                    <?php
                                                        print genOption($province,isset($_POST['province_id'])?$_POST['province_id']:'10');
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div><div class="row clearfix">
                                      <div class="col-lg-4 col-md-6 col-sm-6 col-xs-3">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="q" placeholder="ชื่อสถานประกอบการบางส่วน.." value="<?php print isset($_POST['q'])?$_POST['q']:''; ?>">
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
                                                <!-- <button  type="button" class="btn btn-warning" id="addBusiness"><i class="material-icons">add</i> เพิ่มข้อมูลสถานประกอบการ</button> -->
                                                <a  href="<?php print site_url('public/business/add'); ?>" class="btn btn-warning" id="addBusiness"><i class="material-icons">add</i> เพิ่มข้อมูลสถานประกอบการ</a>
                                        </div>
                                    </div>
                                </div>
                               </form>
                        <div class="body">
                        <div class="table-responsive">
                        <?php
                                //print genTable($businessArr);
                             ?>
                            </div>
                    </div>
                            </div>
                            </div>
                    </div>