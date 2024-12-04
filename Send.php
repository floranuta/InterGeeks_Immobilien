<?php

  // Daten aus den Formularelementen abrufen

  $Name = $_POST['Name'];
  $email = $_POST['email'];
  $tel =$_tel['tel'];

  // Umwandlung der erhaltenen Daten

  $Name = htmlspecialchars($Name);  // Umwandlung von Zeichen in Entitäten
  $email = htmlspecialchars($email);
  $tel = htmlspecialchars($tel);


  $Name = urldecode($Name);   // Dekodierung URL
  $email = urldecode($email);
  $tel = urldecode($tel);

  $Name = trim($Name);    // Entfernen von Leerzeichen an beiden Enden
  $email = trim($email);
  $tel = trim($tel);


  // Daten per E-Mail senden

  if (mail(honcharova.de@gmail.com,
          "Neue Nachricht von InterGeeks_Immobilien",
          "Name: ".$name."\n".
          "Email: ".$email."\n".
          "Telefon: ".$tel,
          "From: email@gmail.com \r\n"     )
      ) {
        echo ('E-Mail erfolgreich gesendet');
        }
  else {
        echo ('Es gibt Fehler. Bitte überprüfen Sie die Daten.')
  }


?>