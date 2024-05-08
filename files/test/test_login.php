<?php
echo "<b>Login Test 1</b><br>";
echo "Benutzername: <br>";
echo "Passwort: <br>";
$test = array();
$test["USERNAME"] = "";
$test["PASSWORD"] = "";
$_POST["DATA"] = JSON_ENCODE($test);
include("../login.php");
echo "<br><br>";

echo "<b>Login Test 2</b><br>";
echo "Benutzername: Test<br>";
echo "Passwort: <br>";
$test = array();
$test["USERNAME"] = "Test";
$test["PASSWORD"] = "";
$_POST["DATA"] = JSON_ENCODE($test);
include("../login.php");
echo "<br><br>";

echo "<b>Login Test 3</b><br>";
echo "Benutzername: <br>";
echo "Passwort: P@ssw0rd<br>";
$test = array();
$test["USERNAME"] = "";
$test["PASSWORD"] = "P@ssw0rd";
$_POST["DATA"] = JSON_ENCODE($test);
include("../login.php");
echo "<br><br>";

echo "<b>Login Test 4</b><br>";
echo "Benutzername: Test123<br>";
echo "Passwort: P@ssw0rd123<br>";
$test = array();
$test["USERNAME"] = "Test123";
$test["PASSWORD"] = "P@ssw0rd123";
$_POST["DATA"] = JSON_ENCODE($test);
include("../login.php");
echo "<br><br>";

echo "<b>Login Test 5</b><br>";
echo "Benutzername: Test<br>";
echo "Passwort: P@ssw0rd<br>";
$test = array();
$test["USERNAME"] = "Test";
$test["PASSWORD"] = "P@ssw0rd";
$_POST["DATA"] = JSON_ENCODE($test);
include("../login.php"); ?>