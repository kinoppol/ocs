<?php
namespace App\Models;

use CodeIgniter\Model;

class SummaryModel extends Model
{
    public function getProvince($province_id=false){
        $db = \Config\Database::connect();
        $builder = $db->table('data_province');
        $data=$builder->get()->getResult();
        return $data;
    }
    public function getProvinceMouCount($by='school'){
        $db = \Config\Database::connect();
        $builder = $db->table($by);
        $builder->select('mapcode as p, count(*) as c');
        $builder->join('mou','mou.school_id=school.school_id');
        $builder->join('data_province','data_province.province_code=school.province_id');
        $builder->groupBy('p');
        $data=$builder->get()->getResult();
        return $data;
    }
    
}