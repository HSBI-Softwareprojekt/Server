<?php
echo "<b>Registrier Test 1</b><br>";
echo "E-Mail: <br>";
echo "Benutzername: <br>";
echo "Passwort: <br>";
echo "Passwort WD: <br>";
$_POST["EMAIL"] = "";
$_POST["USERNAME"] = "";
$_POST["PASSWORD"] = "";
$_POST["PASSWORD_WD"] = "";
include("../register.php");
echo "<br><br>";

echo "<b>Registrier Test 2</b><br>";
echo "E-Mail: Test@Test.de<br>";
echo "Benutzername: <br>";
echo "Passwort: <br>";
echo "Passwort WD: <br>";
$_POST["EMAIL"] = "Test@Test.de";
$_POST["USERNAME"] = "";
$_POST["PASSWORD"] = "";
$_POST["PASSWORD_WD"] = "";
include("../register.php");
echo "<br><br>";

echo "<b>Registrier Test 3</b><br>";
echo "E-Mail: Test@Test.de<br>";
echo "Benutzername: Test<br>";
echo "Passwort: <br>";
echo "Passwort WD: <br>";
$_POST["EMAIL"] = "Test@Test.de";
$_POST["USERNAME"] = "Test";
$_POST["PASSWORD"] = "";
$_POST["PASSWORD_WD"] = "";
include("../register.php");
echo "<br><br>";

echo "<b>Registrier Test 4</b><br>";
echo "E-Mail: Test@Test.de<br>";
echo "Benutzername: Test<br>";
echo "Passwort: P@ssw0rd<br>";
echo "Passwort WD: <br>";
$_POST["EMAIL"] = "Test@Test.de";
$_POST["USERNAME"] = "Test";
$_POST["PASSWORD"] = "P@ssw0rd";
$_POST["PASSWORD_WD"] = "";
include("../register.php");
echo "<br><br>";

echo "<b>Registrier Test 5</b><br>";
echo "E-Mail: Test@Test.de<br>";
echo "Benutzername: Test<br>";
echo "Passwort: <br>";
echo "Passwort WD: P@ssw0rd<br>";
$_POST["EMAIL"] = "Test@Test.de";
$_POST["USERNAME"] = "Test";
$_POST["PASSWORD"] = "";
$_POST["PASSWORD_WD"] = "P@ssw0rd";
include("../register.php");
echo "<br><br>";

echo "<b>Registrier Test 6</b><br>";
echo "E-Mail: Test@Test.de<br>";
echo "Benutzername: Test<br>";
echo "Passwort: P@ssw0rd<br>";
echo "Passwort WD: P@sswort<br>";
$_POST["EMAIL"] = "Test@Test.de";
$_POST["USERNAME"] = "Test";
$_POST["PASSWORD"] = "P@ssw0rd";
$_POST["PASSWORD_WD"] = "P@ssw0rt";
include("../register.php");
echo "<br><br>";

echo "<b>Registrier Test 7</b><br>";
echo "E-Mail: Test@Test.de<br>";
echo "Benutzername: Test<br>";
echo "Passwort: P@ssw0rd<br>";
echo "Passwort WD: P@ssw0rd<br>";
$_POST["EMAIL"] = "Test@Test.de";
$_POST["USERNAME"] = "Test";
$_POST["PASSWORD"] = "P@ssw0rd";
$_POST["PASSWORD_WD"] = "P@ssw0rd";
include("../register.php");
echo "<br><br>";

echo "<b>Registrier Test 8</b><br>";
echo "E-Mail: Test@Test.de<br>";
echo "Benutzername: Test<br>";
echo "Passwort: P@ssw0rd<br>";
echo "Passwort WD: P@ssw0rd<br>";
$_POST["EMAIL"] = "Test@Test.de";
$_POST["USERNAME"] = "Test";
$_POST["PASSWORD"] = "P@ssw0rd";
$_POST["PASSWORD_WD"] = "P@ssw0rd";
include("../register.php");
echo "<br><br>"; ?>