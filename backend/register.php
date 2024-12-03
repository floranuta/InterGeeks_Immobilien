<?php
include 'db_config.php';

// Überprüfen, ob die Anfrage POST ist
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    
// SQL-Abfrage zum Hinzufügen eines Benutzers
    $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
    $stmt = $conn->prepare($sql);

    try {
        $stmt->execute(['email' => $email, 'password' => $hashed_password]);
        echo json_encode(['message' => 'Anmeldung erfolgreich!']);
    } catch (PDOException $e) {
        echo json_encode(['message' => 'eine Fehler: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['message' => 'Falsche Anfragemethode']);
}
?>
