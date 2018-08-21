<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" lang="en">
    <title><?=$title?></title>
    <link rel="stylesheet" href="/style.css">
</head>
<body>
<nav>
    <div class="panel left">
        <a href="/">PictUpload</a>
    </div>
    <div class="panel right">
        <?php if ($loggedIn): ?>
        <a href="">+</a>
        <a href="/logout">LOG OUT</a>
        <?php else: ?>
        <div class="login-container">
            <form action="/login" method="post">
                <input type="text" name="name" placeholder="Username">
                <input type="password" name="password" placeholder="Password">
                <button type="submit">LOGIN</button>
            </form>
        </div>
        <a href="/user/register">SIGN UP</a>
        <?php endif; ?>
    </div>
</nav>
<main>
    <?=$output?>
</main>
<footer>
    <p>&copy; Philip</p>
</footer>
</body>
</html>