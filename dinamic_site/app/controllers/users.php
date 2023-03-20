<?php
require_once SITE_ROOT . "/app/database/db.php";

$isSubmit = false;
$errMsg = [];

function userAuth($user){
    $_SESSION['id'] = $user['id'];
    $_SESSION['login'] = $user['username'];
    $_SESSION['admin'] = $user['admin'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['psw'] = $user['password'];
    setcookie('user_id', $user['id'], time() + 1200);
    setcookie('login', $_SESSION['login'], time() + 1200);
    setcookie('email', $user['email'], time() + 1200);
    setcookie('psw', $user['password'], time() + 1200);
    setcookie('admin', $user['admin'], time() + 1200);
    if($_SESSION['admin']){
        header('location: ' . BASE_URL . "admin/posts/index.php");
    }else{
        header('location: ' . BASE_URL . "single.php");
    }
}
//Код для формы регистрации
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button-reg'])) {
    $admin = 0;
    $login = trim($_POST['login']);  //обращение по name
    $email = trim($_POST['email']);  // trim убирает пробелы из формы регистрации
    $passF = trim($_POST['pass-first']);
    $passS = trim($_POST['pass-second']);

    //$admin = $_POST['checkbox'];
    //$adminCode = $_POST['adminCode']; // просто один код при неверном его вводе происходит ошибка входа

    //Проверки
    if ($login === '' || $email === '' || $passF === '') {   //Есть ли пустые поля
        array_push($errMsg,"Не все поля заполненны!");
    } elseif (mb_strlen($login, 'UTF-8') < 2) {   // логин не короче 2х символов
        array_push($errMsg,"Логин не должен быть короче двух символов");
    }elseif ($passF !== $passS) {
        $errMsg = "Пароли не совпадают!";
    }else {
        $existence = selectOne('users', ['email' => $email]);
        if (is_array($existence) && isset($existence['email']) && $existence['email'] === $email) {
            array_push($errMsg,"Пользователь с такой почтой уже зарегистрирован!");
        } else {
            // $pass = password_hash($passF, PASSWORD_DEFAULT);
            $post = [
                'admin' => $admin,
                'username' => $login,
                'email' => $email,
                'password' => password_hash($passF, PASSWORD_DEFAULT)
            ];
            $id = insert('users', $post);
            $user = selectOne('users', ['id' => $id] );

            userAuth($user);
        }
    }

    //$last_row = selectOne('users', ['id'=>$id]); //Отправка в таблицу
}else{
    $login = '';
    $email = '';
}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button-log'])) {
    $email = trim($_POST['email']);
    $pass = trim($_POST['password']);

    if ($email === '' || $pass === '') {   //Есть ли пустые поля
        array_push($errMsg,"Не все поля заполненны!");
    }else {
        $existence = selectOne('users', ['email' => $email]);
        if($existence && password_verify($pass, $existence['password'])) {
            userAuth($existence);
        }else{
            array_push($errMsg,"Почта либо пароль введены неверно");
            }
        }
}else{
    $email = '';
}




// Код добавления пользователя в админке
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create-user'])){


    $admin = 0;
    $login = trim($_POST['login']);
    $email = trim($_POST['mail']);
    $passF = trim($_POST['pass-first']);
    $passS = trim($_POST['pass-second']);

    if($login === '' || $email === '' || $passF === ''){
        array_push($errMsg, "Не все поля заполнены!");
    }elseif (mb_strlen($login, 'UTF8') < 2){
        array_push($errMsg, "Логин должен быть более 2-х символов");
    }elseif ($passF !== $passS) {
        array_push($errMsg, "Пароли в обеих полях должны соответствовать!");
    }else{
        $existence = selectOne('users', ['email' => $email]);
        if($existence && count($existence) > 0 && $existence['email'] === $email){
            array_push($errMsg, "Пользователь с такой почтой уже зарегистрирован!");
        }else{
            $pass = password_hash($passF, PASSWORD_DEFAULT);
            if (isset($_POST['admin'])) $admin = 1;
            $user = [
                'admin' => $admin,
                'username' => $login,
                'email' => $email,
                'password' => $pass
            ];
            $id = insert('users', $user);
            $user = selectOne('users', ['id' => $id] );
            userAuth($user);
        }
    }
}else{
    $login = '';
    $email = '';
}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create-user-admin'])){


    $admin = 0;
    $login = trim($_POST['login']);
    $email = trim($_POST['mail']);
    $passF = trim($_POST['pass-first']);
    $passS = trim($_POST['pass-second']);

    if($login === '' || $email === '' || $passF === ''){
        array_push($errMsg, "Не все поля заполнены!");
    }elseif (mb_strlen($login, 'UTF8') < 2){
        array_push($errMsg, "Логин должен быть более 2-х символов");
    }elseif ($passF !== $passS) {
        array_push($errMsg, "Пароли в обеих полях должны соответствовать!");
    }else{
        $existence = selectOne('users', ['email' => $email]);
        if($existence && count($existence) > 0 && $existence['email'] === $email){
            array_push($errMsg, "Пользователь с такой почтой уже зарегистрирован!");
        }else{
            $pass = password_hash($passF, PASSWORD_DEFAULT);
            if (isset($_POST['admin'])) $admin = 1;
            $user = [
                'admin' => $admin,
                'username' => $login,
                'email' => $email,
                'password' => $pass
            ];
            $id = insert('users', $user);
            $user = selectOne('users', ['id' => $id] );
        }
    }
}else{
    $login = '';
    $email = '';
}

// Код удаления пользователя в админке
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete_id'])){
    $id = $_GET['delete_id'];
    delete('users', $id);
    header('location: ' . BASE_URL . 'admin/users/index.php');
}

// РЕДАКТИРОВАНИЕ ПОЛЬЗОВАТЕЛЯ ЧЕРЕЗ АДМИНКУ
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['edit_id'])){
    $user = selectOne('users', ['id' => $_GET['edit_id']]);

    $id =  $user['id'];
    $admin =  $user['admin'];
    $username = $user['username'];
    $email = $user['email'];
}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update-user'])){

    $id = $_POST['id'];
    $mail = trim($_POST['mail']);
    $login = trim($_POST['login']);
    $passF = trim($_POST['pass-first']);
    $passS = trim($_POST['pass-second']);
    $admin = isset($_POST['admin']) ? 1 : 0;

    if($login === ''){
        array_push($errMsg, "Не все поля заполнены!");
    }elseif (mb_strlen($login, 'UTF8') < 2){
        array_push($errMsg, "Логин должен быть более 2-х символов");
    }elseif ($passF !== $passS) {
        array_push($errMsg, "Пароли в обеих полях должны соответствовать!");
    }else{
        $pass = password_hash($passF, PASSWORD_DEFAULT);
        if (isset($_POST['admin'])) $admin = 1;
        $user = [
            'admin' => $admin,
            'username' => $login,
//            'email' => $mail,
            'password' => $pass
        ];

        $user = update('users', $id, $user);
        header('location: ' . BASE_URL . 'admin/users/index.php');
    }
}else{
    /*$id =  $user['id'];
    $admin =  $user['admin'];
    $username = $user['username'];
    $email = $user['email'];*/
}

//if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['pub_id'])){
//    $id = $_GET['pub_id'];
//    $publish = $_GET['publish'];
//
//    $postId = update('posts', $id, ['status' => $publish]);
//
//    header('location: ' . BASE_URL . 'admin/posts/index.php');
//    exit();
//}