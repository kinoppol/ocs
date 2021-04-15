<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    public function getUsers(){
        $db = \Config\Database::connect();
        $users = $db->table('userdata')->get()->getResult();
        return $users;
    }
    public function checkUser($data){
        $db = \Config\Database::connect();
        $user = $db->table('userdata')->getWhere($data)->getResult();
        return $user;
    }
}