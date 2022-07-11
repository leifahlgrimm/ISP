<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="/index.php">Inkaru</a>
        <ul class="navbar-nav ml-auto">
            <li>
                <a class="nav-link" href="/index.php">Home</a>
            </li>
            <?php if(isLoggedIn()):?>
            <li>
                <a class="nav-link" href="/index.php/account">Account</a>
            </li>
            <?php endif;?>
            <li class="nav-item">
                <a class="nav-link" href="/index.php/cart">Warenkorb (<?= $countCartItems?>)</a>
            </li>
            <li class="nav-item" id="loginButton">
                <?php if(isLoggedIn()):?>
                <a class="nav-link" href="/index.php/logout">Logout</a>
                <?php endif;?>
                <?php if(!isLoggedIn()):?>
                    <a class="nav-link" href="/index.php/login">Login</a>
                <?php endif;?>
            </li>
        </ul>
    </div>
</nav>