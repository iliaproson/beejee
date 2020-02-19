<?php
	session_start();
	include("db_connect.php");
	include("functions.php");
	//Проверка введенных данных
	$error = array();

	$users_name = clear_string($_POST['reg_name']);
	$email = clear_string($_POST['reg_email']);
	$text_zadachi = clear_string( $_POST['text_zadachi']);

	if (strlen($users_name) < 3 or strlen($users_name) > 15) $error[] = "Укажите Имя от 3 до 15 символов!";
	if (!preg_match("/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i",trim($email))) $error[] = "Укажите корректный email!";
	if (!$text_zadachi) $error[] = "Укажите текст задачи!";

	if (count($error))
	{

		echo implode('<br />',$error);
	}
	else
	{
		$query=mysqli_query($link,"INSERT INTO beejee (users_name,email,text_zadachi,status) VALUES (
			'".$users_name."',
			'".$email."',
	        '".$text_zadachi."','выполнено')"); //составляем запрос на запись в базу
		echo '<meta http-equiv="refresh" content="5;URL=index.php"> Работа добавлена в таблицу.';
	}
?>