<?php
use app\Config;
$title = "Admin Page";
?>
<div class="admin-page">
    <?php include Config::get('DIR') . "\\views\\layout\\navbar.php"; ?>
    <div class="container">
        <div class="row mt-2">
            <div class="col d-flex justify-content-end">
                <button class="btn btn-primary">Add Article</button>
            </div>
        </div>
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
                    <td><?= $article->body ?></td>
                    <td><?= $article->created_at ?></td>
                    <td>
                        <button class="btn btn-success">Edit</button>
                        <button class="btn btn-danger">Delete</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>

