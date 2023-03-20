<?php  //session_start();
include "path.php";
//include "app/controllers/userDoc.php";
include "app/controllers/posts.php";
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
    <script src="./assets/js/jquery-3.6.3.js"></script>
    <script src="./assets/js/jquery.simulate.js"></script>
    <title>My Bank</title>
</head>
<body>


<?php include("app/include/header-admin.php"); ?>

<div class="container">
    <div class="posts col-9">
        <div class ="row title-table">
            <h2>Мои счета</h2>
            <div class="col-1">Номер</div>
            <div class="col-3">Тип</div>
            <div class="col-2">Данные</div>
            <div class="col-6">Статус</div>
        </div>

        <div id="data_res">
            <div id="preload"><img style="display: block; margin-left: auto; margin-right: auto;" src="./assets/gif/1494.gif" alt=""/></div>
        </div>
    </div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

<script type="text/javascript">
$(document).ready(function(){
    $.ajax({
        url: "get_all_my_posts.php",
        method: "POST",
        data: {id_user: <?php echo $_SESSION['id']; ?>},
        success: function(data){
            $("#preload").remove();
            $("#data_res").html(data);
        }
    });
});
</script>

</body>
</html>