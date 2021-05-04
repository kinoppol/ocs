<?php

namespace App\Models;

use CodeIgniter\Model;

class OrgModel extends Model
{
    public function getSchool(){
        $db = \Config\Database::connect();
        $builder = $db->table('school');
        $data=$builder->get()->getResult();
            $datas=array();
            foreach($data as $row){
                $datas[$row->school_id]=$row->school_name;
            }
        return $datas;
    }
    public function schoolData($school_id){
        $db = \Config\Database::connect();
        $builder = $db->table('school');
        $builder->where('school_id',$school_id);
        $data=$builder->get()->getResult();
        return $data[0];
    }

    public function getGov(){
        $db = \Config\Database::connect();
        $builder = $db->table('govdata');
        $data=$builder->get()->getResult();
            $datas=array();
            foreach($data as $row){
                $datas[$row->gov_id]=$row->gov_name;
            }
        return $datas;
    }
    
    public function getInstitute(){
        $db = \Config\Database::connect();
        $builder = $db->table('data_institute');
        $data=$builder->get()->getResult();
            $datas=array();
            foreach($data as $row){
                $datas[$row->institute_id]=$row->institute_name;
            }
        return $datas;
    }

}
