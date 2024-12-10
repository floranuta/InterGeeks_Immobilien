<?php
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
$sql = "SELECT favoriten.NutzerID, favoriten.WohnungId, bilder.BildLink, wohnungen.Stadt, wohnungen.Adresse, 
        wohnungen.Wohnflaeche, wohnungen.Kaltmiete, wohnungen.Zimmerzahl 
        FROM favoriten
        INNER JOIN bilder ON favoriten.WohnungId = bilder.WohnungId
        INNER JOIN wohnungen ON favoriten.WohnungId = wohnungen.WohnungId";

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
    <title>Favorites</title>
    <style>
        .property-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .property-image img {
            width: 100%;
            height: auto;
        }
        .property-info {
            padding: 15px;
        }
        .property-title {
            font-weight: bold;
            font-size: 18px;
            margin-bottom: 10px;
        }
        .property-details span {
            display: inline-block;
            margin-right: 15px;
        }
        .favorite-heart-container {
            position: relative;
            display: inline-block;
            margin-bottom: 10px;
        }
        .tooltip {
            display: none;
            position: absolute;
            bottom: 100%;
            left: 200%;
            transform: translateX(-50%);
            background-color: #ffcc00;
            color: #fff;
            padding: 5px;
            border-radius: 5px;
            font-size: 12px;
            white-space: nowrap;
            z-index: 10;
            opacity: 0;
            transition: opacity 0.2s;
        }
        .favorite-heart-container:hover .tooltip {
            display: block;
            opacity: 1;
        }
        .favorite-heart {
            color: red;
            font-size: 20px;
            cursor: pointer;
        }
        .location-icon {
    color: #007bff; /* Blue color */
    margin-right: 5px;
}
.address-link {
    color: #007bff;
    text-decoration: none;
}
.address-link:hover {
    text-decoration: underline;
    color: #0056b3;
}
        
    </style>
</head>
<body>
<div class="container my-4">
    <h1>Meine Favoriten</h1>
    <div class="row">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
                <div class="col-md-4">
                    <div class="property-card">
                        <div class="property-image">
                            <img src="<?php echo htmlspecialchars($row['BildLink']); ?>" alt="Property Image">
                        </div>
                        <div class="property-info">
                            <div class="property-title">
                                <?php echo $row['Zimmerzahl']; ?>-Zimmer Wohnung in der Miete, <?php echo $row['Stadt']; ?>
                            </div>
                            <div class="favorite-heart-container">
                                <span class="favorite-heart" onclick="removeFavorite(<?php echo $row['WohnungId']; ?>)">&#10084;</span>
                                <span class="tooltip">Aus Favoriten entfernen</span>
                            </div>
                            <p>
                                <i class="fas fa-map-marker-alt location-icon"></i>
                                <a href="https://www.google.com/maps/search/?api=1&query=<?php echo urlencode($row['Adresse']); ?>" 
                                   target="_blank" 
                                   class="address-link">
                                    <?php echo htmlspecialchars($row['Adresse']); ?>
                                </a>
                            </p>
                            <div class="property-details">
                                <span>Wohnfläche: <?php echo $row['Wohnflaeche']; ?>m²</span>
                                <span>Kaltmiete: <?php echo $row['Kaltmiete']; ?>€</span>
                                <span>Zimmer: <?php echo $row['Zimmerzahl']; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "<p>No favorites found.</p>";
        }
        ?>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>

<script>
    // JavaScript function to handle removing from favorites
    function removeFavorite(wgId) {
        if (confirm('Are you sure you want to remove this listing from your favorites?')) {
            // Make an AJAX request to remove the favorite
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "remove_favorite.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Reload the page to reflect the changes
                    window.location.reload();
                }
            };
            xhr.send("WohnungId=" + wgId);
        }
    }
</script>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
