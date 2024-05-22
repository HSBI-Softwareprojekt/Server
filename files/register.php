<?php
if(isset($_POST["EMAIL"]) and isset($_POST["USERNAME"]) and isset($_POST["PASSWORD"]) and isset($_POST["PASSWORD_WD"])) {
	include('db.php');
	$error = false;
	$msg["ERROR"] = array();
	$data = array();

	$mail = trim($_POST["EMAIL"]);
	$username = trim($_POST["USERNAME"]);
	$password = trim($_POST["PASSWORD"]);
	$password_wd = trim($_POST["PASSWORD_WD"]);

	if(strlen($mail) == 0) {
		$error = true;
		$msg["ERROR"][] = "Bitte geben Sie eine E-Mail Adresse ein";
	} else if(!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
		$error = true;
		$msg["ERROR"][] = "Bitte geben Sie eine gültige E-Mail Adresse ein";
	}
	if(strlen($username) == 0) {
		$error = true;
		$msg["ERROR"][] = "Bitte geben Sie einen Benutzernamen ein";
	}
	if(strlen($password) == 0) {
		$error = true;
		$msg["ERROR"][] = "Bitte geben Sie ein Passwort ein";
	}
	if(strlen($password_wd) == 0) {
		$error = true;
		$msg["ERROR"][] = "Bitte wiederholen Sie das Passwort";
	}
	if(strlen($password) != 0 and strlen($password_wd) != 0 and $password != $password_wd) {
		$error = true;
		$msg["ERROR"][] = "Passwörter stimmen nicht überein";
	}

	if(!$error) {
		$sql = "SELECT UCASE(username) FROM users WHERE username LIKE '".mb_strtoupper(trim($username), "UTF-8")."'";
		$result = $pdo->query($sql)->fetch();
		if($result) {
			$error = true;
			$msg["ERROR"][] = "Benutzername wird bereits verwendet";
		}
		$sql = "SELECT UCASE(mail) FROM users WHERE mail LIKE '".mb_strtoupper(trim($mail), "UTF-8")."'";
		$result = $pdo->query($sql)->fetch();
		if($result) {
			$error = true;
			$msg["ERROR"][] = "E-Mail Adresse wird bereits verwendet";
		}
	}

	if(!$error) {
		$password_hash = password_hash($password, PASSWORD_DEFAULT);
		$statement = $pdo->prepare("INSERT INTO users (mail, username, password) VALUES (:mail, :username, :password)");
		$result = $statement->execute(array("mail" => $mail, "username" => $username, "password" => $password_hash));
		if(!$result) {
			$error = true;
			$msg["ERROR"][] = "Konto konnte nicht angelegt werden, bitte versuchen Sie es später erneut";
		} else {
			$data = "TRUE";
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