<?php 

include 'db_verbindung.php';// include Datenbankverbindung


if (isset($_POST['query']) && !empty($_POST['query'])) {
    $query = $_POST['query'];

    // Count matching rows
    $sql = "SELECT COUNT(*) AS total FROM wohnungen WHERE Stadt = '$query'";
    $result = $conn->query($sql);

    if ($result) {
        $row = $result->fetch_assoc();
        echo "Es gibt " . $row['total'] . " " ."Wohnungen in ". htmlspecialchars($query);
    } else {
        echo "No results found.";
    }

    $conn->close();
}
?>