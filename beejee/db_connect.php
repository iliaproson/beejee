<?php
	//данные подключ к сер бд
	$hostname = "localhost";
	$user     = "admin";
	$pass     = "root";
	//ввод наз бд
	$db       = "beejee";
	//попытка потключ
	$link = mysqli_connect($hostname, $user, $pass, $db);
	mysqli_query($link, 'set names UTF-8');
?>