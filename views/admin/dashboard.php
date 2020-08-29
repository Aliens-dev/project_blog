<?php
use app\Config;
$title = "Admin Page";
?>
<div class="admin-page">
    <?php include Config::get('DIR') . "\\views\\layout\\navbar.php"; ?>
    <div class="container">
        <div class="v-card-container">
            <a href="/admin/users" class="v-card">
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
                <div class="v-card-body">
                    <span>Users</span>
                    <span><?= $users->count ?></span>
                </div>
            </a>
            <a href="/admin/articles" class="v-card">
                <div class="icon">
                    <i class="fab fa-blogger"></i>
                </div>
                <div class="v-card-body">
                    <span>Articles</span>
                    <span><?= $articles->count ?></span>
                </div>
            </a>
            <a class="v-card">
                <div class="icon">
                    <i class="fab fa-accusoft"></i>
                </div>
                <div class="v-card-body">
                    <span>Categories</span>
                    <span><?= $categories->count ?></span>
                </div>
            </a>
        </div>
    </div>
</div>

