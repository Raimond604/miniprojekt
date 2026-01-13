<?php

date_default_timezone_set('Europe/Vilnius');

$servername = "localhost";       
$username = "root";
$password = "";
$dbname = "mini_projekt";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Błąd połączenia: " . $conn->connect_error);
}

?>
