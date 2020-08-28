<?php
use app\Config;
$title = $article->title;
?>
<div class="home-page">
    <?php include Config::get('DIR') . "\\views\\layout\\navbar.php"; ?>
    <div class="container">
        <div class="row mt-5">
            <div class="col-3">
                <div class="mt-5">
                    <div>
                        <h5>Lastest posts </h5>
                    </div>
                    <div class="row">
                        <?php foreach ($latest as $post): ?>
                            <div class="col-12 mb-2">
                                <a href="<?= $post->url() ?>">
                                    <?= $post->title ?>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="mt-5">
                    <div>
                        <h5>Categories </h5>
                    </div>
                    <div class="row">
                        <?php foreach ($categories as $category): ?>
                            <div class="col-12 mb-2">
                                <a href="<?= $category->url() ?>">
                                    <?= $category->name ?>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="col-9">
                <div class="row mt-5">
                    <div class="col-12 d-flex mb-2 justify-content-center">
                        <h1><?= $article->title ?></h1>
                    </div>
                </div>
                <div class="article">
                    <div class="author">
                        Article by <?= $user->name ?>
                    </div>
                    <img class="article-img" src="<?= $article->image ?>" alt="Card image cap">
                    <div class="article-body">
                        <p class="card-text">
                            <?= $article->body ?>
                        </p>
                    </div>
                </div>
                <div class="foot">
                    <?php foreach ($article->categories() as $cat): ?>
                        <a href="<?= $cat->url() ?>" class="badge"><?= $cat->name ?></a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
