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
}