<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Immobilien</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
  <link rel="stylesheet" href="../styles/stylesKontSeit.css">

</head>
<body style="background: transparent;">

    <header>
        <?php 
        
        //include("../includes/header1.php");  
        ?>
      </header>

    <main class="py-3">
        
            <header class="mb-2">
              
              <h1>Wie können wir Ihnen helfen?</h1>

            </header>

            <!-- Kontakt Form -->
            <div class="kontaktform-container">

                <form method="POST" action="../pages/KSSend.php" id="KontaktForm">
                    
                    <input type="text" name="Name" placeholder="Name" required />
                    <input type="email" name="email" placeholder="Email" required />
                    <input type="telefon" name="telefon" placeholder="Ihre Telefonnummer"/>
                    <textarea type="nachricht" name="nachricht" class="text_field" rows="4" cols="50" placeholder="Ihre Nachricht" required></textarea>
                <!--<ipuit type="text" name="Nachricht" placeholder="Schreiben Sie bitte Ihre Nachricht" required />-->
                </form>
                    <!-- Captcha-->
                      <?php
                          session_start();

                      // Zufallszahlengenerierung
                        $num1 = rand(1, 10);
                        $num2 = rand(1, 10);
                        $_SESSION['captcha_result'] = $num1 + $num2;

                      ?>

                      <form method="post" action="Captcha.php">
                          <label for="captcha"> Wie viel wird es sein <?php echo $num1; ?> + <?php echo $num2; ?>?</label>
                          <input type="text" id="captcha" name="captcha" required>
                          <input type="hidden" name="captcha_result" value="<?php echo $captcha_result; ?>">
                          <button type="submit">Schicken</button>
                      </form>

                    <!-- <input type="submit" value="Abschicken" /> -->
              
                
            </div>
                


            
        
    </main>
  
</body>
</html>