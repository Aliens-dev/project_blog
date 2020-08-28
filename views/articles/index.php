<?php
    use app\Config;
    $title = "Articles";
?>
<div class="home-page">
    <?php include Config::get('DIR') . "\\views\\layout\\navbar.php"; ?>
    <div class="header">
        <div id="carouselExampleInterval" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active" data-interval="10000">
                    <img src="/assets/img/img-1.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item" data-interval="2000">
                    <img src="/assets/img/img-2.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="/assets/img/img-3.jpg" class="d-block w-100" alt="...">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleInterval" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleInterval" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
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
                        <h3>Articles </h3>
                    </div>
                </div>
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
                                            <a class="badge" href="<?= $cat->url() ?>"><?= $cat->name ?></a>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

    </div>
</div>
