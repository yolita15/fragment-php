<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="icon" type="image/png" href="favicon.png">
	<link rel="stylesheet" type="text/css" href="styles/style.css">

	<title>Вход</title>
</head>
<body>
	<?php session_start();
		require_once('controllers/loginController.php');
		if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
			header("Location: my-profile.php");
			exit();
		}
	?>
	<!-- Navigation Bar  -->
	<ul class="topnav">
		<li><a class="logo" href="index.php"></a></li>
		<a href="login.php"><li class="right active">Вход</li></a>
		<a href="register.php"><li class="right">Регистрация</li></a>
	</ul>

	<!-- Login form -->
	<form method="post" class="login">
		<h2>Вход</h2>

		<span class="error">
			<?php if(isset($_SESSION['error'])){ echo $_SESSION['error']; $_SESSION['error'] = '';} ?>
		</span>
		<input type="email" name="email" placeholder="Email" autofocus>
		<input type="password" name="password" placeholder="Парола">

		<input type="submit" name="login" value="Вход">
		<p>Нямаш регистрация? Регистрирай се от <a href="register.php">тук</a>!</p>
	</form>
</body>
</html>