<?php
if(isset($_POST["USERNAME"]) and isset($_POST["PASSWORD"])) {
	include('db.php');
	$error = false;
	$msg["ERROR"] = array();
	$data = array();

	$username = trim($_POST["USERNAME"]);
	$password = trim($_POST["PASSWORD"]);

	if(strlen($username) == 0) {
		$error = true;
		$msg["ERROR"][] = "Bitte geben Sie einen Benutzernamen ein";
	}
	if(strlen($password) == 0) {
		$error = true;
		$msg["ERROR"][] = "Bitte geben Sie ein Passwort ein";
	}

	if(!$error) {
		$statement = $pdo->prepare("SELECT id, username, password FROM users WHERE username = :username");
		$result = $statement->execute(array('username' => $username));
		$user = $statement->fetch();
		if($user !== false && password_verify($password, $user["password"])) {
			$data = $user["id"];
		} else {
			$error = true;
			$msg["ERROR"][] = "Passwort oder Benutzername falsch";
		}
	}

	if(!$error) {
		echo "DATA";
		echo "<!=!>".$data;
	} else {
		echo "ERROR";
		foreach($msg["ERROR"] as $index => $err) {
			echo "<!=!>".$err;
		}
	}
} ?>