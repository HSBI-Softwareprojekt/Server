<?php
if(isset($_POST["DATA"])) {
	include('./db.php');
	$error = false;
	$msg["ERROR"] = array();
	$data = array();

	$post = JSON_DECODE($_POST["DATA"], true);

	if(strlen($post["USERNAME"]) == 0) {
		$error = true;
		$msg["ERROR"][] = "Bitte geben Sie einen Benutzernamen ein";
	}
	if(strlen($post["PASSWORD"]) == 0) {
		$error = true;
		$msg["ERROR"][] = "Bitte geben Sie ein Passwort ein";
	}

	if(!$error) {
		$statement = $pdo->prepare("SELECT id, username, password FROM users WHERE username = :username");
		$result = $statement->execute(array('username' => $post["USERNAME"]));
		$user = $statement->fetch();
		if($user !== false && password_verify($post["PASSWORD"], $user["password"])) {
			$data["ID"] = $user["id"];
		} else {
			$error = true;
			$msg["ERROR"][] = "Passwort oder Benutzername falsch";
		}
	}

	if(!$error) {
		echo JSON_ENCODE($data);
	} else {
		echo JSON_ENCODE($msg);
	}
} ?>