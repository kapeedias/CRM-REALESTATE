<?php
//error_reporting(1);


session_start();

// Replace these variables with your database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "real360";

$GLOBALS['config'] = array(
    'mysql' => array(
        'host' => $servername,
        'username' => $username,
        'password' => $password,
        'db' => $dbname
    ),
    'remember' => array(
        'cookie_name' => 'livewd_hash',
        'cookie_expiry' =>  604800
    ),
    'session' => array(
        'session_name' => 'user',
        'token_name' => 'token'
    )
);

spl_autoload_register(function ($class) {
    require_once 'classes/' . $class . '.php';
});

require_once 'functions/sanitize.php';


if (Cookie::exists(Config::get('remember/cookie_name')) && !Session::exists(Config::get('session/session_name'))) {
    $hash = Cookie::get(Config::get('remember/cookie_name'));
    $hashCheck = DB::getInstance()->get('user_session', array('hash', '=', $hash));

    if ($hashCheck->count()) {
        $user = new User($hashCheck->first()->user_id);
        $user->login();
    }
}

$publicHtmlPath = dirname(__DIR__);
$mls_img_upload = $publicHtmlPath . "/assets/img/mls";
