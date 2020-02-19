<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/style.css">

  <title>Список задач</title>
</head>
<body>
  	<div class = "container">
	    <div class = "row">
		    <div class = "col-md-12">
				<div id="spisok">Список задач</div>
				<table  cellpadding="6" cellspacing="2" >
					<tr align="center" >
	                    <th>Имя пользоателя</th>
	                    <th>E-mail</th>
	                    <th>Текст задачи</th>
	                    <th>Статус</th>
	                    <th>Ссылка</th>
                	</tr>
		            <?php
		              include("db_connect.php");//Подключение к бд

		              $result=mysqli_query($link,"SELECT * FROM `beejee`");// запрос на выборку

		                while($row=mysqli_fetch_array($result)) // берем результаты из каждой строки
		                {
		                  echo '
		                    <tr align="left">
			                    <td> '.$row['users_name'].'
			                    <td> '.$row['email'].'
			                    <td> '.$row['text_zadachi'].'
			                    <td>'.$row['status'].'
			                    <td> <a class="green" href="edit_zadacha.php?id=' . $row["id"] . '">Редактировать</a>
		                    </tr>
		                  ';
		                }
		            ?>
          		</table>
          		<input type="submit" value="Создать новую задачу" name="submit" id="submit" onclick="location.href='new_zadacha.php'" >
          		<input type="submit" value="Выход" name="submit" id="submit" onclick="location.href='exit.php'">
		    </div>
	    </div>
	</div>

	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>