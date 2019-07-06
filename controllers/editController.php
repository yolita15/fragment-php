<?php
require_once('dataBaseController.php');


if($_SERVER['REQUEST_METHOD'] === "POST") {
	if(isset($_POST['id']) && $_POST['id'] != '' && 
		isset($_POST['updatedContent']) && $_POST['updatedContent'] != '' && 
		isset($_POST['updatedAuthor'])){

		updateQuote($dbConnection);
	} if (isset($_POST['updatedContent']) && $_POST['updatedContent'] === '' ) {
		header('Location: my-profile.php');
		exit();
	}
}

function updateQuote($connection) {
	$id = $_POST['id'];
	$content = $_POST['updatedContent'];
	$author = $_POST['updatedAuthor'];
	$quoteToUpdate = $connection->prepare('UPDATE quote SET content = :content, author = :author WHERE id = :id');
	$quoteToUpdate->execute([
		'content' => $content,
		'author' => $author,
		'id' => $id
	]);

	if($quoteToUpdate->rowCount() > 0) {
		header('Location: my-profile.php');
		exit();
	} else {
		header('Location: my-profile.php');
		exit();
	}
}

?>
