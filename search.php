<?php 
// include Datenbankverbindung
include 'dbVerbindung.php';
 
// Get the search query
/*if (!empty($_POST['query'])){

$query = $_POST['query'];}*/
if (isset($_POST['query']) && !empty($_POST['query'])){
  $query=$_POST['query'];


// Fetch results
$sql = "SELECT * FROM wohnungen WHERE Stadt = '".$query."' ";
$result = $conn->query($sql);

// Display results
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    echo "<div>" . $row['Stadt'] . "</div>";
  }
} else {
  echo "No results found";
}

$conn->close();}
?>