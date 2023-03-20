<?php  //session_start();
include "path.php";
include "app/controllers/posts.php";
//базу д
//controllers/posts.php
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
    <link rel="stylesheet" href="assets/css/admin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>My Bank</title>
</head>
<body>


<?php include("app/include/header-admin.php"); ?>

<div class="container">
    <?//php include "app/include/sidebar-admin.php";?>
        <div class="posts col-15">
            <div class ="row title-table">
                <h2>Заполнение договора</h2>
            </div>
            <div class="mb-3 col-12 col-md-4 err"> <!--12-->
                <!--Вывод массива с ошибками-->
                <?php include("app/helps/errorinfo.php"); ?>
            </div>
            <div class ="row add-post">
                <form action="create_by_user.php" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col">
                            <input value="<?=$name?>" name="name" type="text" class="form-control" placeholder="Имя" aria-label="First name">
                        </div>
                        <div class="col">
                            <input value="<?=$l_name?>" name="Last_name" type="text" class="form-control" placeholder="Фамилия" aria-label="Last name">
                        </div>
                        <div class="col">
                            <input value="<?=$f_name?>" name="Father_name" type="text" class="form-control" placeholder="Отчество" aria-label="Father name">
                        </div>
                        <h3>Данные паспорта</h3>
                        <div class="col-12">
                            <input value="<?=$seria?>" name="seria" type="text" class="form-control" id="inputSer" placeholder="Серия">
                        </div>
                        <div class="col-12">
                            <input value="<?=$num?>" name="num" type="text" class="form-control" id="inputNum" placeholder="Номер">
                        </div>
                        <div class="col-12">
                            <input value="<?=$r_date?>" name="date" type="text" class="form-control" id="inputDate" placeholder="Дата выдачи">
                        </div>
                        <div class="col-12">
                            <input value="<?=$adres?>"  name="adres" type="text" class="form-control" id="inputAd" placeholder="Адрес регистрации">
                        </div>
                        <h5>Тип счета</h5>
                        <div>
                            <select value="<?=$select?>"  name="select" class="form-select" aria-label="Default select example">
                                <option  selected>Карточный</option>
                                <option  selected>Кредитный</option>
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <div class="col-12">
                            <h5>Загрузите первый разворот паспорта и страницу регистрации в формете PDF</h5>
                            </div>
                            <input value="<?=$img?>"  name="img" type="file" class="form-control" id="inputGroupFile02">
                            <label class="input-group-text" for="inputGroupFile02">Загрузть</label>
                        </div>
                        <div class="col-12">
                            <button name="post-create" type="submit" class="btn btn-primary">Подтвердить</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>





<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>