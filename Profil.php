<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Immobilien</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">

</head>
<body>
    <main class="py-5">
        <div class="container mb-5">
            <header class="mb-5">
              <h1>Kontakt Seite</h1>

            </header>

            <!-- Kontakt Form -->
            <form action="" method="post">
                <label>
                <input type="text" name="Name" placeholder="Name" required />
                <input type="email" name="email" placeholder="email" required />
                <input type="tel" name="tel" placeholder="tel"/>
                <textarea name="RESULT_TextArea-5" class="text_field" rows="7" cols="50"></textarea>
                <!--<npuit type="text" name="Nachricht" placeholder="Schreiben Sie bitte Ihre Nachricht" required />-->
                
                <label for="captcha">
                <input type="submit" name="Submit" value="Submit" class="submit_button" id="KSsubmit" disabled=""> <!-- zunächst deaktiviert -->
          
            </form>
            


            
        </div>
    </main>
  
</body>
</html>