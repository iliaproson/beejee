<?php
	session_start();
	unset($_SESSION['password']);
	unset($_SESSION['login']);
	unset($_SESSION['id']);//    уничтожаем переменные в сессиях
	header("Location: index.php");
?>