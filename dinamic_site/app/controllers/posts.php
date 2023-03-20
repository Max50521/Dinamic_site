<?php
require_once SITE_ROOT . "/app/database/db.php";//может оно ругается на это!
//include "/app/database/db.php";

if(!$_SESSION){   //если сессия обнулиласть то пользователь попадает на log.php
    header('location' . BASE_URL . 'log.php');
}
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

// $postsAdm = selectAllFromPostWithUsers('posts', 'users');






// Код для формы создания договора
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['post-create'])){
    if (!empty($_FILES['img']['name'])) {
        $imgName = time() . "_" . $_FILES['img']['name'];
        $fileTmpName = $_FILES['img']['tmp_name'];
        $fileType = $_FILES['img']['type'];
        $destination = ROOT_PATH . "\assets\images\pasports\\" . $imgName;

        if (strpos($fileType, 'image') === false) {
            array_push($errMsg, "Можно загружать только изображения!" );

        } else {

            $result = move_uploaded_file($fileTmpName, $destination);

            if ($result) {
                $_POST['img'] = $imgName;
            } else {
                array_push($errMsg, "Ошибка загрузки изображения на сервер!");
            }
        }
    }else{
        array_push($errMsg, "Ошибка получения картинки!");
        }

    $name = trim($_POST['name']);
    $l_name = trim($_POST['Last_name']);
    $f_name = trim($_POST['Father_name']);
    $seria = trim($_POST['seria']);
    $num = trim($_POST['num']);
    $r_date = trim($_POST['date']);
    $adres = trim($_POST['adres']);
    $select = trim($_POST['select']);
    //$img = trim($_POST['img']);


    $query = $pdo->query('SELECT COUNT(*) FROM posts');
    $count = $query->fetchColumn();

    $num_account = $count . (time() / 1000000);
    $num_cart = abs(($count * 30 - 9) . (time() / 1000000));


    if($name === '' || $l_name === '' || $f_name === '' || $seria === '' || $r_date === '' || $adres === '' || $select === '' /*|| $img === ''*/){
        array_push($errMsg, "Не все поля заполнены!");
    }elseif (mb_strlen($seria, 'UTF8') < 4){
        array_push($errMsg, "Серия должна состоять из 4-х символов");
    }elseif (mb_strlen($num, 'UTF8') < 6){
        array_push($errMsg, "Номер должен состоять из шести цифр");
    }else{

        $post = [
            'id_user' =>$_SESSION['id'],
            'status' => 1, // 1 будет значить что договор сформирован, но не проверен
            'type' => $select,
            'cart_num' =>$num_cart, 
            'id_pass' => "(select id from pasport where seria={$seria} and num={$num})",
            'id_cart' => "(select id from cart where num_cart={$num_cart})"
        ];
        $pasport = [
            'name'=>$name,
            'last_name'=>$l_name,
            'father_name'=>$f_name,
            'seria'=>$seria,
            'num'=>$num,
            'date'=> $r_date,
            'adres'=>$adres,
            'img'=>$img
        ];
        $cart = [
            'num_cart' =>$num_cart
        ];
        $pasport = insert('pasport', $pasport);
        $cart = insert('cart', $cart);
        $query = $pdo->prepare("insert into posts (id_user, status, type, cart_num, id_pass, id_cart) values
            ('{$_SESSION['id']}', '1', '{$select}', '{$num_cart}',
             {$pasport},
             {$cart}
            );");
        $query->execute();
        dbCheckError($query);

        // $post = insert('posts', $post);
        // $post = selectOne('posts', [ 'id' => $id ] );
        // $pasport = selectOne('pasport', [ 'id' => $id ] );
        header('location: ' . BASE_URL . 'index.php');//тут проверить header('location: ' . BASE_URL . 'admin/post/index.php')
        }

}else{
    $id = '';
    $name = '';
    $l_name = '';
    $f_name = '';
    $seria = '';
    $num = '';
    $r_date = '';
    $adres = '';
    $select = '';
    $img = '';
}
//разбираемся с id_pass

//SELECT id FROM tbl_1 WHERE string='$string';
function getID1($table){
    global $pdo;
    $id_pass = "SELECT id FROM $table";

    $query = $pdo ->prepare($id_pass);
    $query->execute();

    dbCheckError($query);

    return $query ->fetch();
}


/*
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['post-create'])){
    if (!empty($_FILES['img']['name'])) {
        $imgName = time() . "_" . $_FILES['img']['name'];
        $fileTmpName = $_FILES['img']['tmp_name'];
        $fileType = $_FILES['img']['type'];
        $destination = ROOT_PATH . "\assets\images\pasports\\" . $imgName;

        if (strpos($fileType, 'image') === false) {
            array_push($errMsg, "Можно загружать только изображения!" );

        } else {

            $result = move_uploaded_file($fileTmpName, $destination);

            if ($result) {
                $_POST['img'] = $imgName;
            } else {
                array_push($errMsg, "Ошибка загрузки изображения на сервер!");
            }
        }
    }else{
        array_push($errMsg, "Ошибка получения картинки!");
    }

    $name = trim($_POST['name']);
    $l_name = trim($_POST['Last_name']);
    $f_name = trim($_POST['Father_name']);
    $seria = trim($_POST['seria']);
    $num = trim($_POST['num']);
    $r_date = trim($_POST['date']);
    $adres = trim($_POST['adres']);
    $select = trim($_POST['select']);
    $img = trim($_POST['img']);



    /*$num_account = $_POST['num']+100;
    $num_cart = $_POST['num']+1;


    if($name === '' || $l_name === '' || $f_name === '' || $seria === '' || $r_date === '' || $adres === '' || $select === '' || $img === ''){
        array_push($errMsg, "Не все поля заполнены!");
    }elseif (mb_strlen($seria, 'UTF8') < 4){
        array_push($errMsg, "Серия должна быть более 4-х символов");
    }elseif (mb_strlen($num, 'UTF8') < 6){
        array_push($errMsg, "Номер должен состоять из шести цифр");
    }else{
        $pasport = [
            'name'=>$name,
            'last_name'=>$l_name,
            'father_name'=>$f_name,
            'seria'=>$seria,
            'num'=>$num,
            'date'=> $r_date,
            'adres'=>$adres,
            'img'=>$img
        ];
        $pasport = insert('pasport', $pasport);
        //$cart = insert('cart', $cart);
        $pasport = selectOne('pasport', [ 'id' => $id ] );

    }
    $id_pass = "SELECT 'id' FROM 'pasport' WHERE 'name' = '$name'";
    //$id_pass = "SELECT id FROM pasport WHERE user_id = {$_SESSION['user']->getID()}");
    $post = [
        'id_user' =>$_SESSION['id'],
        'id_pass' =>$id_pass,
        'status' => 1, // 1 будет значить что договор сформирован, но не проверен
        'type' => $select,
        'cart_num' =>$_SESSION['id']+100  //не работает нужет id_post а не юзера
    ];
    $post = insert('posts', $post);
    $post = selectOne('posts', [ 'id' => $id ] );
    header('location: ' . BASE_URL . 'index.php');//тут проверить header('location: ' . BASE_URL . 'admin/post/index.php')


}else{
    $id = '';
    $name = '';
    $l_name = '';
    $f_name = '';
    $seria = '';
    $num = '';
    $r_date = '';
    $adres = '';
    $select = '';
    $img = '';
}
*/


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// Апдейт договора
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])){
    //$id = $_GET['id'];
    $post = selectOne('posts', ['id' => $_GET['id']]);
    $pasport = selectOne('pasport', ['id' => $post['id_pass']]);

/*    $post = selectOne('posts', ['id' => $id]);
    $pasport = selectOne('pasport', ['id' => $id]);*/
    /*$id = $post['id'];
    $status = $post['status'];*/
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

    /// Таблицы заблокированы, ошибок нет
    lockTables();
    $post = [
        'status' => 2,
       ];
    $id = $_POST['id'];
    sleep(10);
    $post_id = update('posts', $id, $post);
    unlockTables();
    header('location: ' . BASE_URL . 'admin/posts/index.php');
}
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reject_post'])){
    /// Ошибка при параллельном доступе
    sleep(10);
    $post = [
        'status' => 3,
    ];
    $id = $_POST['id'];
    $post_id = update('posts', $id, $post);
    header('location: ' . BASE_URL . 'admin/posts/index.php');
}


// Удаление договора
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete_id'])){
    $id = $_GET['delete_id'];
    $post = selectOne('posts', ['id' => $id]);
    delete('posts', $id);
    delete('pasport', $post['id_pass']);
    header('location: ' . BASE_URL . 'admin/posts/index.php');
}

