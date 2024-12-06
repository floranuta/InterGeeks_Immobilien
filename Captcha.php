<?php
    session_start(); // Starten einer Sitzung, um auf gespeicherte Daten zuzugreifen

    // Prüfung auf dem Server

    if ($SERVER['REQUEST_METHOD'] === 'POST') {
        $user_captcha = intval($_POST['captcha']); // Benutzerergebnis
        $correct_captcha = intval($_POST['captcha_result']); // erwartetes Ergebnis

        if ($user_captcha === $correct_captcha) {
            echo "Richtig!";            
        } else {
            echo "Nicht richtig. Noch Mal!";
        }

        // Löschen eines Werts in einer Sitzung, um eine Wiederverwendung zu verhindern
        unset($_SESSION['captcha_result']);
    }
?>

