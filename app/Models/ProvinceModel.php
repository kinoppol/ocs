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
}