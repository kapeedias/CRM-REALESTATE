<?php

require_once 'core/init.php';

$user = DB::getInstance()->query("SELECT username FROM crm_users WHERE username = 'sai@livewd.caa'");
if($user->error()){
    echo 'No User';
}else{
    echo 'OK';
}