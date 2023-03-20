<?php
require_once SITE_ROOT . "/app/database/db.php";//может оно ругается на это!
if(!$_SESSION){   //если сессия обнулиласть то пользователь попадает на log.php
    header('location' . BASE_URL . 'log.php');
}


$postsAdm = selectAllFromPostWithUsers('posts', 'users');



$errMsg = [];
$id='';
$img = '';
/*$id = '';
$name = '';
$l_name = '';
$f_name = '';
$seria = '';
$num = '';
$r_date = '';
$adres = '';
$select = '';
$img = '';*/


//$checkbox = isset($_POST['parametr']) !== null ? 1 : 0 ; если parametr не ноль то прилетает 1 если нул то 0

$posts = selectAll('posts');
$pasport = selectAll('pasport');//latest add
$postsAdm = selectAllFromPostWithUsers('posts', 'users');


//$userDoc = DocGet('posts', $posts['id']);


// Апдейт договора
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])){
    $id = $_GET['id'];
    $post = selectOne('posts', ['id' => $_GET['id']]);
    $pasport = selectOne('pasport', ['id' => $_GET['id']]);
    $id = $post['id'];
    $status = $post['status'];
    /*$num_account = $post['num_account'];
    $type = $post['type'];
    $created_date = $post['created_date'];*/

    /*$name = $pasport['name'];
    $l_name = $pasport['last_name'];
    $f_name = $pasport['father_name'];
    $seria = $pasport['seria'];
    $num = $pasport['num'];
    $r_date = $pasport['date'];
    $adres = $pasport['adres'];
    $img= $pasport['img'];*/
}
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_post'])){
    $status = trim($_POST['status']);
    $post = [
        'status' => 2,
    ];
    $id = $_POST['id'];
    $post_id = update('posts', $id, $post);
    header('location: ' . BASE_URL . 'admin/posts/index.php');
}
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reject_post'])){
    $status = trim($_POST['status']);
    $post = [
        'status' => 3,
    ];
    $id = $_POST['id'];
    $post_id = update('posts', $id, $post);
    header('location: ' . BASE_URL . 'admin/posts/index.php');
}
//$img = trim($_POST['img']);*/
/*if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_post'])){
    //$id = $_POST['id']; //добавил может не работать из-за этого
    $name = trim($_POST['name']);
    $l_name = trim($_POST['Last_name']);
    $f_name = trim($_POST['Father_name']);
    $seria = trim($_POST['seria']);
    $num = trim($_POST['num']);
    $r_date = trim($_POST['date']);
    $adres = trim($_POST['adres']);
    $select = trim($_POST['select']);}*/
//$img = trim($_POST['img']);*/

//    /*if (!empty($_FILES['img']['name'])) {
//        $imgName = time() . "_" . $_FILES['img']['name'];
//        $fileTmpName = $_FILES['img']['tmp_name'];
//        $fileType = $_FILES['img']['type'];
//        $destination = ROOT_PATH . "\assets\images\pasports\\" . $imgName;
//
//        if (strpos($fileType, 'image') === false) {
//            array_push($errMsg, "Можно загружать только изображения!" );
//
//        } else {
//
//            $result = move_uploaded_file($fileTmpName, $destination);
//
//            if ($result) {
//                $_POST['img'] = $imgName;
//            } else {
//                array_push($errMsg, "Ошибка загрузки изображения на сервер!");
//            }
//        }
//    }else{
//        array_push($errMsg, "Ошибка получения картинки!");
//    }*/



/*if($name === '' || $l_name === '' || $f_name === '' || $seria === '' || $r_date === '' || $adres === '' || $select === '' || $img === ''){
    array_push($errMsg, "Не все поля заполнены!");
}elseif (mb_strlen($seria, 'UTF8') < 4){
    array_push($errMsg, "Серия должна быть более 4-х символов");
}elseif (mb_strlen($num, 'UTF8') < 6){
    array_push($errMsg, "Номер должен состоять из шести цифр");
}else{
    $post = [
        'id_user' =>$_SESSION['id'],  //первое знач '' как в БД
        'num_account' => $_SESSION['id'] + 100,
        'status' => 1, // 1 будет значить что договор сформирован, но не проверен
        'type' => $select,
        //'created_date' => '',
        //'id_pasport' => '',
        //'id_cart' => '',
        /*'name'=>$name,
        'last_name'=>$l_name,
        'father_name'=>$f_name,
        'seria'=>$seria,
        'num'=>$num,
        'date'=> $r_date,
        'adres'=>$adres,
        'img'=>$img*/
/*];
$pasport = [
    'name'=>$name,
    'last_name'=>$l_name,
    'father_name'=>$f_name,
    'seria'=>$seria,
    'num'=>$num,
    'date'=> $r_date,
    'adres'=>$adres,
    /*'img'=>$img*/
//'img' => $_POST['img']
/* ];
 $post = update('posts', $post['id'], $post);
 $pasport = update('pasport',$pasport['id'], $pasport);
 header('location: ' . BASE_URL . 'admin/posts/index.php');
}

}else{*

$name = '';
$l_name = '';
$f_name = '';
$seria = '';
$num = '';
$r_date = '';
$adres = '';
$select = '';
$img = '';}*/
//не работают изменения!!!! 40видос 36 мин


// Удаление договора
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete_id'])){
    $id = $_GET['delete_id'];
    delete('posts', $id);
    delete('pasport', $id);
    header('location: ' . BASE_URL . 'admin/posts/index.php');
}


