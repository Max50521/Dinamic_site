<?php
include "../../path.php";
require_once "../../app/controllers/posts.php";

// $posts = selectAll('posts');
$postsAdm = selectAllFromPostWithUsers('posts', 'users');

if(!isset($_POST['is_admin']) || !$_POST['is_admin']){
    die();
}

foreach ($postsAdm as $key => $post){ ?>
                <div class ="row post">
                    <div class="id col-1"><?=$post['id'];?></div>
                    <div class="title col-3"><?=$post['type'];?></div>
                    <div class="author col-2"><?=$post['username'];?></div>
                    <div class="red col-2"><a href="edit.php?id=<?=$post['id'];?>">edit</a></div>
                    <div class="del col-2"><a href="edit.php?delete_id=<?=$post['id'];?>">delete</a></div>
                    <?php if ($post['status']==1): ?>
                        <div class="status col-2">Принят на проверку</div>
                    <?php elseif ($post['status']==2): ?>
                        <div class="status col-2">Одобрен</div>
                    <?php elseif ($post['status']==3): ?>
                        <div class="status col-2">Отклонён</div>
                    <?php elseif ($post['status']==4): ?>
                        <div class="status col-2">Уже рассматривается</div>
                    <?php endif; ?>
    </div>
<?php } ?>