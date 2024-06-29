<?php
if(isset($_POST["ID"]) and isset($_POST["LEVEL"])) {
	include('db.php');
	$error = false;
	$msg["error"] = array();
	$data["state"] = 0;

	$id = trim($_POST["ID"]);
	$level = trim($_POST["LEVEL"]);
	
	if(strlen($id) == 0) {
		$error = true;
		$msg["error"][] = "Übertragungs Fehler, kein Spieler";
	} else if(!is_numeric($id)) {
		$error = true;
		$msg["error"][] = "Übertragungs Fehler, Spieler hat eine ungültige ID";
	} else {
		$sql = "SELECT id FROM users WHERE id = ".intval($id);
		$result = $pdo->query($sql)->fetch();
		if(!$result) {
			$error = true;
			$msg["error"][] = "Spieler existiert nicht";
		} else {
			$id = intval($id);
		}
	}
	if(strlen($level) == 0) {
		$error = true;
		$msg["error"][] = "Übertragungs Fehler, kein Level";
	} else if(!is_numeric($level)) {
		$error = true;
		$msg["error"][] = "Übertragungs Fehler, ungültiges Level";
	} else {
		$level = intval($level);
	}
	
	if(!$error) {
		$sql = "SELECT user_id, level FROM level WHERE user_id = ".$id." AND level = ".$level;
		$result = $pdo->query($sql)->fetch();
		if(!$result) {
			$statement = $pdo->prepare("INSERT INTO level (user_id, level) VALUES (:user_id, :level)");
			$result = $statement->execute(array("user_id" => $id, "level" => $level));
			if(!$result) {
				$error = true;
				$msg["error"][] = "Level konnte nicht gespeichert werden";
			} else {
				$data["state"] = 1;
			}
		} else {
			$data["state"] = 1;
		}
	}
	
	if(!$error) {
		echo JSON_ENCODE($data);
	} else {
		echo JSON_ENCODE($msg);
	}
} ?>