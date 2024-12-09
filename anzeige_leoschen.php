<?php
header('Content-Type: application/json');

// Подключение к базе данных
$host = "localhost";
$username = "root";
$password = "vovaMySQL707";
$database = "immobilien_db";
$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "DB-Verbindungsfehler: " . $conn->connect_error]);
    exit;
}

// Получение данных запроса
$input = json_decode(file_get_contents("php://input"), true);

// Проверка действия
if (isset($input['action']) && $input['action'] === "delete" && isset($input['id'])) {
    $id = intval($input['id']);

    // Начинаем транзакцию для обеспечения целостности данных
    $conn->begin_transaction();
    try {
        // Удаление записей из таблицы bilder
        $stmtBilder = $conn->prepare("DELETE FROM bilder WHERE WohnungId = ?");
        $stmtBilder->bind_param("i", $id);
        if (!$stmtBilder->execute()) {
            throw new Exception("Fehler beim Löschen aus der Tabelle 'bilder': " . $stmtBilder->error);
        }

        // Удаление записи из таблицы Wohnungen
        $stmtWohnungen = $conn->prepare("DELETE FROM Wohnungen WHERE WohnungId = ?");
        $stmtWohnungen->bind_param("i", $id);
        if (!$stmtWohnungen->execute()) {
            throw new Exception("Fehler beim Löschen aus der Tabelle 'Wohnungen': " . $stmtWohnungen->error);
        }

        // Если все запросы успешны, подтверждаем транзакцию
        $conn->commit();
        echo json_encode(["success" => true, "message" => "Anzeige und zugehörige Bilder erfolgreich gelöscht."]);
    } catch (Exception $e) {
        // В случае ошибки откатываем изменения
        $conn->rollback();
        echo json_encode(["success" => false, "message" => $e->getMessage()]);
    } finally {
        $stmtBilder->close();
        $stmtWohnungen->close();
    }

    $conn->close();
    exit;
}

// Если запрос некорректный
echo json_encode(["success" => false, "message" => "Ungültige Anfrage."]);
$conn->close();
exit;
?>
