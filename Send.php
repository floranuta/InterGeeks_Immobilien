<?php

  // Daten aus den Formularelementen abrufen

  $Name = $_POST['Name'];
  $email = $_POST['email'];
  $telefon =$_POST['telefon'];

  // Umwandlung der erhaltenen Daten

  $Name = htmlspecialchars($Name);  // Umwandlung von Zeichen in Entitäten
  $email = htmlspecialchars($email);
  $telefon = htmlspecialchars($telefon);


  $Name = urldecode($Name);   // Dekodierung URL
  $email = urldecode($email);
  $telefon = urldecode($telefon);

  $Name = trim($Name);    // Entfernen von Leerzeichen an beiden Enden
  $email = trim($email);
  $telefon = trim($telefon);


  // Daten per E-Mail senden

  if (mail("honcharova.de@gmail.com",
          "Neue Nachricht von InterGeeks_Immobilien",
          "Name: ".$Name."\n".
          "Email: ".$email."\n".
          "Telefon: ".$telefon,
          "From: email@gmail.com \r\n"     )
      ) {
        echo ('E-Mail erfolgreich gesendet');
        } else {
        echo ('Es gibt Fehler. Bitte überprüfen Sie die Daten.');
  }


?>