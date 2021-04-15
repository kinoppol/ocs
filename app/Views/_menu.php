<?php
helper('menu');

$data=array(
    'dashboard'=>array(
        'text'=>'ภาพรวม',
        'url'=>site_url(),
        'bullet'=>'dashboard',
        'cond'=>true,/*
        'items'=>array(
            'dashboard'=>array(
                'text'=>'ภาพรวม',
                'url'=>site_url(),
                'bullet'=>'book',
                'cond'=>true,
                'items'=>array(
                    'dashboard'=>array(
                        'text'=>'อีกๆ',
                        'url'=>site_url(),
                        'bullet'=>'book',
                        'cond'=>true,
                        ),
                    ),
                ),
            ),*/
        ),
    'mou'=>array(
        'text'=>'การลงนามความร่วมมือ',
        'url'=>site_url('public/mou/'),
        'bullet'=>'description',
        'cond'=>true,
        'items'=>array(
            'list'=>array(
                'text'=>'รายการ MOU',
                'url'=>site_url('public/mou/list'),
                'cond'=>true,
            ),
            'search'=>array(
                'text'=>'ค้นหา MOU',
                'url'=>site_url('public/mou/search'),
                'cond'=>true,
            ),

        ),
    ),
    'manage'=>array(
        'text'=>'จัดการ',
        'url'=>site_url(),
        'bullet'=>'settings',
        'cond'=>current_user('user_type')=='admin',
        'items'=>array(
            'systemManage'=>array(
                'text'=>'ตั้งค่าระบบ',
                'url'=>site_url('public/admin/systemSetting'),
                'cond'=>true,
                ),
            'userManage'=>array(
                'text'=>'จัดการผู้ใช้',
                'url'=>site_url('public/admin/userManage'),
                'cond'=>true,
                ),
            ),
        ),
);


print genMainMenu($data,$def=site_url('/public'.$_SERVER['PATH_INFO']));