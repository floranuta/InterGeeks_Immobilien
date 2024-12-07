<?php
function ConnectDB() {
$host='localhost';
$username='root';
$password='';
$database='immobilien_db';
$conn=new mysqli($host,$username,$password,$database);
if ($conn->connect_error) {
 die("Verbindung fehlgeschlagen: ".$conn->connect_error) ; 
}
else {
    $message = "Erforglich verbunden";
    echo "<script>console.log('{$message}');</script>";
}
}
?>