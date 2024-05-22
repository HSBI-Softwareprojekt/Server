<?php
echo "<b>Login Test 1</b><br>";
echo "Benutzername: <br>";
echo "Passwort: <br>";
$_POST["USERNAME"] = "";
$_POST["PASSWORD"] = "";
include("../login.php");
echo "<br><br>";

echo "<b>Login Test 2</b><br>";
echo "Benutzername: Test<br>";
echo "Passwort: <br>";
$_POST["USERNAME"] = "Test";
$_POST["PASSWORD"] = "";
include("../login.php");
echo "<br><br>";

echo "<b>Login Test 3</b><br>";
echo "Benutzername: <br>";
echo "Passwort: P@ssw0rd<br>";
$_POST["USERNAME"] = "";
$_POST["PASSWORD"] = "P@ssw0rd";
include("../login.php");
echo "<br><br>";

echo "<b>Login Test 4</b><br>";
echo "Benutzername: Test123<br>";
echo "Passwort: P@ssw0rd123<br>";
$_POST["USERNAME"] = "Test123";
$_POST["PASSWORD"] = "P@ssw0rd123";
include("../login.php");
echo "<br><br>";

echo "<b>Login Test 5</b><br>";
echo "Benutzername: Test<br>";
echo "Passwort: P@ssw0rd<br>";
$_POST["USERNAME"] = "Test";
$_POST["PASSWORD"] = "P@ssw0rd";
include("../login.php"); ?>