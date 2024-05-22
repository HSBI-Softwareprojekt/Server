<?php
$mysqli = mysqli_connect("localhost:3306", "root", "", "puddle_partners"); 
$pdo = new PDO('mysql:host=localhost:3306;dbname=puddle_partners', 'root', ''); 
$mysqli->set_charset("utf8"); 
$pdo->exec("SET NAMES utf8"); ?>