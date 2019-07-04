<?php
require_once('controllers/dataBaseController.php');
require_once('models/user.php');

if($_SERVER['REQUEST_METHOD'] === "POST") {
	if($_POST['email'] != '' && $_POST['password'] != '') {
		checkUser($dbConnection);
	}
}

function checkUser($connection) {
	try {
		$password = $_POST['password'];
		$email = $_POST['email'];

		$userToBeChecked = $connection->prepare('SELECT * FROM user WHERE email = :email');
		$userToBeChecked->execute(['email' => $email]);
		
		if($userToBeChecked->rowCount() > 0) {

			while ($user = $userToBeChecked->fetchObject('User')) {
				if(password_verify($password, $user->password) == true) {
					$_SESSION['loggedin'] = true;
					$_SESSION['userId'] = $user->id;
					$_SESSION['email'] = $user->email;
					$_SESSION['firstName'] = $user->first_name;
					$_SESSION['lastName'] = $user->last_name;
					header("Location: my-profile.php");
					exit();
				} else {
					$_SESSION['error'] = "Невалиден имейл или парола!";
					header("Location: login.php");
					exit();
				}
			}
		}
		
	} catch (Exception $e) {
		
	}
}

?>