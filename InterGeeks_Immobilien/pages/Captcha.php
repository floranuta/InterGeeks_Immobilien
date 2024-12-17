<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Обязательные поля
    $name = trim($_POST['Name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $nachricht = trim($_POST['nachricht'] ?? '');
    $user_captcha = intval($_POST['captcha']);
    $correct_captcha = intval($_SESSION['captcha_result']);

    unset($_SESSION['captcha_result']); // Удаление CAPTCHA

    // Проверка на заполненность
    if (empty($name) || empty($email) || empty($nachricht)) {
        $message = "Bitte füllen Sie alle erforderlichen Felder aus.";
        $redirect = "../pages/KontaktSeite.php"; // Вернуться на контактную страницу
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) { // Проверка Email
        $message = "Bitte geben Sie eine gültige Email-Adresse ein.";
        $redirect = "../pages/KontaktSeite.php";
    } elseif ($user_captcha !== $correct_captcha) { // Проверка CAPTCHA
        $message = "Etwas ist schief gelaufen, versuchen Sie es noch einmal!";
        $redirect = "../pages/KontaktSeite.php";
    } else {
        $message = "Vielen Dank für Ihre Anfrage!";
        $redirect = "../index.php";
    }

    // HTML-Ausgabe
    echo "<!DOCTYPE html>
<html lang='de'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Weiterleitung...</title>
    <style>
        body {
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f0f0;
            font-family: Arial, sans-serif;
        }
        .message {
            font-size: 2rem;
            font-weight: bold;
            text-align: center;
            color: #333;
        }
        @media (max-width: 768px) {
            .message { font-size: 1.5rem; }
        }
        @media (max-width: 480px) {
            .message { font-size: 1.2rem; }
        }
    </style>
</head>
<body>
    <div class='message'>$message</div>
    <script>
        setTimeout(() => { window.location.href = '$redirect'; }, 5000);
    </script>
</body>
</html>";
    exit;
}
?>
