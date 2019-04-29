<!DOCTYPE html>
<html>
<head>
    <meta  charset="UTF-8">

</head>
<body >
<?php require ('connection.php'); ?>
<?php if(isset($_SESSION['Logged_user'])): ?>
Вы авторизованы как <?php  echo($_SESSION['Logged_user']['username']);?>
<hr>
<a href="/logout.php">Выйти</a>
<?php else :?>
<a href="singup.php">Регистрация</a><br>
<a href="login.php">Авторизация</a>
<?php endif;?>
</body>
</html>
