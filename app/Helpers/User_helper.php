<?php

function current_user($key){
    $userData=unserialize($_COOKIE['current_user']);
    return $userData[0]->$key;
}