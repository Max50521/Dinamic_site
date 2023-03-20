<?php
include "../../path.php";
// require_once "../../app/controllers/posts.php";
require_once "../../app/database/db.php";

// $posts = selectAll('posts');
$hists = selectAll('history');
$hists = array_reverse($hists);
if(!isset($_POST['is_admin']) || !$_POST['is_admin']){
    die();
}

foreach ($hists as $key => $hist){ 
    ?>
        <div class ="row post">
        <div class="id col-1"><?=$key + 1;?></div>
        <div class="col-8"><?=$hist["_text"];?></div>
        </div>
<?php } ?>