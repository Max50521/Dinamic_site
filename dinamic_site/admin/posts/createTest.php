<?php  session_start();
include "../../path.php";
?>
<!doctype html>
<html lang="en">
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
    <?php include "../../app/include/sidebar-admin.php";?>
        <div class="posts col-9">
            <div class ="row title-table">
                <h2>Заполнение договора</h2>
            </div>
            <div class ="row add-post">
                <form action="createTest.php" method="post">
                    <div class="row">
                        <div class="col">
                            <input type="text" class="form-control" placeholder="Имя" aria-label="First name">
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" placeholder="Фамилия" aria-label="Last name">
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" placeholder="Отчество" aria-label="Father name">
                        </div>
                        <h3>Данные паспорта</h3>
                        <div class="col-12">
                            <input type="text" class="form-control" id="inputSer" placeholder="Серия">
                        </div>
                        <div class="col-12">
                            <input type="text" class="form-control" id="inputNum" placeholder="Номер">
                        </div>
                        <div class="col-12">
                            <input type="text" class="form-control" id="inputDate" placeholder="Дата выдачи">
                        </div>
                        <div class="col-12">
                            <input type="text" class="form-control" id="inputAd" placeholder="Адрес регистрации">
                        </div>
                        <div class="input-group mb-3">
                            <h5>Загрузите первый разворот паспорта и страницу регистрации в формете PDF</h5>
                            <input type="file" class="form-control" id="inputGroupFile02">
                            <label class="input-group-text" for="inputGroupFile02">Upload</label>
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