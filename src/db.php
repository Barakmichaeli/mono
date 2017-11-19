<?php
$host = "localhost";
$username = "root";
$pass = '12345678';
$db = 'accounts';
$port = "3306";

$mysqli = new mysqli($host, $username, $pass, $db, $port);
//Check if mysqli object property string is
if ($mysqli->connect_error) {
    die("ERROR WHILE Connecting to the DB" . $mysqli->connect_error);
}
?>