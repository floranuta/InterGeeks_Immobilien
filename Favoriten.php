<?php
$host = 'localhost'; // Database host
$username = 'root'; // Database username
$password = ''; // Database password
$database = 'immobilien_db'; // Database name

// Create a database connection
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the "favoriten" and "bilder" tables
$sql = "SELECT favoriten.NutzerID, favoriten.WohnungId, bilder.BildLink 
        FROM favoriten
        INNER JOIN bilder ON favoriten.WohnungId = bilder.WohnungId";
$result = $conn->query($sql);

// Store the results in an array
$favorites = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $favorites[] = $row;
    }
}

// Close the database connection
$conn->close();
?>
