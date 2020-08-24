<?php
use app\Config;
$title = $article->title;
?>
<div class="home-page">
    <?php include Config::get('DIR') . "\\views\\layout\\navbar.php"; ?>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3>Articles </h3>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <img class="card-img-top" src="https://unsplash.it/500/500" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">
                            <?= $article->title ?>
                        </h5>
                        <p class="card-text">
                            <?= $article->body ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
