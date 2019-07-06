<?php
require_once('dataBaseController.php');

if($_SERVER['REQUEST_METHOD'] === "POST") {
	if($_POST['quoteId'] != '') {
		deleteQuote($dbConnection);
	}
}

function deleteQuote($connection) {
	$id = $_POST['quoteId'];
	$quoteToDelete = $connection->prepare('DELETE FROM quote WHERE id = :id');
	$quoteToDelete->execute(['id' => $id]);

	if($quoteToDelete->rowCount() > 0) {
		header('Location: ../my-profile.php');
		exit();
	} else {
		echo "Error";
	}
}

?>