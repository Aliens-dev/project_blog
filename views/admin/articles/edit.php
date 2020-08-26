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
                    <a href="/admin/articles" class="my-breadcrumb-item">
                        <div class="my-breadcrumb-text">
                            Articles
                            <i class="fa fa-angle-right"></i>
                        </div>
                    </a>
                    <a href="" class="my-breadcrumb-item">
                        <div class="my-breadcrumb-text active">
                            <?= $article->title ?>
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
        <div class="row mt-2">
            <form class="col-12" method="POST" action="/admin/articles/<?= $article->id ?>" enctype="multipart/form-data">

                <input name="_method" type="hidden" value="PATCH">
                <div class="form-group">
                     <label for="title">Title</label>
                    <input class="form-control" name="title" value="<?= $article->title ?>">
                </div>
                <div class="form-group">
                    <label for="title">Title</label>
                    <textarea class="textarea" rows="20" class="form-control" name="body"><?= $article->body ?></textarea>
                </div>
                <div class="form-group">
                    <label for="title">Excerpt</label>
                    <textarea rows="5" class="form-control" name="excerpt"><?= $article->excerpt ?></textarea>
                </div>
                <div class="form-group">
                    <img src="<?= $article->image ?>" alt="<?= $article->title ?>" width="50" height="50"><br>
                    <label for="title">Upload</label>
                    <input type="file" rows="10" name="image" >
                </div>
                <div class="form-group">
                    <button class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    tinymce.init({
        selector: '.textarea',
        plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
        toolbar_mode: 'floating',
    });
</script>

