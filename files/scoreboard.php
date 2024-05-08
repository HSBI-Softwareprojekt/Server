<?php
if(isset($_POST["DATA"])) {
	include('./db.php');
	$error = false;
	$msg["ERROR"] = array();
	$data = array();

	$post = JSON_DECODE($_POST["DATA"], true);
	
	if(strlen($post["PLAYER_1"]) == 0) {
		$error = true;
		$msg["ERROR"][] = "Übertragungs Fehler, kein Spieler eins";
	} else if(!is_numeric($post["PLAYER_1"])) {
		$error = true;
		$msg["ERROR"][] = "Übertragungs Fehler, Spieler eins hat eine ungültige ID";
	} else {
		$sql = "SELECT id FROM users WHERE id = ".intval($post["PLAYER_1"]);
		$result = $pdo->query($sql)->fetch();
		if(!$result) {
			$error = true;
			$msg["ERROR"][] = "Spieler eins existiert nicht";
		} else {
			$post["PLAYER_1"] = intval($post["PLAYER_1"]);
		}
	}
	if(strlen($post["PLAYER_2"]) == 0) {
		$error = true;
		$msg["ERROR"][] = "Übertragungs Fehler, kein Spieler zwei";
	} else if(!is_numeric($post["PLAYER_2"])) {
		$error = true;
		$msg["ERROR"][] = "Übertragungs Fehler, Spieler zwei hat eine ungültige ID";
	} else {
		$sql = "SELECT id FROM users WHERE id = ".intval($post["PLAYER_2"]);
		$result = $pdo->query($sql)->fetch();
		if(!$result) {
			$error = true;
			$msg["ERROR"][] = "Spieler zwei existiert nicht";
		} else {
			$post["PLAYER_2"] = intval($post["PLAYER_2"]);
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
	if(strlen($post["TIME"]) == 0) {
		$error = true;
		$msg["ERROR"][] = "Übertragungs Fehler, keine Zeit";
	}
	
	function check_score($player_1, $player_2, $level) {
		global $pdo;
		global $mysqli;
		global $error;
		global $msg;
		$sql = "SELECT id, player_1, player_2, level FROM scoreboard WHERE player_1 = ".$player_1." AND player_2 = ".$player_2." AND level = ".$level;
		$result = $pdo->query($sql)->fetch();
		if($result) {
			return $result["id"];
		} else {
			return false;
		}
	};

	if(!$error) {
		$check_1 = check_score($post["PLAYER_1"], $post["PLAYER_2"], $post["LEVEL"]);
		$check_2 = check_score($post["PLAYER_2"], $post["PLAYER_1"], $post["LEVEL"]);
		if(!$check_1 and !$check_2) {
			$statement = $pdo->prepare("INSERT INTO scoreboard (player_1, player_2, level, time) VALUES (player_1, player_2, level, time)");
			$result = $statement->execute(array("player_1" => $post["PLAYER_1"], "player_2" => $post["PLAYER_2"], "level" => $post["LEVEL"], "time" => $post["time"]));
			if(!$result) {
				$error = true;
				$msg["ERROR"][] = "Score konnte nicht auf dem Scoreboard gespeichert werden (neu)";
			} else {
				$id = $pdo->lastInsertId();
			}
		} else {
			if($check_1 !== false) {
				$id = $check_1;
			} else {
				$id = $check_2;
			}
			$sql = "SELECT id, time FROM scoreboard WHERE id = ".$id;
			$result = $pdo->query($sql)->fetch();
			if(!$result) {
				$error = true;
				$msg["ERROR"][] = "Vorherige Score Zeit konnte vom Scoreboard nicht aufgerufen werden";
			} else {
				if(strtotime($post["TIME"]) < strtotime($result["time"])) {
					$statement = $pdo->prepare("UPDATE scoreboard SET time = :time WHERE id = ".$id);
					$result = $statement->execute(array("time" => $post["time"]));
					if(!$result) {
						$error = true;
						$msg["ERROR"][] = "Neue Zeit konnte nicht auf dem Scoreboard gespeichert werden (aktualisierung)";
					}
				}
			}
		}
	}
	
	if(!$error) {
		$i = 0;
		$sql = "SELECT id, player_1, player_2, level, time FROM scoreboard WHERE level = ".$post["LEVEL"]." ORDER BY time ASC";
		$res = mysqli_query($mysqli, $sql);
		while($row = mysqli_fetch_assoc($res)) {
			$sql = "SELECT id, username FROM users WHERE id = ".$row["player_1"];
			$player_1 = $pdo->query($sql)->fetch();
			$sql = "SELECT id, username FROM users WHERE id = ".$row["player_2"];
			$player_2 = $pdo->query($sql)->fetch();
			$data[$i]["RANK"] = "Platz: ".($i+1);
			$data[$i]["PLAYER_1"] = $player_1["username"];
			$data[$i]["PLAYER_2"] = $player_2["username"];
			$data[$i]["LEVEL"] = intval($row["level"]);
			$data[$i]["TIME"] = $row["time"];
			if($row["id"] == $id) {
				$data[$i]["OWN"] = 1;
			} else {
				$data[$i]["OWN"] = 0;
			}
		} mysqli_free_result($res);
		unset($i);
	}

	if(!$error) {
		echo JSON_ENCODE($data);
	} else {
		echo JSON_ENCODE($msg);
	}
} ?>