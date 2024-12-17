<?php
// Datenbankverbindung herstellen
$host = "localhost";
$username = "root";
$password = "";
$database = "immobilien_db";

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die('Die Verbindung zur Datenbank konnte nicht aufgebaut werden: ' . $conn->connect_error);
}

session_start();

$_SESSION['user_id']=1;
$nutzerId = $_SESSION['user_id']; // Session für eingeloggten Nutzer



if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // prüfen ob id vorhanden ist
    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);
        $sql = "SELECT wohnungen.*, bilder.BildLink 
                FROM wohnungen 
                LEFT JOIN bilder ON bilder.WohnungId = wohnungen.WohnungId 
                WHERE wohnungen.WohnungId = ? AND  wohnungen.NutzerId = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $id, $nutzerId);
        $stmt->execute();
        $result = $stmt->get_result();
        $anzeige = $result->fetch_assoc();
        
        header('Content-Type: application/json');
        echo json_encode($anzeige);
    } else {
        // alle anzeigen
        $sql = "SELECT wohnungen.*, bilder.BildLink 
                FROM wohnungen 
                LEFT JOIN bilder ON bilder.WohnungId = wohnungen.WohnungId 
                WHERE NutzerId = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $nutzerId);
        $stmt->execute();
        $result = $stmt->get_result();

        $anzeigen = [];
        while ($row = $result->fetch_assoc()) {
            $anzeigen[] = $row;
        }

        header('Content-Type: application/json');
        echo json_encode($anzeigen);
    }
    exit;
}




?>

