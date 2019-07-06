<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="icon" type="image/png" href="favicon.png">
	<link rel="stylesheet" type="text/css" href="styles/style.css">
	<link rel="stylesheet" type="text/css" href="fontawesome/css/all.min.css">

	<title>Fragment</title>
</head>
<body>
	<?php 
	session_start();
	require_once('controllers/dataBaseController.php');
	require_once('controllers/addQuoteController.php');
	?>
	<!-- Navigation Bar  -->
	<ul class="topnav">
		<li><a class="logo" href="index.php"></a></li>
		<?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
		echo '<a href="logout.php"><li class="right">Изход</li></a>
		<a href="my-profile.php"><li class="right">Моят профил</li></a>
		<a href="index.php"><li class="right active">Начало</li></a>';
	} else {
	echo '<a href="login.php"><li class="right">Вход</li></a>
	<a href="register.php"><li class="right">Регистрация</li></a>';
} ?>

</ul>

<div class="container">
	<!-- Add form  -->
	<?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
	echo '
	<textarea name="content" form="addQuoteForm"></textarea>
	<form class="add" id="addQuoteForm" method="post">
		<input type="text" name="author" placeholder="Автор, източник">
		<div class="addButtons">
			<button title="Добави"><i class="fas fa-plus-circle"></i> Добави</button>
		</div>			
	</form>';
} ?>

<span>
	<?php if(isset($_SESSION['error'])){ echo $_SESSION['error']; $_SESSION['error'] = '';} ?>
</span>
	<?php 
		if(count($allQuotes) != 0) {
				foreach ($allQuotes as $quote) {
				$currentUser = getUser($quote->publisher_id, $dbConnection);
				echo '<div class="home-page-content">" '.$quote->content.' "</div>';
				echo '<div class="author">- '.$quote->author.'</div>';	
				echo '<div class="publisher"> Публикувано от:  '.$currentUser->first_name.' '.$currentUser->last_name.'</div>';
			}
		} else {
		if(!isset($_SESSION['loggedin']))
		{
			echo '<div class="home-page-content">Все още няма добавени цитати... Промени това от <a href="my-profile.php">тук</a> :)</div>';
		}
	}
	?>

</div>
<div class="footer"></div>

<script type="text/javascript" src="fontawesome/js/all.min.js"></script>
</body>
</html>