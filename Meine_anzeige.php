<?php
/*/ Datenbankverbindung herstellen
$host = "localhost";
$username = "root";
$password = "vovaMySQL707";
$database = "immobilien_db";

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die('Die Verbindung zur Datenbank konnte nicht aufgebaut werden: ' . $conn->connect_error);
}

session_start();
$nutzerId = $_SESSION['nutzerId']; // Session für eingeloggten Nutzer

// Anzeigen abrufen
$sql = "SELECT * FROM Wohnungen WHERE NutzerId = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $nutzerId);
$stmt->execute();
$result = $stmt->get_result();

$anzeigen = [];
while ($row = $result->fetch_assoc()) {
    $anzeigen[] = $row;
}

header('Content-Type: application/json');
echo json_encode($anzeigen);*/
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Meine Anzeigen</title>
</head>
<body>
    <div id="anzeigen-container"></div>
    <button id="neue-anzeige">Neue Anzeige hinzufügen</button>
    <div id="anzeige-form-container" class="hidden">
        <form id="anzeige-form">
            <input type="hidden" id="WohnungId">
            <label>Stadt: <input type="text" id="Stadt"></label>
            <label>Postleitzahl: <input type="text" id="Postleitzahl"></label>
            <label>Adresse: <input type="text" id="Adresse"></label>
            <label>Zimmerzahl: <input type="number" id="Zimmerzahl"></label>
            <label>Wohnfläche: <input type="number" id="Wohnfläche"></label>
            <label>Etage: <input type="number" id="Etage"></label>
            <label>Kaltmiete: <input type="number" id="Kaltmiete"></label>
            <label>Nebenkosten: <input type="number" id="Nebenkosten"></label>
            <label>Kaution: <input type="number" id="Kaution"></label>
            <label>Titel: <input type="text" id="Titel"></label>
            <label>Beschreibung: <textarea id="Beschreibung"></textarea></label>
            <label>Haustiere: <input type="text" id="Haustiere"></label>
            <label>Baujahr: <input type="number" id="Baujahr"></label>
            <button type="submit">Speichern</button>
            <button type="button" id="abbrechen">Abbrechen</button>
        </form>
    </div>
    <script src="scripts.js"></script>
</body>
</html>
