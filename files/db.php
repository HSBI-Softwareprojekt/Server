<?php
$mysqli = mysqli_connect("localhost:3380", "root", "", "puddle_partners"); 
$pdo = new PDO('mysql:host=localhost:3380;dbname=puddle_partners', 'root', ''); 
$mysqli->set_charset("utf8"); 
$pdo->exec("SET NAMES utf8"); ?>