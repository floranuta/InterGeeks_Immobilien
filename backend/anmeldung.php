<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $host = 'localhost';
    $db_name = 'immobilien_db';
    $username = 'root';
    $password = '';

    try {
        $conn = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Verbindungsfehler: " . $e->getMessage());
    }

    // Daten vom Formular empfangen
    $vorname = trim($_POST['vorname']);
    $nachname = trim($_POST['nachname']);
    $email = trim($_POST['email']);
    $kennwort = $_POST['kennwort'];

      // Per E-Mail auf Duplikate prüfen
    $query = "SELECT * FROM nutzer WHERE Email = :email";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo "<p style='color:red;'>Ein Benutzer mit dieser E-Mail-Adresse existiert bereits.</p>";
    } else {
        $hashed_password = password_hash($kennwort, PASSWORD_DEFAULT);
        var_dump($hashed_password);

        
        $query = "INSERT INTO nutzer (Vorname, Nachname, Email, Kennwort) 
                  VALUES (:vorname, :nachname, :email, :kennwort)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':vorname', $vorname);
        $stmt->bindParam(':nachname', $nachname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':kennwort', $hashed_password);

        if ($stmt->execute()) {
            // Einrichten einer Sitzung für einen neuen Benutzer
            $_SESSION['user_id'] = $conn->lastInsertId();
            $_SESSION['name'] = $vorname . " " . $nachname;
            $_SESSION['email'] = $email;

            header("Location: profile.php");
            exit;
        } else {
            echo "<p>Registrierungsfehler. Bitte versuchen Sie es später erneut.</p>";
        }
    }
}
?>

<!DOCTYPE html> 
<html lang="de"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Registrierung</title>
    <style>
        /* Пастельные цвета */
        body {
            
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            margin-top: 50px;
            padding: 20px;
        }

        .row {
            display: flex;
            justify-content: center;
        }

        .col-md-6 {
            width: 50%; /* Для установки карточки на 50% ширины экрана */
        }

        .card {
            background-color: #F0EAD2;  /* Пастельный светло-зеленый для карточки */
            border: 1px solid #6C584C; /* braun бордер */
            border-radius: 10px;
            padding: 20px;
        }

        .card-header {
            background-color: #A98467; /* Пастельный коричневый для шапки */
            color: #fff;
            border-radius: 10px 10px 0 0;
            padding: 10px;
            text-align: center;
        }

        .btn-submit {
            background-color: #6C584C; /* Темный коричневый для кнопки */
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            display: inline-block;
            text-decoration: none;
            width: 100%;
        }

        .btn-submit:hover {
            background-color: #A98467; /* Коричневый при наведении */
        }

        label {
            color: #6C584C; /* Темный коричневый для текста меток */
        }

        input {
            background-color: #F0EAD2; /* Пастельный бежевый фон для полей */
            border: 1px solid #6C584C; /* braun бордер */
            border-radius: 5px;
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
        }

        h1 {
            text-align: center;
            color: #6C584C; /* Темный коричневый для заголовка */
        }
    </style>
</head> 
<body> 
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2>Anmelden</h2>
                    </div>
                    <div class="card-body">
                        <form action="anmeldung.php" method="POST">
                            <label for="vorname">Vorname*</label>
                            <input type="text" id="vorname" name="vorname" required><br>

                            <label for="nachname">Nachname*</label>
                            <input type="text" id="nachname" name="nachname" required><br>

                            <label for="email">Email*</label>
                            <input type="email" id="email" name="email" required><br>

                            <label for="kennwort">Passwort*</label>
                            <input type="password" id="kennwort" name="kennwort" required><br>

                            <button type="submit" class="btn-submit">Registrieren</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body> 
</html>