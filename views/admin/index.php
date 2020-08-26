<?php
use app\Config;
$title = "Admin Page";
?>
<div class="admin-page">
    <?php include Config::get('DIR') . "\\views\\layout\\navbar.php"; ?>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="my-breadcrumb">
                    <a href="/admin/" class="my-breadcrumb-item">
                        <div class="my-breadcrumb-text">
                            Dashboard
                            <i class="fa fa-angle-right"></i>
                        </div>
                    </a>
                    <a href="/admin/articles" class="my-breadcrumb-item">
                        <div class="my-breadcrumb-text active">
                            Users
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
        <table class="table">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= $user->id ?></td>
                    <td><?= $user->name ?></td>
                    <td><?= $user->email ?></td>
                    <td>
                        <a href="<?= $user->url('/admin') ?>" class="btn btn-success my-btn">Edit</a>
                        <form class="d-inline" method="POST" action="<?= $user->url('/admin') ?>">
                            <input type="hidden" name="_method" value="DELETE">
                            <button class="btn btn-danger my-btn">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <div class="row">
            <div class="col d-flex justify-content-end">
                <button class="btn btn-primary" id="add-user">Add User</button>
            </div>
        </div>
        <div id="Form" class="hide mt-5" style="width:500px; margin:0 auto;">
            <div>
                <h3>Add New User</h3>
            </div>
            <div class="row mt-2">
                <form class="col-12" method="POST" action="/admin/users">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input id="name" class="form-control" name="name">
                    </div>
                    <div class="form-group">
                        <label for="title">Email</label>
                        <input rows="10" type="email" class="form-control" name="email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" rows="10" name="password" >
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary">Add User</button>
                        <button role="button" class="btn btn-danger" id="cancel-add">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    let Form = document.querySelector('#Form');
    let addUser = document.querySelector('#add-user');
    let cancel = document.querySelector('#cancel-add');

    const toggleHidden = (event) => {
        event.preventDefault();
        Form.classList.toggle('hide');
    }
    addUser.addEventListener('click', toggleHidden);
    cancel.addEventListener('click', toggleHidden);

</script>