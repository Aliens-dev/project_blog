<?php
use app\Config;
$title = "Categories";

?>
<div class="admin-page" id="app">
    <?php include Config::get('DIR') . "\\views\\layout\\navbar.php"; ?>
    <div class="container">
        <div class="row">
            <div class="col d-flex">
                <div class="my-breadcrumb">
                    <a href="/admin/" class="my-breadcrumb-item">
                        <div class="my-breadcrumb-text">
                            Dashboard
                            <i class="fa fa-angle-right"></i>
                        </div>
                    </a>
                    <a href="/admin/articles" class="my-breadcrumb-item">
                        <div class="my-breadcrumb-text active">
                            Categories
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <?php if(session()->hasFlashMessages()): ?>
            <?php foreach (session()->getFlashMessages() as $message): ?>
                <div class="row">
                    <div class="col">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= $message ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
        <div id="addForm">
            <div class="row mt-2">
                <form class="col-12" method="POST" action="<?= "/admin/categories/". $category->id ?>">
                    <input type="hidden" name="_method" value="PATCH">
                    <div class="form-group">
                        <label for="title">Name</label>
                        <input class="form-control" value="<?= $category->name ?>" name="name">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary">Edit Category</button>
                        <button role="button" class="btn btn-danger" id="cancel-add">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
