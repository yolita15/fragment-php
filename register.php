<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="icon" type="image/png" href="favicon.png">
	<link rel="stylesheet" type="text/css" href="styles/style.css">

	<title>Регистрация</title>
</head>
<body>
	<?php 
	include_once('controllers/registerController.php');
	?>
	<!-- Navigation Bar  -->
	<ul class="topnav">
		<li><a class="logo" href="index.php"></a></li>
		<a href="login.php"><li class="right">Вход</li></a>
		<a href="register.php"><li class="right active">Регистрация</li></a>
	</ul>

	<!-- Register form -->
	<form class="register" method="post">
		<h2>Регистрация</h2>

		<span class="error">
			<?php if(isset($_SESSION['error'])){ echo $_SESSION['error']; $_SESSION['error'] = '';} ?>
		</span>
		<span class="error"><?php echo $emailError; ?></span>
		<input type="email" name="email" placeholder="Email" autofocus>

		<span class="error"><?php echo $firstNameError; ?></span>
		<input type="text" name="firstName" placeholder="Име">

		<span class="error"><?php echo $lastNameError; ?></span>
		<input type="text" name="lastName" placeholder="Фамилия">

		<span class="error"><?php echo $passwordError; ?></span>
		<input type="password" name="password" placeholder="Парола">

		<span class="error"><?php echo $repeatPasswordError; ?></span>
		<input type="password" name="repeat-password" placeholder="Потвърди парола">

		<input type="submit" name="register" value="Регистрирай ме">

		<p>Вече имаш регистрация? Влез в профила си от <a href="login.php">тук</a>!</p>
	</form>
</body>
</html>