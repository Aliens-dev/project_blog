<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">AliensDev</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                </li>
                <?php if(session()->hasAuthSession()): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/users">Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/articles">Articles</a>
                    </li>
                <?php endif; ?>

            </ul>
            <ul class="navbar-nav ml-auto">
                <?php if(session()->hasAuthSession()): ?>
                    <form class="nav-item" method="POST" action="/admin/logout">
                        <input type="submit" class="nav-link" value="Logout">
                    </form>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/login">Login</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>