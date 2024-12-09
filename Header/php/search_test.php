<?php
// Include database connection
include 'db_verbindung.php';

// Check if the form has been submitted and input is not empty
if (isset($_POST['query']) && !empty($_POST['query'])) {
    // Get the user input from the POST data
    $query = $_POST['query'];

    // Count how many times the city appears in the database
    $sql = "SELECT COUNT(*) AS total FROM wohnungen WHERE Stadt = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $query);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch and display the count
    if ($result && $row = $result->fetch_assoc()) {
        echo "You have " . $row['total'] . " " . htmlspecialchars($query);
    } else {
        echo "No results found.";
    }

    $stmt->close();
} else {
    echo "Please enter a city name.";
}

// Close the database connection
$conn->close();
?>
