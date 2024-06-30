<?php
if(isset($_POST["HOST_ID"]) and isset($_POST["CLIENT_ID"]) and isset($_POST["LEVEL"]) and isset($_POST["TIME"])) {
	include('db.php');
	$error = false;
	$msg["error"] = array();
	$data = array();
	
	
	$host = trim($_POST["HOST_ID"]);
	$client = trim($_POST["CLIENT_ID"]);
	$level = trim($_POST["LEVEL"]);
	$time = trim($_POST["TIME"]);
	
	if(strlen($host) == 0) {
		$error = true;
		$msg["error"][] = "Übertragungs Fehler, kein Spieler 1";
	} else if(!is_numeric($host)) {
		$error = true;
		$msg["error"][] = "Übertragungs Fehler, Spieler 1 hat eine ungültige ID";
	} else {
		$sql = "SELECT id FROM users WHERE id = ".intval($host);
		$result = $pdo->query($sql)->fetch();
		if(!$result) {
			$error = true;
			$msg["error"][] = "Spieler 1 existiert nicht";
		} else {
			$host = intval($host);
		}
	}
	if(strlen($client) == 0) {
		$error = true;
		$msg["error"][] = "Übertragungs Fehler, kein Spieler 2";
	} else if(!is_numeric($client)) {
		$error = true;
		$msg["error"][] = "Übertragungs Fehler, Spieler 2 hat eine ungültige ID";
	} else {
		$sql = "SELECT id FROM users WHERE id = ".intval($client);
		$result = $pdo->query($sql)->fetch();
		if(!$result) {
			$error = true;
			$msg["error"][] = "Spieler 2 existiert nicht";
		} else {
			$client = intval($client);
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
	if(strlen($time) == 0) {
		$error = true;
		$msg["error"][] = "Übertragungs Fehler, keine Zeit";
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
		$check_1 = check_score($host, $client, $level, $time);
		$check_2 = check_score($client, $host, $level, $time);
		if(!$check_1 and !$check_2) {
			$statement = $pdo->prepare("INSERT INTO scoreboard (player_1, player_2, level, time) VALUES (:player_1, :player_2, :level, :time)");
			$result = $statement->execute(array("player_1" => $host, "player_2" => $client, "level" => $level, "time" => $time));
			if(!$result) {
				$error = true;
				$msg["error"][] = "Score konnte nicht auf dem Scoreboard gespeichert werden (neu)";
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
				$msg["error"][] = "Vorherige Score Zeit konnte vom Scoreboard nicht aufgerufen werden";
			} else {
				if(strtotime($time) < strtotime($result["time"])) {
					$statement = $pdo->prepare("UPDATE scoreboard SET time = :time WHERE id = ".$id);
					$update = $statement->execute(array("time" => $time));
					if(!$update) {
						$error = true;
						$msg["error"][] = "Neue Zeit konnte nicht auf dem Scoreboard gespeichert werden (aktualisierung)";
					}
				}
				$new_time = strtotime($time);
				$old_time = strtotime($result["time"]);
			}
		}
	}
	
	if(!$error) {
		$score_is_shown = false;
		$i = 0;
		$sql = "SELECT id, player_1, player_2, level, time FROM scoreboard WHERE level = ".$level." ORDER BY time ASC LIMIT 50";
		$res = mysqli_query($mysqli, $sql);
		while($row = mysqli_fetch_assoc($res)) {
			$sql = "SELECT id, username FROM users WHERE id = ".$row["player_1"];
			$player_1 = $pdo->query($sql)->fetch();
			$sql = "SELECT id, username FROM users WHERE id = ".$row["player_2"];
			$player_2 = $pdo->query($sql)->fetch();
			$data["score"][] = strval($i+1);
			$data["score"][] = $player_1["username"];
			$data["score"][] = $player_2["username"];
			$data["score"][] = strval($row["level"]);
			if($row["id"] == $id) {
				$score_is_shown = true;
				$data["score"][] = "1";
				if($check_1 or $check_2) {
					$data["score"][] = "0";
					if($new_time < $old_time) {
						$data["score"][] = "1";
						$data["score"][] = date("H:i:s", $old_time);
						$data["score"][] = date("H:i:s", $new_time);
					} else {
						$data["score"][] = "0";
						$data["score"][] = date("H:i:s", $old_time);
						$data["score"][] = date("H:i:s", $new_time);
					}
				} else {
					$data["score"][] = "1";
					$data["score"][] = "0";
					$data["score"][] = "00:00:00";
					$data["score"][] = $row["time"];
				}
			} else {
				$data["score"][] = "0";
				$data["score"][] = "0";
				$data["score"][] = "0";
				$data["score"][] = "00:00:00";
				$data["score"][] = $row["time"];
			}
			$i++;
		} mysqli_free_result($res);
		unset($i);
		if(!$score_is_shown) {
			$i = 0;
			$sql = "SELECT id, player_1, player_2, level, time FROM scoreboard WHERE level = ".$level." ORDER BY time ASC";
			$res = mysqli_query($mysqli, $sql);
			while($row = mysqli_fetch_assoc($res)) {
				if(intval($row["player_1"]) == $host and intval($row["player_2"]) == $client or intval($row["player_1"]) == $client and intval($row["player_2"]) == $host) {
					$sql = "SELECT id, username FROM users WHERE id = ".$row["player_1"];
					$player_1 = $pdo->query($sql)->fetch();
					$sql = "SELECT id, username FROM users WHERE id = ".$rpw["player_2"];
					$player_2 = $pdo->query($sql)->fetch();
					$data["score"][] = strval($i+1);
					$data["score"][] = $player_1["username"];
					$data["score"][] = $player_2["username"];
					$data["score"][] = strval($row["level"]);;
					$data["score"][] = "1";
					if($check_1 or $check_2) {
						$data["score"][] = "0";
						if($new_time < $old_time) {
							$data["score"][] = "1";
							$data["score"][] = date("H:i:s", $old_time);
							$data["score"][] = date("H:i:s", $new_time);
						} else {
							$data["score"][] = "0";
							$data["score"][] = date("H:i:s", $old_time);
							$data["score"][] = date("H:i:s", $new_time);
						}
					} else {
						$data["score"][] = "1";
						$data["score"][] = "0";
						$data["score"][] = "00:00:00";
						$data["score"][] = $row["time"];
					}
					break;
				}
				$i++;
			} mysqli_free_result($res);
			unset($i);
		}
	}

	if(!$error) {
		echo JSON_ENCODE($data);
	} else {
		echo JSON_ENCODE($msg);
	}
} ?>