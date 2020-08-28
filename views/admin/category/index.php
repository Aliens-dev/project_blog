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
        <?php if(count($categories)):?>
            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Created_at</th>
                    <th>Actions</th>
                </tr>
                <?php foreach ($categories as $category): ?>
                    <tr>
                        <td><?= $category->id ?></td>
                        <td><?= $category->name ?></td>
                        <td><?= $category->created_at ?></td>
                        <td>
                            <a class="btn btn-info my-btn" href="<?= $category->url() ?>">View</a>
                            <a class="btn btn-success my-btn" href="<?= $category->url('/admin') ?>">Edit</a>
                            <form class="d-inline" action="<?= $category->url('/admin') ?>" method="POST">
                                <input type="hidden" name="_method" value="DELETE">
                                <button class="btn btn-danger my-btn">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <div>
                No Categories found, add new one.
            </div>
        <?php endif; ?>
        <div class="row mt-2">
            <div class="col d-flex justify-content-end">
                <button class="btn btn-primary" id="add-category">
                    <i class="fa fa-plus"></i>
                </button>
            </div>
        </div>
        <div id="addForm" class="hide">
            <div class="row mt-2">
                <form class="col-12" method="POST" action="/admin/categories">
                    <div class="form-group">
                        <label for="title">Name</label>
                        <input class="form-control" name="name">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary">Add Category</button>
                        <button role="button" class="btn btn-danger" id="cancel-add">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    let addForm = document.querySelector('#addForm');
    let addCategory = document.querySelector('#add-category');
    let cancel = document.querySelector('#cancel-add');

    const toggleHidden = (event) => {
        event.preventDefault();
        addForm.classList.toggle('hide');
    }
    addCategory.addEventListener('click', toggleHidden);
    cancel.addEventListener('click', toggleHidden);

</script>
