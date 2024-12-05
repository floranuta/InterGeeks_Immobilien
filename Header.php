<?php
// connection to the database
$host = 'localhost';
$username = 'root';
$password = 'root';
$database = 'immobilien_db';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die('Die Verbindung zur Datenbank konnte nicht aufgebaut werden: ' . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <link rel='stylesheet' href=css/logo.css>
</head>
<body> 
    <header>
        <dev class='logo_container'>        
            <h1 calss='site_name'>Intergeeks Immobilien</h1>
            <img src="img/logoo.jpg" alt="Website Logo" class='logo'>
        </div>
    </header>  
</body>
</html>