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
    return $conn;
}
}
function isFavorite($conn, $user_id, $wohnungId){
    $Favoriten = [];
    $query="SELECT WohnungId FROM favoriten WHERE NutzerId = $user_id";
    $result = $conn->query($query);
    if ($result === false) {
        // Обработка ошибки
        echo "<script>console.log('{$conn->error}');</script>" ;
    } else {
    if($result->num_rows > 0) {
      while($row =$result->fetch_assoc()) {
        array_push($Favoriten, $row['WohnungId']);
        echo   "<script>console.log('{$row['WohnungId']}');</script>";
      }
    }
    }
    $isFavorit = false;
    if(in_array($wohnungId, $Favoriten)){
        $isFavorit = true;
        echo "<script>console.log('Favorit');</script>";
    }
    else{
        echo "<script>console.log('Nicht Favorit');</script>";
    }
    return $isFavorit;
}
function getBeschreibung($conn, $wohnungId){
    $Beschreibung = [];
    $query="SELECT * FROM wohnungen WHERE WohnungId = $wohnungId";
    $result = $conn->query($query);
    if($result->num_rows > 0) {
      while($row =$result->fetch_assoc()) {
        $Beschreibung = $row;
      }
    }
    return $Beschreibung;
}
function getBilder($conn, $wohnungId){
    $Bilder = [];
    $query="SELECT * FROM bilder WHERE WohnungId = $wohnungId";
    $result = $conn->query($query);
    if($result->num_rows > 0) {
      while($row =$result->fetch_assoc()) {
        array_push($Bilder, $row['BildLink']);
      }
    }
    return $Bilder;
}
?>