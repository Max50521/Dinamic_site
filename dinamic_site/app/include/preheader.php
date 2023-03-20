<?php
require_once SITE_ROOT . "/app/database/db.php";

if(session_status() !== PHP_SESSION_ACTIVE) session_start();
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 120)) {
    session_unset();
    session_destroy();
    echo "<script type='text/javascript'>alert('Время сессии вышло' );
            window.location.replace('" . BASE_URL . "/index.php');
        </script>";
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp

$arr = ['id' => 'user_id', 'login' => 'login', 'email' => 'email', 'psw' => 'psw', 'admin' => 'admin'];
foreach($arr as $key => $val) {
    if(!isset($_SESSION[$key])){
        if(isset($_COOKIE[$val])){
            $_SESSION[$key] = $_COOKIE[$val];
        }
    }
}
// echo $_COOKIE['login'];
// echo $_COOKIE['psw'];
// var_dump($_COOKIE);
// var_dump($_SESSION);
// die();

?>