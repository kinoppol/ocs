<?php
    //print_r($users);
    //exit();
    helper('table');
    $userRows=array();
    foreach($users as $user){
        $user = get_object_vars($user);
        array_push($user,'<button class="btn btn-xs btn-warning waves-effect"><i class="material-icons">edit</i> แก้ไข</button>');
        $userRows[]=$user;
    }
    $userArr=array('thead'=>array(
                            'ชื่อผู้ใช้',
                            'ชื่อ',
                            'สกุล',
                            'อีเมล',
                            'ประเภทผู้ใช้',
                            'จัดการ',
                    ),
                    'tbody'=>$userRows,
    );
?>
<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                    <div class="header">
                            <h2>
                                รายชื่อผู้ใช้งานระบบ   
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="#" id="addUserBtn">เพิ่มผู้ใช้งาน</a></li>
                                        <li><a href="javascript:void(0);">เพิ่มผู้ใช้งานแบบกลุ่ม</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                        <div class="table-responsive">
                             <?php
                                print genTable($userArr);
                             ?>
                            </div>
                    </div>
                            </div>
                            </div>
                    </div>
                    <div class="modal fade" id="newUserModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">เพิ่มผู้ใช้งานระบบ</h4>
                        </div>
                        <div class="modal-body">
                            โปรดรอสักครู่..
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">ปิด</button>
                        </div>
                    </div>
                </div>
            </div>
            