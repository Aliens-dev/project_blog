<?php
    use app\Config;
    $title = "Login Page";
?>
<div class="login-page">
    <?php include Config::get('DIR') . "\\views\\layout\\navbar.php"; ?>
    <div class="container">
        <form class="login-form" action="/login" method="POST">
            <div class="header">
                <div class="title">Login Page</div>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" name="email" class="form-control" placeholder="Type your email" />
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" name="password" type="password" class="form-control" placeholder="Type your username" />
            </div>
            <button class="btn btn-primary">Login</button>
            <?php if(session()->hasFlashMessages()): ?>
                <?php foreach (session()->getFlashMessages() as $message): ?>
                    <div class="alert alert-danger mt-1">
                        <?= $message ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </form>
    </div>
</div>
