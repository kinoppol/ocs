<?php

namespace App\Models;

use CodeIgniter\Model;

class SchoolModel extends Model
{
    public function getSumStudent($school_id,$type=false){
        $db = \Config\Database::connect();
        $builder=$db->table('summary_of_student');
        if($type!='dve')$builder->selectSum('count_val');
        else if($type=='dve')$builder->selectSum('count_dve_val');
        if(is_array($school_id)&&$school_id[0]!=''){
            //print "5555";
            $builder->where('school_id in ('.implode(',',$school_id).')');
        }else if(is_array($school_id)&&count($school_id)==0){
            return false;
        }else{
            $builder->where('school_id',$school_id);
        }
        $count = $builder->get()->getResult();
        //print $db->getLastQuery();
        return $count[0];
    }
}