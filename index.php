
<?php
	$mysqli = new mysqli('localhost', 'id8603457_gap', 'm24031980', 'id8603457_gap');
	


	$r = $mysqli->query("SELECT * FROM `ruletka`");

		$img_srcARR = [];
		$img_nameARR = [];
		$idGameARR = [];
		$countARR = [];
		$chanceARR = [];

		while($row = $r->fetch_array()){
			$img_srcARR[] = $row['img_src'];
			$img_nameARR[] = $row['img_name'];
			$chanceARR[] = $row['chace'];
		}


	$chanceArr = [999, 950, 888, 777, 666, 555, 96, 50];
	$arrArr = ['Броня', 'ШАУРМА','Глина', 'Алмаз', 'Опыт', 'Яблоко', 'ШАУРМА!!', 'Око'];
	$nameItemArr = ['armor', 'shava', 'clay', 'diamond', 'exp', 'gold_apple', 'helmet', 'oko'];


	$arr = json_encode($img_nameARR);
	$nameItem = json_encode($img_srcARR);
	$chance = json_encode($chanceARR);

	
?>
<!DOCTYPE html>
<html>
<head>
	<title>RULET</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
</head>
<div class="container">
<body class="bg-dark">
	<div class="jumbotron mt-5">
		<h1>Рулетка</h1>
		<p><a href="admin-form.php">Admin-Panel</a></p>
	</div>


<div class="card mb-5" style="width: 18rem;">
  <img src="image/s600.png" class="mt-5" >
  <div class="card-body text-center"> 
  	<hr>
    <h5 class="card-title">Обычный кейс</h5>
	<button type="button" class="btn btn-primary" id="start" data-toggle="modal" data-target="#twist">
	 	Крутить рулетку
	</button>
  </div>
</div>


		<!-- Modal -->
		<div class="modal fade" id="twist" tabindex="-1" aria-labelledby="modalM" >
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="modalM">Кейс</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		        <div class="role">
					<div class="line-red"></div>
					<ul class="line" style="left: 0"></ul>
				</div>
		      </div>
		    </div>
		  </div>
		</div>

</div>
<script>

	// Прокручиваем рулетку
	let line = document.querySelector('.line');
	let posL = 0;

	// Запускаем рулетку по кнопке и выбивает нужный элемент
	start.onclick = function () {
		setTimeout(function(){
			posL -= ((line.childNodes.length-1)  * 80) - 160;
			line.style.left = posL +"px";
		}, 500)
		setTimeout(function(){
			alert('Ваш приз - это '+name);
			document.location.href="index.php";
		}, 5800)
	}
	let arr = JSON.parse('<?=$arr?>');
	let nameItem = JSON.parse('<?=$nameItem?>');
	let chance = JSON.parse('<?=$chance?>');

	//  Генерирует рандомное число от 10 до 999
	let randomD = Math.floor(Math.random()*(999-10)+10);

	// Массивы, чтобы вывести предмет и его имя глоаббально
	let name = [];
	let srcimg = [];

	

	for (i = 0; i < 40; i++) {
		r = Math.floor(Math.random() * (nameItem.length - 1)+1);
		line.innerHTML += "<li><img src='image/"+nameItem[r]+".png'></li>";
	}

	//  Скрипт, который подсичтывает с какой вероятностью выпадет предмет и его изображение
	for (i = 0; i < arr.length; i++) {
	
		if(randomD < chance[i]){
			name = arr[i];
			srcimg = nameItem[i];
		} 
	}
	// Выбираем все изображения из рулетки, чтоб изменить изображение на выпадаемый элемент
	let lineEl = document.querySelectorAll('.line>li>img');
	
	// Прописываем выйграшное изображение
	lineEl[((line.childNodes.length-1))-1].src = "image/"+srcimg+".png";

</script>

<!-- JS, Popper.js, and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>
