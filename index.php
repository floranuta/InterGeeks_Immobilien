<?php
header("Cache-Control: no-store, no-cache, must-revalidate, proxy-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
?>
<?php session_start();
//$_SESSION["user_id"]=3; 
//unset($_SESSION['user_id']);
$nutzer = 0;

if (isset($_SESSION["user_id"])) {
    $nutzer = $_SESSION["user_id"];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/index.css?v=1.0">
    <link rel="stylesheet" href="styles/filter_bar.css?v=1.0">

    <title>Document</title>
</head>

<body id="body-main">


    <?php
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'immobilien_db';
    $conn = new mysqli($host, $username, $password, $database);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    $filters = [];
    $params = [];
    $types = "";
    $stadt = "";
    $min_zim_zahl = "";
    $min_wohnflaeche = "";
    $min_kaltmiete = "";
    $max_zim_zahl = "";
    $max_wohnflaeche = "";
    $max_kaltmiete = "";
    $favoriten = [];
    $color_like_btn = "";

    $favoriten_sql = "SELECT wohnungId FROM favoriten WHERE nutzerId = '" . $nutzer . "';";



    $result_fav = $conn->query($favoriten_sql);
    if ($result_fav->num_rows > 0) {
        while ($row_fav = $result_fav->fetch_assoc()) {
            $favoriten[] = $row_fav['wohnungId'];
        }
    }

    $sql = "SELECT wohnungId, titel,adresse,stadt,wohnflaeche,postleitzahl,kaltmiete,zimmerzahl FROM Wohnungen WHERE 1=1";

    ?>


    <?php

    if (!empty($_POST['stadt'])) {
        $stadt = $_POST['stadt'];
        $filters[] = "stadt LIKE ?";
        $params[] = "%" . $stadt . "%";
        $types .= "s";
    }
    if (!empty($_POST['min-kaltmiete'])) {
        $min_kaltmiete = $_POST['min-kaltmiete'];
        $filters[] = "kaltmiete >= ?";
        $params[] = (int)$min_kaltmiete;
        $types .= "i";
    }

    if (!empty($_POST['max-kaltmiete'])) {
        $max_kaltmiete = $_POST['max-kaltmiete'];
        $filters[] = "kaltmiete <= ?";
        $params[] = (int)$max_kaltmiete;
        $types .= "i";
    }

    if (!empty($_POST['min-wohnflaeche'])) {
        $min_wohnflaeche = $_POST['min-wohnflaeche'];
        $filters[] = "wohnflaeche >= ?";
        $params[] = (int)$min_wohnflaeche;
        $types .= "i";
    }

    if (!empty($_POST['max-wohnflaeche'])) {
        $max_wohnflaeche = $_POST['max-wohnflaeche'];
        $filters[] = "wohnflaeche <= ?";
        $params[] = (int)$max_wohnflaeche;
        $types .= "i";
    }
    if (!empty($_POST['min-zim-zahl'])) {
        $min_zim_zahl = $_POST['min-zim-zahl'];
        $filters[] = "zimmerzahl >= ?";
        $params[] = (int)$min_zim_zahl;
        $types .= "i";
    }

    if (!empty($_POST['max-zim-zahl'])) {
        $max_zim_zahl = $_POST['max-zim-zahl'];
        $filters[] = "zimmerzahl <= ?";
        $params[] = (int)$max_zim_zahl;
        $types .= "i";
    }
    if (!empty($filters)) {
        $sql .= " AND " . implode(" AND ", $filters);
        
    }

    $stmt = $conn->prepare($sql);

    if (!empty($params)) {
        $stmt->bind_param($types, ...$params);
    }
    
    $stmt->execute();



    ?>

    <div id="main-content-container">
        <div id="header-div">
            <?php include 'header.php'; ?>
        </div>
        <?php include 'includes/filter_bar.php'; ?>


        <!----------------------WohnungenList---------------------------------->


        <div class="scroll-list">
            <?php
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                $adress_param = urlencode(trim($row['adresse']) . ',+' . trim($row['postleitzahl']) . ',+' . trim($row['stadt']));
                $adress_url = "https://www.google.com/maps/place/" . $adress_param;
                if (in_array($row['wohnungId'], $favoriten)) {
                    $color_like_btn = "red";
                } else {
                    $color_like_btn = "orange";
                }
                echo '<div class="appartment-card" data-scroll="0">';

                $query_all_images = "SELECT BildLink,BildId  FROM Bilder WHERE wohnungId='" . $row['wohnungId'] . "' ORDER BY hauptbild DESC";
                
                $result2 = $conn->query($query_all_images);
                if ($result2->num_rows > 0) {
                    echo  '<div class="img-scroller-container">';
                    echo '<div class="img-inner-container">';
                    while ($row2 = $result2->fetch_assoc()) {
                        echo '<img src="' . $row2['BildLink'] . '" alt="image">';
                    }
                }
                echo '</div>';
                echo '<svg class="arrow-left arrow" onclick="scrollImageStrip(event)" xmlns="http://www.w3.org/2000/svg" height="80px" viewBox="0 -960 960 960" width="80px" fill="#173660"><path d="M576-240 336-480l240-240 51 51-189 189 189 189-51 51Z"/></svg>';
                echo '<svg class="arrow-right arrow" onclick="scrollImageStrip(event)" xmlns="http://www.w3.org/2000/svg" height="80px" viewBox="0 -960 960 960" width="80px" fill="#173660"><path d="M522-480 333-669l51-51 240 240-240 240-51-51 189-189Z"/></svg>';
                echo '<h1 class="count-scroll">1/' . $result2->num_rows . '</h1>';
                echo '</div>';
                echo '<div class="appartment-info">';
                echo '<a href="Beschreibung.php?wohnungId=' . $row['wohnungId'] . '"class="titel" target="blank"><h2>' . $row['titel'] . '</h2></a>';
                echo '<a href="' . $adress_url . '" target="blank" class="adresse">' . $row['postleitzahl'] . ' ' . $row['stadt'] . ', ' . $row['adresse'] . '</a>';
                echo '<div class="wohnfläche info-item">';
                echo '<p >Wohnfläche</p>';
                echo '<p>' . $row['wohnflaeche'] . 'm&sup2;</p>';
                echo '</div>';
                echo '<div class="kaltmiete info-item">';
                echo '<p>Kaltmiete</p>';
                echo '<p>' . $row['kaltmiete'] . '&euro;</p>';
                echo '</div>';
                echo '<div class="zim-zahl info-item">';
                echo '<p>Zim.</p>';
                echo '<p>' . $row['zimmerzahl'] . '</p>';
                echo '</div>';
                echo '<svg class="info-icon like-btn" onclick="manageFavourites(event)" data-wohnungId="' . $row['wohnungId'] . '" xmlns="http://www.w3.org/2000/svg" style="color:' . $color_like_btn . '" height="40px" viewBox="0 -960 960 960" width="30px" fill="currentColor"><path d="m480-144-50-45q-100-89-165-152.5t-102.5-113Q125-504 110.5-545T96-629q0-89 61-150t150-61q49 0 95 21t78 59q32-38 78-59t95-21q89 0 150 61t61 150q0 43-14 83t-51.5 89q-37.5 49-103 113.5T528-187l-48 43Zm0-97q93-83 153-141.5t95.5-102Q764-528 778-562t14-67q0-59-40-99t-99-40q-35 0-65.5 14.5T535-713l-35 41h-40l-35-41q-22-26-53.5-40.5T307-768q-59 0-99 40t-40 99q0 33 13 65.5t47.5 75.5q34.5 43 95 102T480-241Zm0-264Z"/></svg>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
    </div>
    </div>

    <div id="footer-div">
        <?php include 'footer.php'; ?>
    </div>






    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get the JSON data sent from JavaScript
        $data = json_decode(file_get_contents('php://input'), true);
        if (isset($_POST['wohnungId'])) {

            $add_to_favourite_sql = "INSERT INTO favoriten VALUES( '" . $nutzer . "','" . $_POST['wohnungId'] . "')";
            $delete_from_favourite_sql = "DELETE FROM favoriten WHERE nutzerId='" . $nutzer . "'&& wohnungId='" . $_POST['wohnungId'] . "'";

            if (!in_array($_POST['wohnungId'], $favoriten)) {
                if (!$conn->query($add_to_favourite_sql) === TRUE) {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            } else {
                if (!$conn->query($delete_from_favourite_sql) === TRUE) {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
            //header("Location: " . $_SERVER['PHP_SELF']); 
            //exit();  
        }
    }




    ?>
    <button id="scroll-up-btn"><svg xmlns="http://www.w3.org/2000/svg" height="48px" viewBox="0 -960 960 960" width="48px" fill="#FFFFFF">
            <path d="M480-554 283-357l-43-43 240-240 240 240-43 43-197-197Z" />
        </svg></button>




    <script src="js/index.js" defer></script>
</body>

</html>