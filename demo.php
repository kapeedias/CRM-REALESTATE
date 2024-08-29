<?php

require_once 'core/init.php';

/*
// Select //
$user = DB::getInstance()->get('crm_users',array('username','=',''));
//                  or
// $user = DB::getInstance()->query("SELECT * FROM crm_users");
$password = '';
$inputPassword = '';
$salt = Hash::salt(32);

if(!$user->count()){
    echo 'No User';
}else{
    foreach($user->results() as $user){
        //echo $user->username, '<br />';
        //echo $user->password_hash, '<br /><br />';
      //  echo $user->salt. '<br /><br />';
    }
}
/*
echo 'Entered Password: '.$pwd. '<br />';
echo "Salt: $salt\n". '<br />';
echo 'Hashed Password: '. Hash::make($pwd, $salt). '<br />';



$hashedPassword = $user->password_hash;

// Output hashed password and salt
echo "Salt: $salt\n". '<br />';
echo "Hashed Password: $hashedPassword\n". '<br />';

// To verify the password, you would hash the input again with the same salt and compare
if (Hash::make($inputPassword, $user->salt) === $user->password_hash) {
    echo "Password is correct.";
} else {
    echo "Invalid password.";
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
//$update_user = DB::getInstance()->update('crm_users', 3, array('first_name' => 'Sai Deepak'));