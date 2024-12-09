<?php

$mysqli = new mysqli('localhost', 'root', '', 'immobilien_db');

if ($mysqli->connect_error) {
    die("Ошибка подключения: " . $mysqli->connect_error);
}
echo "Успешное подключение!";




try {
    $pdo = new PDO('mysql:host=localhost;dbname=immobilien_db;port=3306', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "DB Fehler: " . $e->getMessage();
    exit;
}
?>