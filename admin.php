<?php 
	$mysqli = new mysqli('localhost', 'id8603457_gap', 'm24031980', 'id8603457_gap');

		$idDel =  $_POST['id_del'];		

		if(isset($_POST['delete'])){
			$rr = $mysqli->query("DELETE FROM `ruletka` WHERE `id_game` = '$idDel'") or die("Ошибка!<a href='admin.php'>Вернутсья</a>");
		}

		function translit($s) {
		  $s = (string) $s; // преобразуем в строковое значение
		  $s = strip_tags($s); // убираем HTML-теги
		  $s = str_replace(array("\n", "\r"), " ", $s); // убираем перевод каретки
		  $s = preg_replace("/\s+/", ' ', $s); // удаляем повторяющие пробелы
		  $s = trim($s); // убираем пробелы в начале и конце строки
		  $s = function_exists('mb_strtolower') ? mb_strtolower($s) : strtolower($s); // переводим строку в нижний регистр (иногда надо задать локаль)
		  $s = strtr($s, array('а'=>'a','б'=>'b','в'=>'v','г'=>'g','д'=>'d','е'=>'e','ё'=>'e','ж'=>'j','з'=>'z','и'=>'i','й'=>'y','к'=>'k','л'=>'l','м'=>'m','н'=>'n','о'=>'o','п'=>'p','р'=>'r','с'=>'s','т'=>'t','у'=>'u','ф'=>'f','х'=>'h','ц'=>'c','ч'=>'ch','ш'=>'sh','щ'=>'shch','ы'=>'y','э'=>'e','ю'=>'yu','я'=>'ya','ъ'=>'','ь'=>''));
		  $s = preg_replace("/[^0-9a-z-_ ]/i", "", $s); // очищаем строку от недопустимых символов
		  $s = str_replace(" ", "-", $s); // заменяем пробелы знаком минус
		  return $s; // возвращаем результат
		}

		$_FILES['picture']['name'] = translit($_POST['name']);
		$types = array('image/png');
		$path = "image/";
		$size = 1024000;


		if(isset($_POST['done']) and !empty($_POST['name']) and !empty($_POST['id']) and !empty($_POST['count']) and !empty($_POST['chance'])){


			if (!in_array($_FILES['picture']['type'], $types)){
		 		die('Запрещённый тип файла. Загружать можно только .PNG<br><a href="admin.php">Админка</a><br>');
			}

		 	// Проверяем размер файла
			if ($_FILES['picture']['size'] > $size){
				die('Слишком большой размер файла!<br><a href="admin.php">Админка</a><br>');
			}

			
			if (!@copy($_FILES['picture']['tmp_name'], $path.$_FILES['picture']['name'].".png"))
			 echo 'Что-то пошло не так';
			 else
			 echo 'Загрузка удачна';



		$img_src = translit($_POST['name']);
		$name = $_POST['name'];
		$id = $_POST['id'];
		$count = $_POST['count'];
		$chance = $_POST['chance'];


		$mysqli->query("INSERT INTO `ruletka` (`img_src`, `img_name`, `id_game`, `count`, `chace`) VALUES('$img_src', '$name', '$id', '$count', '$chance')");
		}


		$r = $mysqli->query("SELECT * FROM `ruletka`");

		$img_srcARR = [];
		$img_nameARR = [];
		$idGameARR = [];
		$countARR = [];
		$chanceARR = [];

		while($row = $r->fetch_array()){
			$img_srcARR[] = $row['img_src'];
			$img_nameARR[] = $row['img_name'];
			$idGameARR[] = $row['id_game'];
			$countARR[] = $row['count'];
			$chanceARR[] = $row['chace'];
		}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Админка</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
</head>
<body class="bg-dark">
	

<div class="container mt-5">
	<div class="jumbotron mt-5">
		<h4>Редактирование рулетки</h4>
		<h3><a href="index.php">На главную</a></h3>
	</div>

	<br>

	<div class="accordion" id="accordionExample">
	  <div class="card">
	    <div class="card-header" id="headingOne">
	      <h5 class="mb-0">
	        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
	             <h5 class="text-center">Добавить предмет</h5>
	        </button>
	      </h5>
	    </div>

	    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
	      <div class="card-body">
				<form class="addItem" method="POST" enctype="multipart/form-data">
					<input type="file" name="picture">
					<input type="text" placeholder="Название" class="form-control" name="name">
					<input type="text" placeholder="ID" class="form-control w-25" name="id">
					<input type="text" placeholder="Кол-во" class="form-control w-25" name="count">
					<input type="text" placeholder="Вероятность" class="form-control w-50" name="chance">
					<input type="submit" class="btn btn-success" value="Добавить" name="done">
				</form>
	      	<small>Изображение должно быть квадратным и иметь расширение .png</small>
	      </div>
	    </div>
	  </div>
	  <div class="card">
	    <div class="card-header" id="headingTwo">
	      <h5 class="mb-0">
	        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
	         	<h5 class="text-center">Удалить предмет</h5>
	        </button>
	      </h5>
	    </div>
	    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
	      <div class="card-body">
			<form method="POST" class="deleteItem">
				<input type="text" class="form-control btn" disabled>
				<input type="text" placeholder="Введите ID предмета" class="form-control" name="id_del">
				<input type="submit" name="delete" class="form-control w-25 btn btn-danger" value="Удалить">
				<input type="text" class="form-control btn" disabled>
			</form>
	      </div>
	    </div>
	  </div>
	</div>

	<br>

	<table class="table bg-light">
	  <thead>
	    <tr>
	      <th scope="col">#</th>
	      <th scope="col">Картинка</th>
	      <th scope="col">Название</th>
	      <th scope="col">ID</th>
	      <th scope="col">Количество</th>
	      <th scope="col">Вероятность</th>
	    </tr>
	  </thead>
	  <tbody>
	  	<?php 
	  		for($i = 1; $i < count($img_nameARR); $i++){
	  			echo "<tr>";
	  			echo "<th scope='row'>".$i."</th>";
	  			echo "<th><img src='image/".$img_srcARR[$i].".png'></th>";
	  			echo "<th>".$img_nameARR[$i]."</th>";
	  			echo "<th>".$idGameARR[$i]."</th>";
	  			echo "<th>".$countARR[$i]."</th>";
	  			echo "<th>".$chanceARR[$i]."</th>";
	  			echo "</tr>";
	  		}
	  	?>
	  </tbody>
	</table>

</div>
<!-- JS, Popper.js, and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>
