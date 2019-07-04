<?php
session_start();
require_once('controllers/dataBaseController.php');

$emailError = "";
$firstNameError = "";
$lastNameError = "";
$passwordError = "";
$repeatPasswordError = "";
$existingEmailError = "";
$successMessage = "";

$isEmailValid = $isFirstNameValid = $isLastNameValid = $isPasswordValid = $isRepeatedPasswordValid = false;

if($_SERVER['REQUEST_METHOD'] === "POST") {

	//Validate email
	if($_POST['email'] === '') {
		$emailError = 'Имейлът е задължителен!';
		http_response_code(400);
	} else if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		$emailError = 'Невалиден имейл адрес!';
		http_response_code(400);
	} else if(mb_strlen($_POST['email']) > 255) {
		$emailError = "Имейлът не може да е по-дълъг от 255 символа!";
		http_response_code(400);
	} else {
		$isEmailValid = true;
	}

	//Validate first name
	if($_POST['firstName'] === '') {
		$firstNameError = 'Името е задължително!';
		http_response_code(400);
	} else if(!preg_match("/^[а-яА-Яa-zA-Z]+$/", $_POST['firstName'])) {
		$firstNameError = "За името са допустими единствено букви!";
		http_response_code(400);
	} else if(mb_strlen($_POST['firstName']) > 100) {
		$firstNameError = 'Името не може да е по-дълго от 100 символа!';
		http_response_code(400);
	} else {
		$isFirstNameValid = true;
	}

	//Validate last name
	if ($_POST['lastName'] === '') {
		$lastNameError = 'Фамилията е задължителна!';
		http_response_code(400);
	} else if(!preg_match("/^[а-яА-Яa-zA-Z]+$/", $_POST['lastName'])) {
		$lastNameError = 'За фамилията са допустими единствено букви!';
		http_response_code(400);
	} else if(mb_strlen($_POST['lastName']) > 100) {
		$lastNameError = 'Фамилията не може да е по-дълга от 100 символа!';
		http_response_code(400);
	} else {
		$isLastNameValid = true;
	}

	//Validate password
	if($_POST['password'] === '') {
		$passwordError = 'Паролата е задължителна!';
		http_response_code(400);
	} else if(mb_strlen($_POST['password']) > 2056) {
		$passwordError = 'Паролата не може да е по-дълга от 2056 символа!';
		http_response_code(400);
	} else {
		$isPasswordValid = true;
	}

	//Validate repeated password
	if($_POST['repeat-password'] === '') {
		$repeatPasswordError = 'Моля, повторете паролата!';
		http_response_code(400);
	} else if(strcmp($_POST['repeat-password'], $_POST['password']) != 0) {
		$repeatPasswordError = 'Паролите не съвпадат!';
		http_response_code(400);
	} else {
		$isRepeatedPasswordValid = true;
	}

	if($isEmailValid && $isFirstNameValid && $isLastNameValid && $isPasswordValid && $isRepeatedPasswordValid) {
		register($dbConnection);
	}
} else {
	http_response_code(400);
}

function register($connection) {
	try {
		$registerUer = $connection->prepare('INSERT IGNORE INTO user (email, first_name, last_name, password) 
			VALUES (:email, :first_name, :last_name, :password)');

		$registerUer->execute([
			'email' => $_POST['email'], 
			'first_name' => $_POST['firstName'], 
			'last_name' => $_POST['lastName'], 
			'password' => password_hash($_POST['password'], PASSWORD_DEFAULT)
		]);

		if($registerUer->rowCount() > 0) {
			$_SESSION['loggedin'] = true;
			$_SESSION['email'] = $_POST['email'];
			$_SESSION['firstName'] = $_POST['firstName'];
			$_SESSION['lastName'] = $_POST['lastName'];
			header("Location: my-profile.php"); 
			exit();
		} else {
			$_SESSION['error'] = "Имейлът вече съществува!";
			header("Location: register.php"); 
			exit();
		} 
	}
	catch (PDOException $e) {	    	
		$errorArray['error'] = $e;
		echo json_encode($errorArray, JSON_UNESCAPED_UNICODE);
		http_response_code(500);
	}
}
?>