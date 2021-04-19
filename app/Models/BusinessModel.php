<?php

namespace App\Models;

use CodeIgniter\Model;

class MouModel extends Model
{
    public function getBusiness(){
        $db = \Config\Database::connect();
        $builder = $db->table('business');
        $data=$builder->get()->getResult();
            $datas=array();
            foreach($data as $row){
                $datas[$row->business_id]=array(
                    'business_name'=>$row->business_name,
                    'province_id'=>$row->province_id,
                    'district_id'=>$row->district_id,
                    'subdistrict_id'=>$row->subdistrict_id,
                    'road'=>$row->road,
                    'address_no'=>$row->address_no,
                );
            }
        return $datas;
    }
    public function searchBusiness($q=''){
        $db = \Config\Database::connect();
        $builder = $db->table('business');
        $builder->like('business_name', $q, 'both');
        $data=$builder->get()->getResult();
            $datas=array();
            foreach($data as $row){
                $datas[$row->business_id]=array(
                    'business_name'=>$row->business_name,
                    'province_id'=>$row->province_id,
                    'district_id'=>$row->district_id,
                    'subdistrict_id'=>$row->subdistrict_id,
                    'road'=>$row->road,
                    'address_no'=>$row->address_no,
                );
            }
        return $datas;
    }
}