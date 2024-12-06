<?php
// include Datenbankverbindung
include 'dbVerbindung.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <link rel='stylesheet' href=css/logo.css>
    <link rel='stylesheet' href=css/search.css>
</head>
<body> 
    <header>
        <div class='logo_container'>        
            <h1 calss='site_name'>Intergeeks Immobilien</h1>
            <img src="img/Imo.jpg" alt="Website Logo" class='logo'>
        </div>
        <div class='search'>
            <form class='search-form' action='search.php' method='post'>
                <input type='text' id="query" name='query' placeholder='Stadt...' required>
                <button type='submit'>search</button>
            </form>
            <?php
                include 'search.php';
            ?>
        </div>
                
    </header>  
</body>
</html>