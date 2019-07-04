<?php 
require_once('controllers/dataBaseController.php');
require_once('models/quote.php');

$quotes = getUserQuotes($dbConnection);

function getUserQuotes($connection) {

	try {
		$retrievedQuotes = [];
		$publisher_id = $_SESSION['userId'];
		$quotesToBeRetrieved = $connection->prepare('SELECT * FROM quote WHERE publisher_id = :publisher_id');
		$quotesToBeRetrieved->execute(['publisher_id' => $publisher_id]);

		if($quotesToBeRetrieved->rowCount() > 0) {

			while ($quote = $quotesToBeRetrieved->fetchObject('Quote')) {
				$retrievedQuotes[] = $quote;
			}
		}
		
	} catch (Exception $e) {
		
	}
	return $retrievedQuotes;
}
?>