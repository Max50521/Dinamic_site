<?php
include "../../path.php";
require "../../app/controllers/users.php";

if(!isset($_POST['is_admin']) || !$_POST['is_admin']){
    die();
}
$users = selectAll('users');

foreach ($users as $key => $user){
    ?>
    <div class="row post">
        <div class="col-1"><?=$user['id'];?></div>
        <div class="col-2"><?=$user['username'];?></div>
        <div class="col-3"><?=$user['email'];?></div>
        <?php 
        if ($user['admin'] == 1){
            echo "<div class='col-2'>Admin</div>";
        }else{
            echo "<div class='col-2'>User</div>";
        } 
        ?>
        <div class="del col-4"><a href="index.php?delete_id=<?=$user['id'];?>">delete</a></div>
    </div>
    <?php
}
?>