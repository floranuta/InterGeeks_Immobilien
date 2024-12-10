<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profil</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <link rel="stylesheet" href="main.css">

</head>

<body>

  <!-- require_once "header.php"; -->
  <?php
  /*
        session_start();
        require "DB.php";  // connection zur DB
      
      // Prüfung authorization
        if (!isset($_SESSION['user_id'])) {
          // wenn nicht autorisiert -> start seite
          header("Location: login.php");
          exit;
        }

        $name = htmlspecialchars($_SESSION['name']);
        $email = htmlspecialchars($_SESSION['email']);
        */
  ?>


    <div class="welcome-banner">  
        <h2>Willkommen in Ihrem Profil</h2>
    </div>
    
    <div class="container">
      
            
    
    
    <div class="card-body">
      <h2> <?php //echo $name; ?>Name</h2>
      <p>Ihr Email: <?php //echo $email; ?></p>
      <a href="logout.php" class="btn-logout">Ausloggen</a>
    </div>

  </div>

  <div class="css-rlocds">
    <div>Hallo!</div>
    <div>Willkommen in deinem persönlichen Bereich</div>
  </div>


</body>

</html>