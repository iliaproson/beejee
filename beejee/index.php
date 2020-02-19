<?php

	$sorting = $_GET["sort"];

    switch ($sorting)

    {

    	case 'users_name';

    	$sorting = 'users_name';

    	$sort_name = 'По имени пользователя';

    	break;

	    case 'email';

	    $sorting = 'email';

	    $sort_name = 'По email';

	    break;

	    case 'status';

	    $sorting = 'status';

	    $sort_name = 'По статусу задачи';

	    break;

	    default:

	    $sorting = 'id DESC';

	    $sort_name = 'Нет сортировки';

	    break;
    }
?>
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
				<ul id="options-list">
					<li>Сортировать:</li>

	            	<li><a id="select-sort"><?php echo $sort_name; ?></a>

		              	<ul id="sorting-list">

			                <li><a href="index.php?sort=users_name" >По имени пользователя</a></li>

			                <li><a href="index.php?sort=email" >По email</a></li>

			                <li><a href="index.php?sort=status" >По статусу задачи</a></li>
		              	</ul>
		            </li>
		        </ul>

				<table  cellpadding="6" cellspacing="2" >
					<tr align="center" >
			            <th>Имя пользоателя</th>
			            <th>E-mail</th>
			            <th>Текст задачи</th>
			            <th>Статус</th>
			        </tr>
		            <?php
		              	include("db_connect.php");//Подключение к бд
		              	$num = 3; // Здесь указываем сколько хотим выводить.

					  	$page = (int)$_GET['page'];

					  	$count = mysqli_query($link,"SELECT COUNT(*) FROM beejee");

					  	$temp = mysqli_fetch_array($count);

						If ($temp[0] > 0)

					    {

					  	    $tempcount = $temp[0];
					  	    // Находим общее число страниц

					  	    $total = (($tempcount - 1) / $num) + 1;

					  	    $total =  intval($total);

					  	    $page = intval($page);

					  	    if(empty($page) or $page < 0) $page = 1;

					  	    if($page > $total) $page = $total;

					  	    // Вычисляем начиная с какого номера
					        // следует выводить товары

					  	    $start = $page * $num - $num;
					  	    $qury_start_num = " LIMIT $start, $num";
					  	}
		              	$result = mysqli_query($link,"SELECT * FROM beejee ORDER BY $sorting $qury_start_num ");

				    	while($row=mysqli_fetch_array($result)) // берем результаты из каждой строки
				        {
				          echo '
				            <tr align="left">
				                <td> '.$row['users_name'].'
				                <td> '.$row['email'].'
				                <td> '.$row['text_zadachi'].'
				                <td>'.$row['status'].'
				            </tr>
				          ';
				        }
				        echo "</table>";
					    if ($page != 1){ $pstr_prev = '<li><a class="pstr-prev" href="index.php?page='.($page - 1).'">&lt;</a></li>';}

					    if ($page != $total) $pstr_next = '<li><a class="pstr-next" href="index.php?page='.($page + 1).'">&gt;</a></li>';

						// Формируем ссылки со страницами

					    if($page - 5 > 0) $page5left = '<li><a href="index.php?page='.($page - 5).'">'.($page - 5).'</a></li>';

					    if($page - 4 > 0) $page4left = '<li><a href="index.php?page='.($page - 4).'">'.($page - 4).'</a></li>';

					    if($page - 3 > 0) $page3left = '<li><a href="index.php?page='.($page - 3).'">'.($page - 3).'</a></li>';

					    if($page - 2 > 0) $page2left = '<li><a href="index.php?page='.($page - 2).'">'.($page - 2).'</a></li>';

					    if($page - 1 > 0) $page1left = '<li><a href="index.php?page='.($page - 1).'">'.($page - 1).'</a></li>';

					    if($page + 5 <= $total) $page5right = '<li><a href="index.php?page='.($page + 5).'">'.($page + 5).'</a></li>';

					    if($page + 4 <= $total) $page4right = '<li><a href="index.php?page='.($page + 4).'">'.($page + 4).'</a></li>';

					    if($page + 3 <= $total) $page3right = '<li><a href="index.php?page='.($page + 3).'">'.($page + 3).'</a></li>';

					    if($page + 2 <= $total) $page2right = '<li><a href="index.php?page='.($page + 2).'">'.($page + 2).'</a></li>';

					    if($page + 1 <= $total) $page1right = '<li><a href="index.php?page='.($page + 1).'">'.($page + 1).'</a></li>';

					    if ($page+5 < $total)

					    {

					    	$strtotal = '<li><p class="nav-point">...</p></li><li><a href="index.php?page='.$total.'">'.$total.'</a></li>';

					    }else

					    {

					    	$strtotal = "";

					    }

					    if ($total > 1)

					    {
					    	echo '

					    	<div class="pstrnav">

					    	<ul>

					    	';

					    	echo $pstr_prev.$page5left.$page4left.$page3left.$page2left.$page1left."<li><a class='pstr-active' href='index.php?page=".$page."'>".$page."</a></li>".$page1right.$page2right.$page3right.$page4right.$page5right.$strtotal.$pstr_next;

					    	echo '

					    	</ul>

					    	</div>

					    	';
					    }
		            ?>
          		<input type="submit" value="Создать новую задачу" name="submit" id="submit" onclick="location.href='new_zadacha.php'" >
      			<input type="submit" value="Авторизация" name="submit" id="submit" onclick="location.href='avtorization.php'" >
		    </div>
	    </div>
	</div>

	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="js/script.js"></script>
</body>
</html>