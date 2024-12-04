<?php
$host = "localhost";
$username = "root";
$password = "vovaMySQL707";
$database = "immobilien_db";

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die('Die Verbindung zur Datenbank konnte nicht aufgebaut werden: ' . $conn->connect_error);
}

session_start();
$nutzerId = $_SESSION['nutzerId'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $daten = json_decode(file_get_contents('php://input'), true);
    
    if (isset($daten['WohnungId'])) { // Bearbeiten
        $sql = "UPDATE Wohnungen SET Stadt = ?, Postleitzahl = ?, Adresse = ?, Zimmerzahl = ?, Wohnfläche = ?, Etage = ?, Kaltmiete = ?, Nebenkosten = ?, Kaution = ?, Titel = ?, Beschreibung = ?, Haustiere = ?, Baujahr = ? WHERE WohnungId = ? AND NutzerId = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "sssiddddddssiii",
            $daten['Stadt'],
            $daten['Postleitzahl'],
            $daten['Adresse'],
            $daten['Zimmerzahl'],
            $daten['Wohnfläche'],
            $daten['Etage'],
            $daten['Kaltmiete'],
            $daten['Nebenkosten'],
            $daten['Kaution'],
            $daten['Titel'],
            $daten['Beschreibung'],
            $daten['Haustiere'],
            $daten['Baujahr'],
            $daten['WohnungId'],
            $nutzerId
        );
    } else { // Hinzufügen
        $sql = "INSERT INTO Wohnungen (Stadt, Postleitzahl, Adresse, Zimmerzahl, Wohnfläche, Etage, Kaltmiete, Nebenkosten, Kaution, Titel, Beschreibung, Haustiere, Baujahr, NutzerId) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "sssiddddddssii",
            $daten['Stadt'],
            $daten['Postleitzahl'],
            $daten['Adresse'],
            $daten['Zimmerzahl'],
            $daten['Wohnfläche'],
            $daten['Etage'],
            $daten['Kaltmiete'],
            $daten['Nebenkosten'],
            $daten['Kaution'],
            $daten['Titel'],
            $daten['Beschreibung'],
            $daten['Haustiere'],
            $daten['Baujahr'],
            $nutzerId
        );
    }
    $stmt->execute();
    echo json_encode(["success" => true]);
}
?>
