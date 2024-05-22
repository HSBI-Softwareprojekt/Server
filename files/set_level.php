<?php
if(isset($_POST["DATA"])) {
	include('db.php');
	$error = false;
	$msg["ERROR"] = array();
	$data = array();

	$post = JSON_DECODE($_POST["DATA"], true);
	if(strlen($post["PLAYER"]) == 0) {
		$error = true;
		$msg["ERROR"][] = "Übertragungs Fehler, kein Spieler";
	} else if(!is_numeric($post["PLAYER"])) {
		$error = true;
		$msg["ERROR"][] = "Übertragungs Fehler, Spieler hat eine ungültige ID";
	} else {
		$sql = "SELECT id FROM users WHERE id = ".intval($post["PLAYER"]);
		$result = $pdo->query($sql)->fetch();
		if(!$result) {
			$error = true;
			$msg["ERROR"][] = "Spieler existiert nicht";
		} else {
			$post["PLAYER"] = intval($post["PLAYER"]);
		}
	}
	if(strlen($post["LEVEL"]) == 0) {
		$error = true;
		$msg["ERROR"][] = "Übertragungs Fehler, kein Level";
	} else if(!is_numeric($post["LEVEL"])) {
		$error = true;
		$msg["ERROR"][] = "Übertragungs Fehler, ungültiges Level";
	} else {
		$post["LEVEL"] = intval($post["LEVEL"]);
	}
	
	if(!$error) {
		$sql = "SELECT user_id, level FROM level WHERE user_id = ".$post["PLAYER"]." AND level = ".$post["LEVEL"];
		$result = $pdo->query($sql)->fetch();
		if(!$result) {
			$statement = $pdo->prepare("INSERT INTO level (user_id, level) VALUES (:user_id, :level)");
			$result = $statement->execute(array("user_id" => $post["PLAYER"], "level" => $post["LEVEL"]));
			if(!$result) {
				$error = true;
				$msg["ERROR"][] = "Level konnte nicht gespeichert werden";
			} else {
				$data = "TRUE";
			}
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