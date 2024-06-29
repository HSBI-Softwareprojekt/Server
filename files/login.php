<?php
if(isset($_POST["USERNAME"]) and isset($_POST["PASSWORD"])) {
	include('db.php');
	$error = false;
	$msg["error"] = array();
	$data = array();

	$username = trim($_POST["USERNAME"]);
	$password = trim($_POST["PASSWORD"]);

	if(strlen($username) == 0) {
		$error = true;
		$msg["error"][] = "Bitte geben Sie einen Benutzernamen ein";
	}
	if(strlen($password) == 0) {
		$error = true;
		$msg["error"][] = "Bitte geben Sie ein Passwort ein";
	}

	if(!$error) {
		$statement = $pdo->prepare("SELECT id, username, password FROM users WHERE username = :username");
		$result = $statement->execute(array('username' => $username));
		$user = $statement->fetch();
		if($user !== false && password_verify($password, $user["password"])) {
			$data["id"] = intval($user["id"]);
			$data["name"] = $user["username"];
		} else {
			$error = true;
			$msg["error"][] = "Passwort oder Benutzername falsch";
		}
	}

	if(!$error) {
		echo JSON_ENCODE($data);
	} else {
		echo JSON_ENCODE($msg);
	}
} ?>