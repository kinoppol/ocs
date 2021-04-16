<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    public function getUsers(){
        $db = \Config\Database::connect();
        $builder = $db->table('userdata');
        $builder->select(['username','name','surname','email','user_type']);
        $users = $builder->get()->getResult();
        return $users;
    }
    public function checkUser($data){
        $db = \Config\Database::connect();
        $user = $db->table('userdata')->getWhere($data)->getResult();
        return $user;
    }
    public function checkEmail($email){
        $db = \Config\Database::connect();
        $user = $db->table('userdata')->getWhere(['email'=>$email])->getResult();
        return $user;
    }
    public function addUser($data){
        $db = \Config\Database::connect();
        $builder = $db->table('userdata');
        $result=$builder->insert($data);
        return $result;
    }
    public function updateUser($email,$data){
        $db = \Config\Database::connect();
        $builder = $db->table('userdata');
        $builder->where('email', $email);
        $result=$builder->update($data);
        return $result;
    }
}