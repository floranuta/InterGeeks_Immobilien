<?php
// connection to the database
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'immobilien_db';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die('Die Verbindung zur Datenbank konnte nicht aufgebaut werden: ' . $conn->connect_error);
}
?>