<?php 
	$adminlogin = 'admin';
	$adminpassword = 'admin';

	if(isset($_POST['done'])){
		if(trim($_POST['login']) == $adminlogin && trim($_POST['password']) == $adminpassword){
			header('Location: admin.php');
		} else {
			$error = "Не верные данные";
		}
	}


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Вход  в админку</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
</head>
<body class="bg-dark">
	
<div class="container bg-light rounded w-75">

	<form method="POST" class="mt-5 text-center p-5">
		<h3 class="text-center">Войти</h3>
		<br>
		<?=$error; ?>
		<label for="login" class="text-left">
			Логин:
			<input type="text" name="login" id="login"  class="w-100">
		</label>
		<br>
		<label for="password" class="text-left">
			Пароль:
			<input type="password" name="password" id="password" class="w-100">
		</label>
		<br>
		<input type="submit" value="Войти" name="done" class="mt-3 btn btn-info">
		
	</form>
</div>
</body>
</html>