<?php
include 'php/db_verbindung.php'; // include Datenbankverbindung
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Header with CSS Grid</title>
    <link rel="stylesheet" href="css/header.css">
</head>
<body>
<header class="header">
    <!-- Column 1: Logo -->
    <div class="logo-container">
        <div class='logo-circle'>
            <img src="img/wohnung_logo.jpg" alt="Website Logo" class="logo">
        </div>
    </div>

    <!-- Column 2: Navigation Buttons -->
    <nav class="nav-buttons">
        <a href="home.html" class="nav-link">Home</a>
        <a href="about.html" class="nav-link">About Us</a>
        <a href="services.html" class="nav-link">Services</a>
        <a href="contact.html" class="nav-link">Contact</a>
    </nav>

    <!-- Column 3: Icons -->
    <div class="icons-container">
        <a href="favorites.html" class="icon favorite">
            <div class="icon-circle">♡</div>
            <span class="icon-label">Favorite</span>
        </a>
        <a href="login.html" class="icon login">
            <div class="icon-circle">&#128105;</div>
            <span class="icon-label">Login</span>
        </a>
    </div>
</header>
</body>
</html>