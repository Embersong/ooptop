<?php if ($user): ?>
    Привет <?= $user ?>, <a href="/?c=auth&a=logout">Выход</a>
<?php else: ?>
    <form action="/?c=auth&a=login" method="post">
        <input type="text" name="login">
        <input type="password" name="pass">
        <input type="submit" value="Войти">
    </form>
<?php endif; ?>
<br>
<a href="/">Главная</a>
<a href="/?c=posts">Посты</a>

