<?php 
require_once('controllers/dataBaseController.php');
require_once('models/quote.php');
require_once('models/user.php');

$allQuotes = getAllQuotes($dbConnection);
$allUsers = getAllUsers($dbConnection);

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
			header("Location: index.php"); 
			exit();
		} else {
			$_SESSION['error'] = "Неуспешно добавяне на цитат!";
		}

		
	} catch (Exception $e) {
		
	}
}

function getAllQuotes($connection) {
	try {
		$retrievedQuotes = [];
		$quotesToBeRetrieved = $connection->prepare('SELECT * FROM quote');
		$quotesToBeRetrieved->execute();

		if($quotesToBeRetrieved->rowCount() > 0) {
			while ($quote = $quotesToBeRetrieved->fetchObject('Quote')) {
				$retrievedQuotes[] = $quote;
			}
		}
		
	} catch (Exception $e) {
		
	}
	return array_reverse($retrievedQuotes);
}

function getAllUsers($connection) {
	try {
		$retrievedUsers = [];
		$usersToBeRetrieved = $connection->prepare('SELECT * FROM user');
		$usersToBeRetrieved->execute();

		if($usersToBeRetrieved->rowCount() > 0) {
			while ($user = $usersToBeRetrieved->fetchObject('User')) {
				$retrievedUsers[] = $user;
			}
		}
		
	} catch (Exception $e) {
		
	}
	return $retrievedUsers;
}

function getUser($id, $connection) {
	try {
		$userToBeChecked = $connection->prepare('SELECT * FROM user WHERE id = :id');
		$userToBeChecked->execute(['id' => $id]);
		
		if($userToBeChecked->rowCount() > 0) {

			while ($user = $userToBeChecked->fetchObject('User')) {
				return $user;
			}
		}
		
	} catch (Exception $e) {
		
	}
}

?>