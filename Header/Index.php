<?php
// include Datenbankverbindung
include 'php/db_verbindung.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <!--<link rel='stylesheet' href=css/logo.css>-->
    <!--<link rel='stylesheet' href=css/search.css>-->
    <!--<link rel='stylesheet' href=css/anmeldung.css>-->
    <link rel='stylesheet' href=css/header.css>
</head>
<body> 
    <header>
        <div class='logo_container'>        
            <!--<h1 calss='site_name'>Intergeeks Immobilien</h1>-->
            <img src='img/wohnung_logo.jpg' alt='Website Logo' class='logo'>
        </div>
        <div class='search'>
            <form class='search-form' action='php/search.php' method='post'>
                <input type='text' id="query" name='query' placeholder='Stadt...' required>
                <button type='submit'>search</button>
            </form>
            <?php
                include 'php/search.php';
            ?>            
        </div>
        
        <div class='anmelden'>
            <!--<img src='img/anmeldung.png' alt='Anmelen hier' class='icon'>-->            
            <a href="https://www.example.com" class="button-link">
                <button class="button" onclick="navigateTo('Anmelden')">Anmelen</button>
            </a>
        </div>
         
        <div>
            <nav class="nav-buttons">                
                <a href="https://www.example.com" class="button-link">
                    <button class="button" onclick="navigateTo('home')">Home</button>
                </a>
                
                <a href="https://www.example.com" class="button-link">
                    <button class="button" onclick="navigateTo('about-us')">About Us</button>
                </a>
                
                <a href="https://www.example.com" class="button-link">
                    <button class="button" onclick="navigateTo('contact')">Contact</button>
                </a>
            </nav>
        </div>     
    </header>  
</body>
</html>