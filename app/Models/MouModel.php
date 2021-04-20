<?php

namespace App\Models;

use CodeIgniter\Model;

class MouModel extends Model
{
    public function getMouCount($data=false){
        $db = \Config\Database::connect();
        $builder=$db->table('mou');
        if(isset($data['org_code']))$builder->where('school_id',$data['org_code']);
        $mou = $builder->get()->getResult();
        $mouCount=count($mou);
        return $mouCount;
    }
    public function getMou($data){
        $db = \Config\Database::connect();
        $builder = $db->table('mou');
        $builder->like('mou_date',$data['year'],'after');
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
    public function getMouYearCount($data){
        $db = \Config\Database::connect();
        $builder = $db->table('mou');
        if(isset($data['org_code']))$builder->where('school_id',$data['org_code']);
        $builder->like('mou_date',$data['year'],'after');
        $mou=$builder->get()->getResult();
        $mouCount=count($mou);
        return $mouCount;
    }
    public function getBusinessCount($data=false){
        $db = \Config\Database::connect();
        $builder = $db->table('mou');
        $builder->select('business_id');
        if(isset($data['org_code']))$builder->where('school_id',$data['org_code']);
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