<?php 
require_once('controllers/dataBaseController.php');

if($_SERVER['REQUEST_METHOD'] === "POST") {
	if($_POST['content'] != '') {
		addQuote($dbConnection);
	} 
}

function addQuote($connection) {
	try {
		$author = $_POST['author'];
		$content = $_POST['content'];
		$publisher_id = $_SESSION['userId'];

		$newQuote = $connection->prepare('INSERT IGNORE INTO quote (author, content, publisher_id) 
			VALUES (:author, :content, :publisher_id)');

		$newQuote->execute([
			'author' => $author, 
			'content' => $content, 
			'publisher_id' => $publisher_id]);

		if($newQuote->rowCount() > 0) {
			http_response_code(201);
		} else {
			$_SESSION['error'] = "Неуспешно добавяне на цитат!";
		}

		
	} catch (Exception $e) {
		
	}
}

?>