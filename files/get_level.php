<?php
if(isset($_POST["DATA"])) {
	include('./db.php');
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
	
	if(!$error) {
		$sql = "SELECT user_id, level FROM level WHERE user_id = ".$post["PLAYER"]." ORDER BY level ASC";
		$res = mysqli_query($mysqli, $sql);
		while($row = mysqli_fetch_assoc($res)) {
			$data[] = intval($row["level"]);
		} mysqli_free_result($res);
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