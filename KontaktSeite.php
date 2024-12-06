<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Immobilien</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
  <link rel="stylesheet" href="stylesKontSeit.css">

</head>
<body style="background: transparent;">
    <main class="py-5">
        
            <header class="mb-5">
              <h1>Wie können wir Ihnen helfen?</h1>

            </header>

            <!-- Kontakt Form -->
            <div class="kontaktform-container">

                <form action="send.php" method="post" id="KontaktForm">
                    
                    <input type="text" name="Name" placeholder="Name" required />
                    <input type="email" name="email" placeholder="email" required />
                    <input type="telefon" name="telefon" placeholder="telefon"/>
                    <textarea name="RESULT_TextArea-5" class="text_field" rows="7" cols="50"></textarea>
                <!--<npuit type="text" name="Nachricht" placeholder="Schreiben Sie bitte Ihre Nachricht" required />-->

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
              
                </form>
            </div>
                


            
        
    </main>
  
</body>
</html>