<?php
if(isset($_POST["ID"])) {
	include('./db.php');
	$error = false;
	$msg["error"] = array();
	$data = array();

	$id = trim($_POST["ID"]);
	
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
	
	if(!$error) {
		$sql = "SELECT user_id, level FROM level WHERE user_id = ".$id." ORDER BY level ASC";
		$res = mysqli_query($mysqli, $sql);
		while($row = mysqli_fetch_assoc($res)) {
			$data["level"][] = intval($row["level"]);
		} mysqli_free_result($res);
		if(count($data) == 0) {
			$data["level"][] = -1;
		}
	}
	
	if(!$error) {
		echo JSON_ENCODE($data);
	} else {
		echo JSON_ENCODE($msg);
	}
} ?>