<?php
require ('connection.php');
unset($_SESSION['Logged_user']);

header('Location: /index.php');
