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
    public function getPublic($gov_id=false){
        $db = \Config\Database::connect();
        $builder = $db->table('public');
        $builder->where('gov_id',$gov_id);
        $data=$builder->get()->getResult();
        return $data;
    }

    public function publicAdd($data){
        $db = \Config\Database::connect();
        $builder = $db->table('public');
        $result=$builder->insert($data);
        return $db->insertID();
    }
    public function publicUpdate($id,$data){
        $db = \Config\Database::connect();
        $builder = $db->table('public');
        $builder->where('id',$id);
        $result=$builder->update($data);
        return $result;
    }
    public function getPublicData($id){
        $db = \Config\Database::connect();
        $builder = $db->table('public');
        $builder->where('id',$id);
        $result=$builder->get()->getResult();
        return $result[0];
    }
    
    public function publicDelete($id){
        $db = \Config\Database::connect();
        $builder = $db->table('public');
        $builder->where('id',$id);
        $result=$builder->delete();
        return $result;
    }
    public function getTrainerDev($gov_id){
        $db = \Config\Database::connect();
        $builder = $db->table('govtrainer_dev');
        $builder->where('gov_id',$gov_id);
        $result=$builder->get()->getResult();
        return $result;
    }
    public function getTrainerDevData($id){
        $db = \Config\Database::connect();
        $builder = $db->table('govtrainer_dev');
        $builder->where('id',$id);
        $result=$builder->get()->getResult();
        return $result[0];
    }

    public function trainerDevAdd($data){
        $db = \Config\Database::connect();
        $builder = $db->table('govtrainer_dev');
        $result=$builder->insert($data);
        return $db->insertID();
    }

    public function trainerDevUpdate($id,$data){
        $db = \Config\Database::connect();
        $builder = $db->table('govtrainer_dev');
        $builder->where('id',$id);
        $result=$builder->update($data);
        return $result;
    }
    public function trainerDevDelete($id){
        $db = \Config\Database::connect();
        $builder = $db->table('govtrainer_dev');
        $builder->where('id',$id);
        $result=$builder->delete();
        return $result;
    }


    public function getTeacherDev($gov_id){
        $db = \Config\Database::connect();
        $builder = $db->table('govteacher_dev');
        $builder->where('gov_id',$gov_id);
        $result=$builder->get()->getResult();
        return $result;
    }
    public function getTeacherDevData($id){
        $db = \Config\Database::connect();
        $builder = $db->table('govteacher_dev');
        $builder->where('id',$id);
        $result=$builder->get()->getResult();
        return $result[0];
    }

    public function teacherDevAdd($data){
        $db = \Config\Database::connect();
        $builder = $db->table('govteacher_dev');
        $result=$builder->insert($data);
        return $db->insertID();
    }

    public function teacherDevUpdate($id,$data){
        $db = \Config\Database::connect();
        $builder = $db->table('govteacher_dev');
        $builder->where('id',$id);
        $result=$builder->update($data);
        return $result;
    }
    public function teacherDevDelete($id){
        $db = \Config\Database::connect();
        $builder = $db->table('govteacher_dev');
        $builder->where('id',$id);
        $result=$builder->delete();
        return $result;
    }


    public function getStudentDev($gov_id){
        $db = \Config\Database::connect();
        $builder = $db->table('govstudent_dev');
        $builder->where('gov_id',$gov_id);
        $result=$builder->get()->getResult();
        return $result;
    }
    public function getStudentDevData($id){
        $db = \Config\Database::connect();
        $builder = $db->table('govstudent_dev');
        $builder->where('id',$id);
        $result=$builder->get()->getResult();
        return $result[0];
    }

    public function studentDevAdd($data){
        $db = \Config\Database::connect();
        $builder = $db->table('govstudent_dev');
        $result=$builder->insert($data);
        return $db->insertID();
    }

    public function studentDevUpdate($id,$data){
        $db = \Config\Database::connect();
        $builder = $db->table('govstudent_dev');
        $builder->where('id',$id);
        $result=$builder->update($data);
        return $result;
    }
    public function studentDevDelete($id){
        $db = \Config\Database::connect();
        $builder = $db->table('govstudent_dev');
        $builder->where('id',$id);
        $result=$builder->delete();
        return $result;
    }


    public function getProject($gov_id){
        $db = \Config\Database::connect();
        $builder = $db->table('govproject_record');
        $builder->where('gov_id',$gov_id);
        $result=$builder->get()->getResult();
        return $result;
    }
    public function getProjectData($id){
        $db = \Config\Database::connect();
        $builder = $db->table('govproject_record');
        $builder->where('id',$id);
        $result=$builder->get()->getResult();
        return $result[0];
    }

    public function projectAdd($data){
        $db = \Config\Database::connect();
        $builder = $db->table('govproject_record');
        $result=$builder->insert($data);
        return $db->insertID();
    }

    public function projectUpdate($id,$data){
        $db = \Config\Database::connect();
        $builder = $db->table('govproject_record');
        $builder->where('id',$id);
        $result=$builder->update($data);
        return $result;
    }
    public function projectDelete($id){
        $db = \Config\Database::connect();
        $builder = $db->table('govproject_record');
        $builder->where('id',$id);
        $result=$builder->delete();
        return $result;
    }
}