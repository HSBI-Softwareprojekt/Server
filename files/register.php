<?php
if(isset($_POST["DATA"])) {
	include('./db.php');
	$error = false;
	$msg["ERROR"] = array();
	$data = array();

	$post = JSON_DECODE($_POST["DATA"], true);

	if(strlen($post["EMAIL"]) == 0) {
		$error = true;
		$msg["ERROR"][] = "Bitte geben Sie eine E-Mail Adresse ein";
	}
	if(strlen($post["USERNAME"]) == 0) {
		$error = true;
		$msg["ERROR"][] = "Bitte geben Sie einen Benutzernamen ein";
	}
	if(strlen($post["PASSWORD"]) == 0) {
		$error = true;
		$msg["ERROR"][] = "Bitte geben Sie ein Passwort ein";
	}
	if(strlen($post["PASSWORD_WD"]) == 0) {
		$error = true;
		$msg["ERROR"][] = "Bitte wiederholen Sie das Passwort";
	}
	if(strlen($post["PASSWORD"]) != 0 and strlen($post["PASSWORD_WD"]) != 0 and $post["PASSWORD"] != $post["PASSWORD_WD"]) {
		$error = true;
		$msg["ERROR"][] = "Passwörter stimmen nicht überein";
	}

	if(!$error) {
		$sql = "SELECT UCASE(username) FROM users WHERE username LIKE '".mb_strtoupper(trim($post["USERNAME"]), "UTF-8")."'";
		$result = $pdo->query($sql)->fetch();
		if($result) {
			$error = true;
			$msg["ERROR"][] = "Benutzername wird bereits verwendet";
		}
		$sql = "SELECT UCASE(mail) FROM users WHERE mail LIKE '".mb_strtoupper(trim($post["EMAIL"]), "UTF-8")."'";
		$result = $pdo->query($sql)->fetch();
		if($result) {
			$error = true;
			$msg["ERROR"][] = "E-Mail Adresse wird bereits verwendet";
		}
	}

	if(!$error) {
		$mail = trim($post["EMAIL"]);
		$username = trim($post["USERNAME"]);
		$password_hash = password_hash($post["PASSWORD"], PASSWORD_DEFAULT);
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
		echo JSON_ENCODE($data);
	} else {
		echo JSON_ENCODE($msg);
	} 
} ?>