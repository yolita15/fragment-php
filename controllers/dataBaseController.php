<?php
$dbConnection = createDB();

function createDB () {
	$serverName = 'localhost';
	$username = 'root';
	$dbName = 'fragment_db';
	$password = '';
	$conn = NULL;

	//Create DB
	try {
		$conn = new PDO("mysql:host=$serverName", $username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$createDb = "CREATE DATABASE IF NOT EXISTS $dbName CHARACTER SET utf8 COLLATE utf8_general_ci;";

		$conn->exec($createDb);

	} 
	catch(PDOException $e) {
		http_response_code(500);
	}

	//Create tables
	try {
		$conn = new PDO("mysql:host=$serverName;dbname=$dbName;charset=UTF8", $username, $password);

		//Create table "user"
		$createUserTable = $conn->prepare('CREATE TABLE IF NOT EXISTS user (	    		
			id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
			email VARCHAR(255) NOT NULL UNIQUE ,
			first_name VARCHAR(100) NOT NULL,
			last_name VARCHAR(100) NOT NULL,			    
			password VARCHAR(2056) NOT NULL)'); 

		$createUserTable->execute();

		//Create table "quote"
		$createQuoteTable = $conn->prepare('CREATE TABLE IF NOT EXISTS quote (
			id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			author VARCHAR(200),
			content LONGTEXT NOT NULL,
			publisher_id INT UNSIGNED,
			KEY publisher (publisher_id),
			CONSTRAINT publisher FOREIGN KEY (publisher_id)
			REFERENCES user (id) ON DELETE CASCADE)');

		$createQuoteTable->execute();
	}
	catch (PDOException $e) {
		http_response_code(500);
	}

	return $conn;
}
?>