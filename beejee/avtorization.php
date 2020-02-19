<?php
session_start();
include("db_connect.php");
include("functions.php");


If ($_POST["submit_enter"]) {
    $login = clear_string($_POST["input_login"]);
    $password = clear_string($_POST["input_pass"]);

    if ($login && $password) {


        $result = mysqli_query($link, "SELECT * FROM admin WHERE login = '$login' AND password = '$password'");

        If (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);


            $_SESSION['auth_admin'] = 'yes_auth';

            $_SESSION['auth_admin_login'] = $row["login"];

            $_SESSION['edit_zadacha'] = $row['edit_zadacha'];

            header("Location: admin.php");
        } else {
            $msgerror = "Неверный Логин и(или) Пароль.";
        }
    } else {
        $msgerror = "Заполните все поля!";
    }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
   <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="css/style.css">

    <title>Авторизация</title>
</head>
<body>

<div id="block-pass-login">
    <?php

    if ($msgerror) {
        echo '<p id="msgerror" >' . $msgerror . '</p>';

    }

    ?>

    <form method="post">
        <ul id="pass-login">
            <li><label>Логин</label><input type="text" name="input_login"/></li>
            <li><label>Пароль</label><input type="password" name="input_pass"/></li>
        </ul>
        <p align="right"><input type="submit" name="submit_enter" id="submit_enter" value="Вход"/></p>
    </form>

</div>
</body>
</html>