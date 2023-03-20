<?php
session_start();

include("path.php");

ob_start(); // начало буферизации вывода
setcookie('user_id', null, -1, '/dinamic_site'); 
setcookie('login', null, -1, '/dinamic_site'); 
setcookie('email', null, -1, '/dinamic_site'); 
setcookie('psw', null, -1, '/dinamic_site'); 
setcookie('admin', null, -1, '/dinamic_site');
session_unset();
session_destroy();
unset($_COOKIE);
ob_end_flush(); // конец буферизации вывода
header('Location: ' . BASE_URL);
exit;
?>
