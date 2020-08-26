<?php
use app\Config;
$title = "Admin Page";
?>
<div class="admin-page">
    <?php include Config::get('DIR') . "\\views\\layout\\navbar.php"; ?>
    <div class="container">
        <div class="row mt-2">
            <div class="col d-flex">
                <div class="my-breadcrumb">
                    <a href="/admin/" class="my-breadcrumb-item">
                        <div class="my-breadcrumb-text">
                            Dashboard
                            <i class="fa fa-angle-right"></i>
                        </div>
                    </a>
                    <a href="/admin/users" class="my-breadcrumb-item">
                        <div class="my-breadcrumb-text">
                            Users
                            <i class="fa fa-angle-right"></i>
                        </div>
                    </a>
                    <a href="" class="my-breadcrumb-item">
                        <div class="my-breadcrumb-text active">
                            <?= $user->name ?>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="row mt-2" style="width: 500px;margin:0 auto;">
            <form class="col-12" method="POST" action="<?= $user->url('/admin') ?>">
                <input name="_method" type="hidden" value="PATCH">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input id="name" class="form-control" placeholder="Your name" name="name" value="<?= $user->name ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" rows="10" class="form-control" type="email" name="email" value="<?= $user->email ?>">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" rows="10" class="form-control" type="password" name="password">
                </div>
                <div class="form-group">
                    <button class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

