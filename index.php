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
</div>
<span>
	<?php if(isset($_SESSION['error'])){ echo $_SESSION['error']; $_SESSION['error'] = '';} ?>
</span>

<script type="text/javascript" src="fontawesome/js/all.min.js"></script>
</body>
</html>