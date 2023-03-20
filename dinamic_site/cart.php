<?php  //session_start();
include "path.php";
//include "app/controllers/userDoc.php";
include "app/controllers/posts.php";
include  "app/controllers/cart.php";
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
    <link rel="stylesheet" href="assets/css/userDoc.css">
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>My Bank</title>
</head>
<body>


<?php include("app/include/header-admin.php"); ?>

<div class="container">
    <div class="posts col-9">
        <div class ="row title-table">
            <h2>Банковская карта</h2>
            <div class="col-1">Номер счета</div>
            <div class="col-3">Номер карты</div>
            <div class="col-8">Информация</div>

        </div>

        <?php foreach ($posts as $key => $post): ?><?php /*foreach ($postsAdm as $key => $post): */?>
            <?php if ($post['id_user'] ===  $_SESSION['id'] ): ?>
                <div class ="row post">
                    <!--<div class="id col-1"><?php /*=DocGet('posts', $_SESSION['id']);*/?></div>-->
                    <div class="id col-1"><?=$post['id'];?></div> <!--1 4 2 2 2 -->

                    <div class="author col-3"><?=$post['cart_num'];?></div>
                    <!--<div class="red col-2"><a href="cart.php">Карточка</a></div>-->


                    <?php if ($post['status']==1): ?>
                        <div class="status col-8">Карта еще не готова</div>
                    <?php elseif ($post['status']==2): ?>
                            <div class="col-8">
                        <form action="cart_done.php" method="post" enctype="multipart/form-data">
                                <button name="get_cart" type="submit" class="btn btn-primary">Карта готова
                        </form>
                            </div>
                    <?php else: ?>
                        <div class="status col-8">Договор отклонен</div>
                    <?php endif; ?>
                </div>

                <?php /*else: */?><!--
                <div class="status col-2">Нет открытых счетов</div>-->
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>
</div>





<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>