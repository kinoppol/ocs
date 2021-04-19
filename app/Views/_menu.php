<?php
helper('menu');
helper('user');

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
    'register'=>array(
        'text'=>'ลงทะเบียน',
        'url'=>site_url('public/user/register'),
        'bullet'=>'portrait',
        'cond'=>current_user('user_type')=='user',
    ),
    'school'=>array(
        'text'=>'ข้อมูลสถานศึกษา',
        'url'=>site_url('public/school/detail'),
        'bullet'=>'school',
        'cond'=>current_user('user_type')=='school',

    ),
    'govBasic'=>array(
        'text'=>'ข้อมูลพื้นฐานของ อ.กรอ.อศ.',
        'url'=>site_url('public/school/detail'),
        'bullet'=>'people',
        'cond'=>current_user('user_type')=='gov',

    ),
    'instituteBasic'=>array(
        'text'=>'ข้อมูลพื้นฐานของสถาบันฯ',
        'url'=>site_url('public/institute/detail'),
        'bullet'=>'home',
        'cond'=>current_user('user_type')=='institute',

    ),
    'business'=>array(
        'text'=>'ข้อมูลสถานประกอบการ',
        'url'=>site_url('public/business/list'),
        'bullet'=>'apartment',
        'cond'=>current_user('user_type')!='board',

    ),
    'mou'=>array(
        'text'=>'การลงนามความร่วมมือ',
        'url'=>site_url('public/mou/'),
        'bullet'=>'history_edu',
        'cond'=>current_user('user_type')!='user'&&current_user('user_type')!='board',
        'items'=>array(
            'list'=>array(
                'text'=>'รายการ MOU',
                'url'=>site_url('public/mou/list'),
                'cond'=>true,
            ),
            'search'=>array(
                'text'=>'เพิ่มข้อมูล MOU',
                'url'=>site_url('public/mou/searchBusiness'),
                'cond'=>true,
            ),

        ),
    ),
    'manage'=>array(
        'text'=>'จัดการ',
        'url'=>site_url(),
        'bullet'=>'engineering',
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
    
        'gov'=>array(
            'text'=>'การดำเนินงานของ อ.กรอ.อศ.',
            'url'=>site_url(),
            'bullet'=>'receipt_long',
            'cond'=>current_user('user_type')=='gov',
            'items'=>array(
                'menu1'=>array(
                    'text'=>'งาน 1',
                    'url'=>site_url('public/admin/systemSetting'),
                    'cond'=>true,
                    ),
                'menu2'=>array(
                    'text'=>'งาน 2',
                    'url'=>site_url('public/admin/userManage'),
                    'cond'=>true,
                    ),
                ),
            ),
            'boardSchool'=>array(
                'text'=>'ข้อมูลสถานศึกษา',
                'url'=>site_url(),
                'bullet'=>'school',
                'cond'=>current_user('user_type')=='board',
                ),
            'boardInstitute'=>array(
                'text'=>'ข้อมูลสถาบันการอาชีวศึกษา',
                'url'=>site_url(),
                'bullet'=>'account_balance',
                'cond'=>current_user('user_type')=='board',
                ),
            'boardBusiness'=>array(
                'text'=>'ข้อมูลสถานประกอบการ',
                'url'=>site_url(),
                'bullet'=>'apartment',
                'cond'=>current_user('user_type')=='board',
                ),
            'boardGov'=>array(
                'text'=>'ข้อมูล อ.กรอ.อศ.',
                'url'=>site_url(),
                'bullet'=>'people',
                'cond'=>current_user('user_type')=='board',
                ),
            'boardMou'=>array(
                'text'=>'ข้อมูลการลงนามความร่วมมือ',
                'url'=>site_url(),
                'bullet'=>'history_edu',
                'cond'=>current_user('user_type')=='board',
                ),
            'report'=>array(
                'text'=>'รายงานผลการดำเนินงาน',
                'url'=>site_url(),
                'bullet'=>'assessment',
                'cond'=>true,
                ),
);


print genMainMenu($data,$def=site_url('/public'.$_SERVER['PATH_INFO']));