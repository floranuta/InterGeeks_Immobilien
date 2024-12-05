<?php
session_start();


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

    $email = $_POST['email'];
    $input_password = $_POST['kennwort'];

    
    $query = "SELECT * FROM nutzer WHERE Email = :email";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
       
        if (password_verify($input_password, $user['Kennwort'])) {
           
            $_SESSION['user_id'] = $user['NutzerId'];
            $_SESSION['name'] = $user['Vorname'] . " " . $user['Nachname'];
            $_SESSION['email'] = $user['Email'];

            header("Location: profile.php");
            exit;
        } else {
            
            echo "<p>Ungültiges Passwort. Versuchen Sie es erneut.</p>";
        }
    } else {
        
        echo "<p>Ein Benutzer mit dieser E-Mail wurde nicht gefunden.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Einloggen</title>
    <style>
        /* Пастельные цвета */
        body {
            
            font-family: Arial, sans-serif;
        }

        .card {
            background-color: #F0EAD2; /* Пастельный светло-зеленый для карточки */
            border: 1px solid #ADC178; /* Зеленый бордер */
        }

        .card-header {
            background-color: #A98467; /* Пастельный коричневый для шапки */
            color: #fff; /* Белый цвет текста */
        }

        .btn-primary {
            background-color: #A98467; /* Пастельный коричневый для кнопки */
            border-color: #A98467;
        }

        .btn-primary:hover {
            background-color: #6C584C; /* Темный коричневый при наведении */
            border-color: #6C584C;
        }

        .form-control {
            background-color: #F0EAD2; /* Пастельный бежевый фон для полей */
            border: 1px solid #6C584C; /* Зеленый бордер для полей */
        }

        label {
            color: #6C584C; /* Пастельный темно-коричневый для текста меток */
        }
    </style>
</head>
<body>
   <form action="login.php" method="POST">
    <div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h4>Einloggen</h4>
                </div>
                <div class="card-body">
                    <form>
                        <div class="form-group">


        <label for="email">Email:</label>
        <input type="email"class="form-control" id="email" name="email" required placeholder="Geben Sie Ihren Benutzernamen ein"><br>
        </div>

        <div class="form-group">
        <label for="kennwort">Passwort:</label>
        <input type="password" class="form-control"  id="kennwort" name="kennwort" required placeholder="Geben Sie Ihr Passwort ein"><br>
        </div>
        <button type="submit"class="btn btn-primary btn-block">Login</button>
 </form>
                </div>
            </div>
        </div>
    </div>
</div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
