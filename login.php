<!DOCTYPE html>
<html>
<head>
    <meta  charset="UTF-8">
    <!--<style type="text/css">
        .blockReg {
            position: relative;
            max-width: 400px;
            padding: 15px;
            margin: 0 auto;
            background: #ddd;
            /*position: absolute;
            top: 40%;
            left: 50%;
            margin-right: -50%;
            transform: translate(-50%, -50%);
            width: 300px;
            background: #ddd;
            padding: 1px;
            padding-right: 20px;
            float: left;*/

        }
        .messAlert {
            color: greenyellow;


            padding: 5px;

            float: left;
            padding: 15px;
            margin: 0 auto;
            position: relative;
            top: 0px;
            left: 10%;
        }
        .falseMessAlert {
            color: red;
            padding: 15px;
            margin: 0 auto;
            position: relative;
            top: 0px;
            left: 30%;
        }
        .formText {


            padding: auto;
            margin: 0 auto;

            horiz-align: center;

        }
        .button {
            width:auto;
            position: relative;
            left: 25%;
        }
    </style>-->

</head>
<body>

<?php
require ('connection.php');
$data = $_POST;
//$test = mysqli_query($link, "SELECT * FROM users WHERE username='$data[username]';")->fetch_array();
//var_dump($test);
//$verifyPass = password_verify( $data['password'], $test);
//var_dump($test);
//echo ('<p>'.$test.'</p><br>');
//echo ('<p>'.$verifyPass.'</p>');
if(isset($data['submited'])){
    $errors = array();
    $passFromDB = mysqli_query($link, "SELECT password FROM users WHERE username='$data[username]';")->fetch_array()[password];
    $currentUser = mysqli_query($link, "SELECT * FROM users WHERE username='$data[username]';")->fetch_array();
    if (trim($_POST['username']) == '' ){
        $errors[] = 'Введите логин';
    }else{
        if(mysqli_query($link, "SELECT * FROM users WHERE username='$data[username]';")->num_rows==0){
            $errors[] = 'Пользователь с таким имененем не зарегестрирован!';
        }
    }
    if ($_POST['password'] == '' ){
        $errors[] = 'Введите пароль!';
    }

    if(empty($errors)){
        if(password_verify( $data['password'], $passFromDB)){
            echo ('<div style="color: #42ff9c;">Авторизация пройдена успешно!</div><hr>');
           $_SESSION['Logged_user']=$currentUser;
           header('Location: /index.php');

        }else{
            echo ('<div style="color: red;">Пароль введен неверно! </div><hr>');
        }
    }
    else{
        echo '<div style="color: red;">'.array_shift($errors).' </div><hr>';
    }
}
?>
<div class="blockReg">
    <form method="post">
        <h3>Авторизация</h3>
        <input
            type="text"
            name="username"
            placeholder="Username"
            value="<?PHP echo @$data['username']?>"
            class="formText" ><br>

        <input
            type="password"
            name="password"
            placeholder="Enter password"
            value="<?PHP echo @$data['password']?>"
            class="formText" ><br>

        <button
            type="submit"
            name="submited"
            class="button">Login</button>
    </form>
</div>
</body>
</html>
