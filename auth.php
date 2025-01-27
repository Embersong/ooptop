<?php
session_start();
$user = false;

if (isset($_SESSION['login'])) {
    $user = $_SESSION['login'];
}

if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: /');
    exit();
}

if (isset($_GET['login'])) {
    $login = $_POST['login'];
    $pass = $_POST['pass'];
    if ($login == 'admin' && $pass == 'admin') {
        $_SESSION['login'] = 'admin';
        header('Location: /');
        exit();
    }

}

?>

<?php if ($user): ?>
    Привет <?= $user ?>, <a href="/?logout">Выход</a>
<?php else: ?>
    <form action="/?login" method="post">
        <input type="text" name="login">
        <input type="password" name="pass">
        <input type="submit" value="Войти">
    </form>
<?php endif; ?>