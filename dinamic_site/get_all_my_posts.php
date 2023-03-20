<?php 
include "path.php";
require_once "app/controllers/posts.php";

foreach ($posts as $key => $post): 
            if ($post['id_user'] ===  $_SESSION['id'] ): ?>
                <div class ="row post">
                    <!--<div class="id col-1"><?php /*=DocGet('posts', $_SESSION['id']);*/?></div>-->
                    <div class="id col-1"><?=$post['id'];?></div> <!--1 4 2 2 2 -->
                    <div class="title col-3"><?=$post['type'];?></div>
                    <!--<div class="author col-2"><?php /*=$post['username'];*/?></div> -->
                    <div class="red col-2"><a href="cart.php">Карточка</a></div>


                    <?php if ($post['status']==1): ?>
                        <div class="status col-6">Принят на проверку</div>
                    <?php elseif ($post['status']==2): ?>
                        <div class="status col-6">Одобрен</div>
                    <?php else: ?>
                        <div class="status col-6">Отклонён</div>
                    <?php endif; ?>
                </div>

            <?php /*else: */?><!--
                <div class="status col-2">Нет открытых счетов</div>-->
            <?php endif; ?>
        <?php endforeach; ?>