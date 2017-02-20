<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <a class="navbar-brand" href="/">Main page</a>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="/tasks/add_task">New task</a></li>
            <?php if ( isset($_SESSION['admin'])): ?>
                <li><a href="#" style="color:green">Admin</a></li>
                <li><a href="/user/logout" style="color:red">Logout</a></li>
            <?php else: ?>
                <li><a href="/user/login">Login</a></li>
            <?php endif ?>
        </ul>
    </div>

</nav>
