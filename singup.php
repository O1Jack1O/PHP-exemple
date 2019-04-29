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
/*$test = mysqli_query($link, "SELECT * FROM users WHERE username='$data[username]';")->num_rows;
//var_dump($test);
echo ('<p>'.$test.'</p>');*/
if(isset($_POST['submited'])){
    $errors = array();
    if (trim($data['username']) == '' ){
        $errors[] = 'Введите логин';
    }
    if (trim($data['phoneNumber']) == '' ){
        $errors[] = 'Введите ваш телефон';
    }
    if ($data['password'] == '' ){
        $errors[] = 'Введите пароль!';
    }
    if ($data['password2'] != $data['password'] ){
        $errors[] = 'Повторный пороль введен не верно!';
    }
    if ((mysqli_query($link, "SELECT * FROM users WHERE username='$data[username]';")->num_rows)>0){
        $errors[] = 'Такой пользователь уже зарегистрирован в системе';
    }
    if ((mysqli_query($link, "SELECT * FROM users WHERE phoneNumber='$data[phoneNumber]';")->num_rows)>0){
        $errors[] = 'Пользователь с таким телефоном уже зарегистрирован в системе';
    }

    if(empty($errors)){
        $password = password_hash($data[password], PASSWORD_DEFAULT);
        $query ="INSERT INTO users ( username, password, phoneNumber) 
                 VALUES ('$data[username]', '$password','$data[phoneNumber]')";
        $result = mysqli_query($link, $query);
        if($result){
            $succesfulMessage = "Регистрация прошла успешно!";

        } else {
            $falseMessege = "Ошибка";
        }

    }
    else{
        echo '<div style="color: red;">'.array_shift($errors).' </div><hr>';
    }
}
?>
<div class="blockReg">
    <form method="post">
        <h3>Регистрация</h3>
        <?php if(isset($succesfulMessage)){?> <div style="color: #10ffb2;"><?php echo $succesfulMessage; header('Location: http://localhost/login.php');    ?> </div> <?php } ?>
        <?php if(isset($falseMessege)){?> <div style="color: red;"><?php echo $falseMessege; ?> </div> <?php } ?>
        <input
                type="text"
                name="username"
                placeholder="Username"
                value="<?PHP echo @$data['username']?>"
                class="formText" ><br>
        <input
                type="tel"
                name="phoneNumber" placeholder="Your phone number!"
                class="formText" ><br>
        <input
                type="password"
                name="password"
                placeholder="Enter password"
                class="formText" ><br>
        <input
                type="password"
                name="password2"
                placeholder="Enter the password again"
                class="formText" ><br>
        <button
                type="submit"
                name="submited"
                class="button">Register</button>
    </form>
</div>
</body>
</html>
