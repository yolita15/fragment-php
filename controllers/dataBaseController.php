<?php
$dbConnection = createDB();

function createDB () {
	$serverName = 'localhost';
	$username = 'root';
	$dbName = 'fragment_db';
	$password = '';
	$conn = NULL;
	try {
		$conn = new PDO("mysql:host=localhost", $username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$createDb = "CREATE DATABASE IF NOT EXISTS $dbName CHARACTER SET utf8 COLLATE utf8_general_ci;";

		$conn->exec($createDb);

	} catch(PDOException $e) {
		$errorArray['error'] = $e;
		echo json_encode($errorArray, JSON_UNESCAPED_UNICODE);
		http_response_code(500);
	}

	//Create table "user"
	try {
		$conn = new PDO("mysql:host=$serverName;dbname=$dbName;charset=UTF8", $username, $password);

		$createTable = "CREATE TABLE IF NOT EXISTS user (	    		
		id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
		email VARCHAR(255) NOT NULL UNIQUE ,
		first_name VARCHAR(100) NOT NULL,
		last_name VARCHAR(100) NOT NULL,			    
		password VARCHAR(2056) NOT NULL
	)"; 

	$conn->exec($createTable);}

	catch (PDOException $e) {	    	
		$errorArray['error'] = $e;
		echo json_encode($errorArray, JSON_UNESCAPED_UNICODE);
		http_response_code(500);
	}

	return $conn;
}
?>