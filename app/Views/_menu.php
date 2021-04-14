<?php
function genMainMenu($data){
    $ret='';

    $ret='<ul class="list">
    <li class="header">เมนูหลัก</li>'.(is_array($data)?genMenu($data):'')
    .'   
    </li>
    </ul>
    ';
    return $ret;
}

function genMenu($data){
    $ret='';
    foreach($data as $row){
        if(isset($row['items'])&&is_array($row['items'])){
            $ret.='<li>
            <a href="javascript:void(0)" class="menu-toggle">
                <i class="material-icons">'.$row['bullet'].'</i>
                <span>'.$row['text'].'</span>
            </a>
            '.genSubMenu($row['items']).'
            </li>';
        }else{
        $ret.='<li>
                <a href="'.$row['url'].'">
                    <i class="material-icons">'.$row['bullet'].'</i>
                    <span>'.$row['text'].'</span>
                </a>
            </li>';
        }
    }
    return $ret;
}
$data=array(
    'home'=>array(
        'text'=>'หน้าหลัก',
        'url'=>site_url(),
        'bullet'=>'book',
        'items'=>array(
            'dashboard'=>array(
                'text'=>'ภาพรวม',
                'url'=>site_url(),
                'bullet'=>'book',
                'items'=>array(
                    'dashboard'=>array(
                        'text'=>'อีกๆ',
                        'url'=>site_url(),
                        'bullet'=>'book',
                        ),
                    ),
                ),
            ),
        ),
        
    'manage'=>array(
        'text'=>'จัดการ',
        'url'=>site_url(),
        'bullet'=>'swap_calls',
        ),
);

function genSubMenu($data){
    $ret='<ul class="ml-menu">';
    foreach($data as $row){
        if(isset($row['items'])&&is_array($row['items'])){
        $ret.='
            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <span>'.$row['text'].'<span>
                </a>
                '.genSubMenu($row['items']).'
            </li>
            ';            
        }else{
        $ret.='
            <li>
                <a href="'.$row['url'].'">'.$row['text'].'</a>
            </li>
            ';
        }
    }
    $ret.='</ul>';
    return $ret;
}
print genMainMenu($data);