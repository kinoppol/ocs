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
                    'book_no'=>$row->book_no,
                    'subject'=>$row->subject,
                    'meetting_date'=>$row->meetting_date,
                    'meetting_place'=>$row->meetting_place,/*
                    'meettingRecord'=>$row->meettingRecord,
                    'pictures'=>$row->pictures,*/
                );
            }
            //print_r($datas);
        return $datas;
    }
    public function getGovData($id=false){
        $db = \Config\Database::connect();
        $builder = $db->table('govdata');
        $builder->where('gov_id',$id);
        $data=$builder->get()->getResult();
        return $data[0];
    }
    public function meettingAdd($data){
        $db = \Config\Database::connect();
        $builder = $db->table('meetting_record');
        $result=$builder->insert($data);
        return $db->insertID();
    }
    public function meettingUpdate($id,$data){
        $db = \Config\Database::connect();
        $builder = $db->table('meetting_record');
        $builder->where('id',$id);
        $result=$builder->update($data);
        return $result;
    }
    public function getMeettingData($id){
        $db = \Config\Database::connect();
        $builder = $db->table('meetting_record');
        $builder->where('id',$id);
        $result=$builder->get()->getResult();
        return $result[0];
    }
    
    public function meettingDelete($id){
        $db = \Config\Database::connect();
        $builder = $db->table('meetting_record');
        $builder->where('id',$id);
        $result=$builder->delete();
        return $result;
    }
}