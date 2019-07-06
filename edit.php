<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="icon" type="image/png" href="favicon.png">
	<link rel="stylesheet" type="text/css" href="styles/style.css">
	<link rel="stylesheet" type="text/css" href="fontawesome/css/all.min.css">

	<title>Редакция</title>
</head>
<body>
	<?php session_start(); 
	require_once('controllers/editController.php');
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
		<textarea name="updatedContent" form="updateQuoteForm"><?php echo $_POST['quoteContent']?></textarea>
		<form class="add" id="updateQuoteForm" method="post">
			<input type="text" name="updatedAuthor" value="<?php echo $_POST['quoteAuthor']?>">
			<input type="hidden" name="id" value="<?php echo $_POST['quoteId']?>">
			<input id="editButton" type="submit" value="Редактирай">
		</form>
	</div>
	<?php echo $_POST['quoteContent']?>
</body>
</html>