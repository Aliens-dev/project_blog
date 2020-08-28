<?php
use app\Config;
$title = "Articles";
?>
<div class="home-page">
    <?php include Config::get('DIR') . "\\views\\layout\\navbar.php"; ?>
    <div class="container">
        <div class="row">
            <div class="col-3 side">
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
                <div class="row mt-3">
                    <div class="col-12">
                        <h3><?= $cat->name ?></h3>
                    </div>
                </div>
                <?php if(count($articles)) : ?>
                    <?php foreach ($articles as $article): ?>
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="my-card">
                                    <div class="my-card-image">
                                        <img src="<?= $article->image ?>">
                                    </div>
                                    <div class="my-card-body">
                                        <h2 class="my-card-title">
                                            <a href="<?= $article->url() ?>">
                                                <?= $article->title ?>
                                            </a>
                                        </h2>
                                        <div class="author">
                                            by <span class="badge"><?= \app\DB\Models\User::find([$article->user_id])->name ?></span>
                                        </div>
                                        <p class="my-card-text">
                                            <?= $article->excerpt ?>
                                        </p>
                                        <a href="<?= $article->url() ?>" >
                                            See More
                                        </a>
                                        <div class="foot">
                                            <?php foreach ($article->categories() as $cat): ?>
                                                <a href="<?= $cat->url() ?>" class="badge"><?= $cat->name ?></a>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div> Not articles in this category...</div>
                <?php endif; ?>
            </div>
        </div>

    </div>
</div>
