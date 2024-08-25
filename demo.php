<?php

require_once 'core/init.php';


// Select //
$user = DB::getInstance()->get('crm_users',array('username','=','msindhu1212@gmail.com'));
//                  or
// $user = DB::getInstance()->query("SELECT * FROM crm_users");

if(!$user->count()){
    echo 'No User';
}else{
    foreach($user->results() as $user){
        echo $user->username, '<br />';
        echo $user->password_hash, '<br />';
        echo $user->first_name, '<br />';
        echo $user->last_name, '<br />';
    }
}



// Delete //
//$delete_user = DB::getInstance()->delete('crm_users', array('first_name' => 'Sai Deepak'));

// Insert //
/* $insert_user = DB::getInstance()->insert('crm_users',array(
                'username' => 'sai@livewd.ca',
                'first_name' => 'Sai Deepak',
                'last_name' => 'Chandrasekhar' 
            ));
*/


// Update //
//$update_user = DB::getInstance()->update('crm_users', 1, array('first_name' => 'Sai Deepak'));