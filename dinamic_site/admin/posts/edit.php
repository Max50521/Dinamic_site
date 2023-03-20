<?php  //session_start();
include "../../path.php";
include "../../app/controllers/posts.php";
//базу д
//controllers/posts.php
// if(isset($_GET['id'])){
//     update('posts', $_GET['id'], ['status' => 4]);
// }
// if($post['status'] != 1){
//     echo "Договор уже на рассмотрении!\n";
//     die();
// }
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/5c41b90810.js" crossorigin="anonymous"></script>
    <!-- Шрифт от гугла  -->
    <link rel="stylesheet" href="../../assets/css/admin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>My Bank</title>
</head>
<body>


<?php include("../../app/include/header-admin.php"); ?>

<div class="container">
    <?//php include "app/include/sidebar-admin.php";?>
    <div class="posts col-15">
        <div class ="row title-table">
            <h2>Проверка договора</h2>
        </div>
        <div class="mb-3 col-12 col-md-4 err"> <!--12-->
            <!--Вывод массива с ошибками-->
            <?php include("../../app/helps/errorinfo.php"); ?>
        </div>
        <div class ="row add-post">
            <form action="index.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                <div class="row">
                    <?php if($pasport){ ?>
                    <div class="col">
                        <input value="<?=$pasport['name']?>" name="name" type="text" class="form-control" placeholder="Имя" aria-label="First name" readonly>
                    </div>
                    <div class="col">
                        <input value="<?=$pasport['Last_name']?>" name="Last_name" type="text" class="form-control" placeholder="Фамилия" aria-label="Last name" readonly>
                    </div>
                    <div class="col">
                        <input value="<?=$pasport['Father_name']?>" name="Father_name" type="text" class="form-control" placeholder="Отчество" aria-label="Father name" readonly>
                    </div>
                    <h3>Данные паспорта</h3>
                    <div class="col-12">
                        <input value="<?=$pasport['seria']?>" name="seria" type="text" class="form-control" id="inputSer" placeholder="Серия" readonly>
                    </div>
                    <div class="col-12">
                        <input value="<?=$pasport['num']?>" name="num" type="text" class="form-control" id="inputNum" placeholder="Номер" readonly>
                    </div>
                    <div class="col-12">
                        <input value="<?=$pasport['date']?>" name="date" type="text" class="form-control" id="inputDate" placeholder="Дата выдачи" readonly>
                    </div>
                    <div class="col-12">
                        <input value="<?=$pasport['adres']?>"  name="adres" type="text" class="form-control" id="inputAd" placeholder="Адрес регистрации" readonly>
                    </div>
                    
                    <div class="input-group mb-3">
                        <div class="col-12">
                            <h5>Фото паспорта</h5>
                        </div>
                        <div class="img col-12">
                            <img src="<?=BASE_URL . 'assets\images\pasports' . "/" . $pasport['img'] ?>" alt="Картинка" class="img-thumbnail" width="60%">
                        </div>
                        
                    </div>
                    <?php if($post['status'] == 1) { ?>
                    <div class="col-12">
                        <button name="edit_post" type="submit" class="btn btn-primary">Подтвердить</button>
                    </div>
                    <div class="col-12">
                        <button name="reject_post" type="submit" class="btn btn-primary">Отклонить</button>
                    </div>
                    <?php } ?>
                    <?php } else { 
                        echo "Не удалось достать данные";
                    }?>
                </div>
            </form>
        </div>
    </div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

</body>
</html>
