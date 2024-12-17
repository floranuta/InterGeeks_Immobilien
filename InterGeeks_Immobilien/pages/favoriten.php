<?php
session_start();

// Set user_id in session
$_SESSION['user_id'] = 1;
$nutzerId = $_SESSION['user_id']; // Session for logged-in user

// Database configuration
$host = 'localhost';       // Database host
$username = 'root';         // Database username
$password = '';             // Database password
$database = 'immobilien_db'; // Database name

// Create a database connection
$conn = new mysqli($host, $username, $password, $database);

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the "favoriten", "bilder", and "wohnungen" tables
$sql = "SELECT favoriten.NutzerID, favoriten.WohnungId, GROUP_CONCAT(bilder.BildLink) AS BildLinks, wohnungen.Stadt, wohnungen.Adresse, 
        wohnungen.Wohnflaeche, wohnungen.Kaltmiete, wohnungen.Zimmerzahl 
        FROM favoriten
        INNER JOIN bilder ON favoriten.WohnungId = bilder.WohnungId
        INNER JOIN wohnungen ON favoriten.WohnungId = wohnungen.WohnungId
        GROUP BY favoriten.WohnungId";

// Execute the query and store the result
$result = $conn->query($sql);

// Start HTML output
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="../styles/favoriten_styles.css" rel="stylesheet">
    <title>Favorites</title>
</head>
<header>
<?php
// This line includes the "header1.php" file from the "../includes" directory.
include("../includes/header1.php");
?>
</header>
<body>

<!-- A full-width container that spans the entire width of the viewport -->
<div class="container-fluid">
    <h1 class="favorites-title">Meine Favoriten</h1>
    <div class="row">
    <?php
    if ($result->num_rows > 0) {
        $swiperIndex = 0; // Index for uniqueness
        while ($row = $result->fetch_assoc()) {
            $images = explode(',', $row['BildLinks']);
            ?>
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">                         
    <!-- Wrapper for each property card -->
    <div class="property-card">
        <!-- Swiper container for the image slider -->
        <div class="swiper-container swiper-<?php echo $swiperIndex; ?>">
            <div class="swiper-wrapper">
                <!-- Loop through the images and create a slide for each image -->
                <?php foreach ($images as $image) { ?>
                    <div class="swiper-slide">
                        <!-- Display the image securely by escaping special characters -->
                        <img src="<?php echo htmlspecialchars($image); ?>" alt="Property Image">
                    </div>
                <?php } ?>
            </div>
            <!-- Swiper pagination for navigation dots -->
            <div class="swiper-pagination swiper-pagination-<?php echo $swiperIndex; ?>"></div>
            <!-- Swiper navigation buttons -->
            <div class="swiper-button-next swiper-button-next-<?php echo $swiperIndex; ?>"></div>
            <div class="swiper-button-prev swiper-button-prev-<?php echo $swiperIndex; ?>"></div>
        </div>
        <!-- Section containing property details -->
        <div class="property-info">
            <!-- Title and link to the property's description page -->
            <div class="property-title">
                <a href="Beschreibung.php?WohnungId=<?php echo $row['WohnungId']; ?>">
                    <?php echo $row['Zimmerzahl']; ?> - Zimmerhaus zu vermieten, <?php echo $row['Stadt']; ?>
                </a>
            </div>
            <!-- Favorite heart icon to remove the property from favorites -->
            <div class="favorite-heart-container">
                <span class="favorite-heart" onclick="removeFavorite(<?php echo $row['WohnungId']; ?>)">&#10084;</span>
                <span class="tooltip">Aus Favoriten entfernen</span>
            </div>
            <!-- Display the property's address as a clickable link to Google Maps -->
            <p>
                <i class="fas fa-map-marker-alt location-icon"></i>
                <a href="https://www.google.com/maps/search/?api=1&query=<?php echo urlencode($row['Adresse']); ?>" 
                   target="_blank" 
                   class="address-link">
                    <?php echo htmlspecialchars($row['Adresse']); ?>
                </a>
            </p>
            <!-- Additional details about the property -->
            <div class="property-details">
                <span>Living Area: <?php echo $row['Wohnflaeche']; ?>m²</span>
                <span>Rent: <?php echo $row['Kaltmiete']; ?>€</span>
                <span>Rooms: <?php echo $row['Zimmerzahl']; ?></span>
            </div>
        </div>
    </div>
</div>
<script>
    // Initialize the Swiper component for the current property card
    document.addEventListener('DOMContentLoaded', function () {
        new Swiper('.swiper-<?php echo $swiperIndex; ?>', {
            loop: true, // Enable infinite scrolling
            navigation: {
                nextEl: '.swiper-button-next-<?php echo $swiperIndex; ?>',
                prevEl: '.swiper-button-prev-<?php echo $swiperIndex; ?>',
            },
            pagination: {
                el: '.swiper-pagination-<?php echo $swiperIndex; ?>',
                clickable: true, // Make pagination dots clickable
            },
        });
    });
</script>
<?php
// Increment the swiper index to ensure unique class names for multiple property cards
$swiperIndex++;
}
} else {
    // Display a message if there are no favorites
    echo "<p>No favorites found.</p>";
}
?>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
<script>
    // Function to remove a property from the user's favorites
    function removeFavorite(wgId) {
        if (confirm('Are you sure you want to remove this listing from your favorites?')) {
            var xhr = new XMLHttpRequest(); // Create a new AJAX request
            xhr.open("POST", "remove_favorite.php", true); // Set the request to POST
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); // Set the content type
            xhr.onreadystatechange = function () {
                // Reload the page when the request completes successfully
                if (xhr.readyState == 4 && xhr.status == 200) {
                    window.location.reload();
                }
            };
            // Send the request with the WohnungId parameter
            xhr.send("WohnungId=" + wgId);
        }
    }
</script>
<?php 
// This line includes the "footer1.php" file from the "../includes" directory.
include("../includes/footer1.php"); 
?>
</body>
</html>
<?php
// Close the database connection
$conn->close();
?>
