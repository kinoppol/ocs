<?php
namespace App\Models;

use CodeIgniter\Model;

class GovModel extends Model
{
    public function getMeetting($gov_id=false){
        $db = \Config\Database::connect();
        $builder = $db->table('meetting_record');
        $builder->where('gov_id',$gov_id);
        $data=$builder->get()->getResult();
            $datas=array();
            foreach($data as $row){
                $datas[$row->id]=array(
                    'subject'=>$row->subject,
                    'meetting_date'=>$row->meetting_date,
                    'meetting_place'=>$row->meetting_place,
                );
            }
        return $datas;
    }
    public function getGovData($id=false){
        $db = \Config\Database::connect();
        $builder = $db->table('govdata');
        $builder->where('gov_id',$id);
        $data=$builder->get()->getResult();
        return $data[0];
    }
}