<?php

// Daten aus den Formularelementen abrufen

$Name = $_POST['Name'];
$email = $_POST['email'];
$telefon = $_POST['telefon'];
$nachricht = $_POST['nachricht'];

// Umwandlung der erhaltenen Daten

$Name = htmlspecialchars($Name);  // Umwandlung von Zeichen in Entitäten
$email = htmlspecialchars($email);
$telefon = htmlspecialchars($telefon);
$nachricht = htmlspecialchars($nachricht);


$Name = urldecode($Name);   // Dekodierung URL
$email = urldecode($email);
$telefon = urldecode($telefon);
$nachricht = urldecode($nachricht);

$Name = trim(filter_var($Name, FILTER_SANITIZE_SPECIAL_CHARS));    // Entfernen von Leerzeichen an beiden Enden
$email = trim(filter_var($email, FILTER_VALIDATE_EMAIL));
$telefon = trim(filter_var($telefon, FILTER_VALIDATE_INT));
$nachricht = trim(filter_var($nachricht, FILTER_SANITIZE_SPECIAL_CHARS));



// Passwort ist mehr als 2 Zeichen lang und @ enthält

if (strlen($email) < 2 && str_contains($email, '@')) {
  echo "Email Fehler";
  exit;
}

// Кеширование password
/*  
      $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
  */

//Überprüfen, ob Daten fehlen
$nachricht = isset($_POST['nachricht']) ? $_POST['nachricht'] : '';

// Speichern die Nachricht in der DB

require "DB.php"; 

$sql = 'INSERT INTO nachrichtkontseite(Name, Email, Telefon, Nachricht) VALUES(?, ?, ?, ?)';
$query = $pdo->prepare($sql);
$query->execute([$Name, $email, $telefon, $nachricht]);

// Weiterleitung zur gewünschten Seite

// header('Location: /index.php');

// Daten per E-Mail senden

/* if (mail("honcharova.de@gmail.com",
          "Neue Nachricht von InterGeeks_Immobilien",
          "Name: ".$Name."\n".
          "email: ".$email."\n".
          "telefon: ".$telefon,
          "From: email@gmail.com \r\n"     )
      ) {
        echo ('E-Mail erfolgreich gesendet');
        } else {
        echo ('Es gibt Fehler. Bitte überprüfen Sie die Daten.');
  }  */
?>