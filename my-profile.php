<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="icon" type="image/png" href="favicon.png">
	<link rel="stylesheet" type="text/css" href="styles/style.css">
	<link rel="stylesheet" type="text/css" href="fontawesome/css/all.min.css">

	<title>Моят Профил</title>
</head>
<body>
	<?php session_start(); 
	require_once('controllers/myQuotesController.php');
	if(!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == false) {
		header("Location: index.php");
		exit();
	} ?>
	<!-- Navigation Bar  -->
	<ul class="topnav">
		<li><a class="logo" href="index.php"></a></li>
		<a href="logout.php"><li class="right">Изход</li></a>
		<a href="my-profile.php"><li class="right active">Моят профил</li></a>
		<a href="index.php"><li class="right">Начало</li></a>
	</ul>

	<div class="container">
		<div class="quotes">
			<h4>Моите цитати:</h4>	
			<?php
			if (count($quotes) != 0) {
				foreach ($quotes as $quote) {
					echo '<div>'.$quote->content.'</div>';
					echo '<div>'.$quote->author.'</div>';	
					echo '<form>
					<input type="hidden" name="quoteId" value="'.$quote->id.'">
					<button title="Изтрий"><i class="fas fa-trash"></i></button>
					</form>';
				}
			}
			?>		
		</div>
		<div class="profile-details">
			<h4><i class="fas fa-user"></i> Име: <?php echo $_SESSION['firstName'], ' ',$_SESSION['lastName']; ?></h4>
			<h4><i class="fas fa-at"></i> Имейл: <?php echo $_SESSION['email']; ?></h4>
			<h4><i class="fas fa-star"></i> Fragment точки:</h4>
		</div>

	</div>
	<script type="text/javascript" src="fontawesome/js/all.min.js"></script>
</body>
</html>