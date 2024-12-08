
<?php
include 'php/db_verbindung.php'; // include Datenbankverbindung
include 'php/search.php'; //search menu
?>

<script src='js/favorite.js' > </script> <!-- toggle the heart -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel='stylesheet' href=css/header.css>
</head>
<body>  
<header class="header">
    <!-- Column 1: Logo -->
    <div class="logo-container">
        <img src="img/wohnung_logo.jpg" alt="Logo" class="logo">
    </div>

    <!-- Column 2-3: Search Bar and Navigation Buttons -->
    <div class="search-nav-container">
        <!-- Search Bar -->
        <form class="search-form" action="php/search.php" method="post">
            <input type="text" id="query" name="query" placeholder="Search..." required>
            <button type="submit">Search</button>
        </form>
        
        <!-- Navigation Buttons -->
        <nav class="nav-buttons">
            <button onclick="location.href='home.html'">Home</button>
            <button onclick="location.href='about.html'">About Us</button>
            <button onclick="location.href='contact.html'">Contact</button>
            <button onclick="location.href='services.html'">Services</button>
        </nav>
    </div>

    <!-- Column 4: Favorite Button and Anmeldung -->
    <div class="auth-container">
        <span class="favorite-icon" onclick="toggleFavorite()">♡</span>
        <button class="sign-in-button" onclick="location.href='login.html'">Anmelden</button>
    </div>
    
</header>
    
</body>
</html>