<?php //session_start();
include "../../path.php";
include "../../app/controllers/users.php"
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
          integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- Custom Styling -->
    <link rel="stylesheet" href="../../assets/css/admin.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="../../assets/js/jquery-3.6.3.js"></script>
    <script src="../../assets/js/jquery.simulate.js"></script>
    <title>My blog</title>
</head>
<body>

<?php include("../../app/include/header-admin.php"); ?>

<div class="container">

    <?php include "../../app/include/sidebar-admin.php"; ?>

    <div class="posts col-9">
        <div class="button row">
            <a href="<?php echo BASE_URL . "admin/users/create.php";?>" class="col-2 btn btn-success">Создать</a>
        </div>
        <div class="row title-table">
            <h2>Пользователи</h2>
            <div class="col-1">ID</div>
            <div class="col-2">Логин</div>
            <div class="col-3">Email</div>
            <div class="col-2">Роль</div>
            <div class="col-4">Управление</div>
        </div>
        <div id="data_res">
            <div id="preload"><img style="display: block; margin-left: auto; margin-right: auto;" src="../../assets/gif/1494.gif" alt=""/></div>
        </div>
    </div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

<script type="text/javascript">
$(document).ready(function(){
    // alert("YES1");
    $.ajax({
        url: "get_all_users.php",
        method: "POST",
        data: {is_admin: true},
        success: function(data){
            $("#preload").remove();
            $("#data_res").html(data);
        }
    });
});
</script>

</body>
</html>

