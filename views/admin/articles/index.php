<?php
use app\Config;
$title = "Admin Page";

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
                            Articles
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
        <?php if(count($articles)):?>
            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Excerpt</th>
                    <th>Created_at</th>
                    <th>Actions</th>
                </tr>
                <?php foreach ($articles as $article): ?>
                    <tr>
                        <td><?= $article->id ?></td>
                        <td><?= $article->title ?></td>
                        <td><?= $article->excerpt(10) ?></td>
                        <td><?= $article->created_at ?></td>
                        <td>
                            <a class="btn btn-info my-btn" href="<?= $article->url() ?>">View</a>
                            <a class="btn btn-success my-btn" href="<?= $article->url('/admin') ?>">Edit</a>
                            <form class="d-inline" action="<?= $article->url('/admin') ?>" method="POST">
                                <input type="hidden" name="_method" value="DELETE">
                                <button class="btn btn-danger my-btn">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <div>
                No Articles found, add new one.
            </div>
        <?php endif; ?>
        <div class="row mt-2">
            <div class="col d-flex justify-content-end">
                <button class="btn btn-primary" id="add-article">
                    <i class="fa fa-plus"></i>
                </button>
            </div>
        </div>
        <div id="addForm" class="hide">
            <div class="row mt-2">
                <form class="col-12" method="POST" action="/admin/articles" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input class="form-control" name="title">
                    </div>
                    <div class="form-group">
                        <label for="body">Body</label>
                        <textarea class="textarea" rows="20" class="form-control" name="body"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="excerpt">Excerpt</label>
                        <textarea rows="5" class="form-control" name="excerpt"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="title">Upload</label>
                        <input type="file" rows="10" name="image" >
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary">Add Article</button>
                        <button role="button" class="btn btn-danger" id="cancel-add">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    let addForm = document.querySelector('#addForm');
    let addArticle = document.querySelector('#add-article');
    let cancel = document.querySelector('#cancel-add');

    const toggleHidden = (event) => {
        event.preventDefault();
        addForm.classList.toggle('hide');
    }
    addArticle.addEventListener('click', toggleHidden);
    cancel.addEventListener('click', toggleHidden);

    tinymce.init({
        selector: '.textarea',
        plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
        toolbar_mode: 'floating',
    });
</script>
