<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/style.css">

	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script type="text/javascript" src="js/jquery.form.js"></script>
    <script type="text/javascript" src="js/TextChange.js"></script>
    <script type="text/javascript" src="js/jquery.validate.js"></script>

    <script type="text/javascript">
	$(document).ready(function() {
      $('#form_reg').validate(
				{
					// правила для проверки
					rules:{
						"reg_name":{
							required:true,
                            minlength:3,
                            maxlength:15
						},
						"reg_email":{
						    required:true,
							email:true
						},
						"text_zadachi":{
							required:true
						},
					},

					// выводимые сообщения при нарушении соответствующих правил
					messages:{
						"reg_name":{
							required:"Укажите ваше Имя!",
                            minlength:"От 3 до 15 символов!",
                            maxlength:"От 3 до 15 символов!"
						},
						"reg_email":{
						    required:"Укажите свой E-mail",
							email:"Не корректный E-mail"
						},
						"text_zadachi":{
							required:"Укажите текст задачи!"
						},
					},

		submitHandler: function(form){
		$(form).ajaxSubmit({
		success: function(data) {

	        if (data == 'true')
	    {
	       $("#block-form-registration").fadeOut(300,function() {

	        $("#reg_message").addClass("reg_message_good").fadeIn(400).html("Вы успешно зарегистрированы!");
	        $("#form_submit").hide();

	       });

	    }
	    else
	    {
	       $("#reg_message").addClass("reg_message_error").fadeIn(400).html(data);
	    }
			}
				});
				}
				});
	    	});

	</script>
    <title>Новая задача</title>
</head>
<body>
	<div class = "container">
	    <div class = "row">
		    <div class = "col-md-12">
		    	<h2 class="h2-title">Добавить задачу</h2>
				<form method="post" id="form_reg" action="handler_reg.php">
					<p id="reg_message"></p>
					<div id="block-form-registration">
						<ul id="form-registration">
							<li>
							<label>Имя</label>
							<span class="star" >*</span>
							<input type="text" name="reg_name" id="reg_name" />
							</li>

							<li>
							<label>E-mail</label>
							<span class="star" >*</span>
							<input type="text" name="reg_email" id="reg_email" />
							</li>

							<li>
							<label>Задача</label>
							<span class="star" >*</span>
							<textarea name="text_zadachi" id="text_zadachi"> </textarea>
							</li>
						</ul>
					</div>
					<input type="submit" name="reg_submit" id="form_submit" value="Добавить задачу" />
				</form>
		    </div>
	    </div>
	</div>
</body>
</html>