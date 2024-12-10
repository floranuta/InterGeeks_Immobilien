<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Favorites</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
</head>
<body>
    <!-- Page Container -->
    <div class="container">
        <h1>My Favorite Listings</h1>
        
        <!-- Favorites Grid -->
        <div class="favorites-grid">
            <?php
            include 'favoriten.php'; // Include the database logic file

            // Check if there are any favorites
            if (count($favorites) > 0) {
                // Loop through the fetched favorites and display them
                foreach ($favorites as $favorite) {
                    echo '<div class="favorite-item">';
                    echo '<img src="' . htmlspecialchars($favorite['BildLink']) . '" alt="Item Image" class="item-image">';
                    echo '<div class="item-details">';
                    echo '<p class="item-title">User ID: ' . htmlspecialchars($favorite['NutzerID']) . '</p>';
                    echo '<p class="item-description">Apartment ID: ' . htmlspecialchars($favorite['WohnungId']) . '</p>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                // Message if no favorites are found
                echo '<p>No favorites found.</p>';
            }
            ?>
        </div>
    </div>
</body>
</html>
