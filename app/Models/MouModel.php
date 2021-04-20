<?php

namespace App\Models;

use CodeIgniter\Model;

class MouModel extends Model
{
    public function getMouCount(){
        $db = \Config\Database::connect();
        $mou = $db->table('mou')->get()->getResult();
        $mouCount=count($mou);
        return $mouCount;
    }
    public function getMou($year){
        $db = \Config\Database::connect();
        $builder = $db->table('mou');
        $builder->like('mou_date',$year,'after');
        $mou=$builder->get()->getResult();
        $builder = $db->table('school');
        $schools=$builder->get()->getResult();
            $school=array();
            foreach($schools as $row){
                $school[$row->school_id]=$row->school_name;
            }
        $builder = $db->table('business');
        $businesss=$builder->get()->getResult();
        $business=array();
        foreach($businesss as $row){
            $business[$row->business_id]=$row->business_name;
        }
        $builder = $db->table('govdata');
        $govs=$builder->get()->getResult();
        $gov=array();
        foreach($govs as $row){
            $gov[$row->gov_id]=$row->gov_name;
        }
        $result=array(
            'mou'=>$mou,
            'school'=>$school,
            'business'=>$business,
            'gov'=>$gov,
        );
        return $result;
    }
    public function getMouYearCount($year){
        $db = \Config\Database::connect();
        $builder = $db->table('mou');
        $builder->like('mou_date',$year,'after');
        $mou=$builder->get()->getResult();
        $mouCount=count($mou);
        return $mouCount;
    }
    public function getBusinessCount(){
        $db = \Config\Database::connect();
        $builder = $db->table('mou');
        $builder->select('business_id');
        $builder->distinct();
        $business=$builder->get()->getResult();
        $businessCount=count($business);
        return $businessCount;
    }
    public function addMou($data){
		//print_r($data);
        $db = \Config\Database::connect();
        $builder = $db->table('mou');
        $result=$builder->insert($data);
        //print $db->getLastQuery();
        return $result;
    }
}