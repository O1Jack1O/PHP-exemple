<!DOCTYPE html>
<html>
<head>
    <meta  charset="UTF-8">
    <link href="tableStyle.css" rel="stylesheet" type="text/css">
</head>
<body >
<?php require ('connection.php');
$data = mysqli_query($link, "SELECT * FROM users ;")->fetch_all();
?>

<?php if(isset($_SESSION['Logged_user'])): ?><h2>
    Здравствуйте <?php  echo $_SESSION['Logged_user']['username'],'!    <a href="/logout.php">Выйти</a></h2>';?>
<hr>

<?php
echo '<table class="table1">';
echo '<tr>';
echo '<th>№</th><th>id</th><th>Username</th><th>Password</th><th>PhoneNumber</th>';
echo '</tr>';
$i=1;
foreach($data as $base_key => $base_value){
    echo '<tr>';
    echo '<td>', $i++, '</td>';
    foreach($base_value as $key => $value ){
        echo '<td>', $value, '</td>';
    }
    echo '</tr>';
}
echo '</table>';
echo '<br />';
?>

<?php else :?>
<a href="singup.php">Регистрация</a><br>
<a href="login.php">Авторизация</a>
<?php endif;?>
</body>
</html>
