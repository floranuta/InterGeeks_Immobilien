<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favorites</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <div class="title">Favorites</div>
        <div class="favorites-grid">
            <?php
            include 'favoriten.php'; // Include the database logic file

            // Loop through the fetched favorites
            foreach ($favorites as $favorite) {
                echo '<div class="favorite-item">';
                echo '<img src="' . htmlspecialchars($favorite['BildLink']) . '" alt="Item Image" class="item-image">';
                echo '<div class="item-details">';
                echo '<a href="#" class="item-title">Nutzer ID: ' . htmlspecialchars($favorite['NutzerID']) . '</a>';
                echo '<div class="item-description">Wohnung ID: ' . htmlspecialchars($favorite['WohnungId']) . '</div>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</body>
</html>

