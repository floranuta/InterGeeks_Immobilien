<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel='stylesheet' href=css/test2.css>
</head>
<body>
<header class="header">
    <div class="header-column logo-container">
        <img src="img/wohnung_logo.jpg" alt="Website Logo" class="logo">
    </div>

    <div class="header-column search-nav-container">
        <form class="search-form" action="search.php" method="post">
            <input type="text" id="query" name="query" placeholder="Search..." required>
            <button type="submit">Search</button>
        </form>
        <nav class="nav-buttons">
            <button onclick="location.href='home.html'">Home</button>
            <button onclick="location.href='about.html'">About Us</button>
            <button onclick="location.href='contact.html'">Contact</button>
        </nav>
    </div>

    <div class="header-column sign-in-container">
        <button class="sign-in-button" onclick="location.href='login.html'">Sign In</button>
        <span class="favorite-icon" onclick="toggleFavorite()">
                ❤️
        </span>
    </div>    

</header>

</body>
</html>