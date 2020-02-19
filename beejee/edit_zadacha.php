<?php
  session_start();
  if ($_SESSION['auth_admin'] == "yes_auth")
  {


   if (isset($_GET["logout"]))
   {
    unset($_SESSION['auth_admin']);
    header("Location: index.php");
  }

  include("db_connect.php");
  include("functions.php");
  $id = clear_string($_GET["id"]);

  if ($_POST["submit_save"])
  {
    if ($_SESSION['edit_zadacha'] == '1')
    {
      $error = array();

      // Проверка полей

     if (!$_POST["text_zadachi"])
     {
       $error[] = "Укажите текст задачи";
     }

    if (count($error))
    {
      $_SESSION['message'] = "<p id='form-error'>".implode('<br />',$error)."</p>";

    }else
    {

     $querynew = "text_zadachi='{$_POST["text_zadachi"]}',status='Выполнено Отредактированно админом'";

     $update = mysqli_query($link,"UPDATE beejee SET $querynew WHERE id = '$id'");

     $_SESSION['message'] = "<p id='form-success'>Задача успешна изменена!</p>";
     echo '<meta http-equiv="refresh" content="5;URL=index.php">';
   }
  }
  else
  {
   $msgerror = 'У вас нет прав на редактирование задачи!';
  }
  }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="content-type" content="text" charset="windows-1251"/>
  <link href="css/reset.css" rel="stylesheet" type="text/css" />
  <link href="css/style.css" rel="stylesheet" type="text/css" />
  <link href="jquery_confirm/jquery_confirm.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
  <script type="text/javascript" src="js/script.js"></script>
  <script type="text/javascript" src="./ckeditor/ckeditor.js"></script>
  <title>Редактирование задачи</title>
</head>
<body>
  <div id="block-body">

    <div id="block-content">
      <div id="block-parameters">
        <p id="title-page" >Редактирование задачи</p>
      </div>
      <?php
      if (isset($msgerror)) echo '<p id="form-error" align="center">'.$msgerror.'</p>';

      if(isset($_SESSION['message']))
      {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
      }

      if(isset($_SESSION['answer']))
      {
        echo $_SESSION['answer'];
        unset($_SESSION['answer']);
      }
      ?>
      <?php
        $result = mysqli_query($link,"SELECT * FROM beejee WHERE id='$id'");

        $row = mysqli_fetch_array($result);
        do
        {

          echo '

          <form enctype="multipart/form-data" method="post">
          <ul id="edit">

          <li>
          <label>Текст задачи</label>
          <textarea name="text_zadachi">'.$row["text_zadachi"].'</textarea>
          </li>
          </ul>
          <p align="right" ><input type="submit" id="submit_form" name="submit_save" value="Сохранить"/></p>
          </form>
          ';
        }while ($row = mysqli_fetch_array($result));
      ?>
    </div>
  </div>
</body>
</html>
<?php
}else
{
header("Location: admin.php");
}
?>