<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple PHP Page new</title>
    <link rel="stylesheet" href="beschreibung.css">
</head>
<body>

<?php include 'header.php'; ?>

<?php
include 'database.php'; 
$conn = ConnectDB();
//$user_id = $_SESSION['user_id'];
$user_id = 1;
$wohnungId = 1;
if(isset($_GET['wohnungId']))
{
    $wohnungId=$_GET['wohnungId'];
    }
$isFavorit = isFavorite($conn, $user_id, $wohnungId); //true or false
$Beschreibung = getBeschreibung($conn, $wohnungId); //array of fields of the apartment
$Bilder = getBilder($conn, $wohnungId); //array of images
?>
<!-- Embed PHP variables into JavaScript -->
<script>
    const images = <?php echo json_encode($Bilder); ?>;
    const isFavorite = <?php echo json_encode($isFavorit); ?>;
</script>
<script src="beschreibung.js"></script>
<main>
    <div class="rectangle">
        <div class="large">
            <img src="<?php echo $Bilder[0]; ?>" alt="Image 1" onclick="openModal(0)">
        </div>
        <div class="small-top">
            <img src="<?php echo $Bilder[1]; ?>" alt="Image 2" onclick="openModal(1)">
        </div>
        <div class="small-bottom">
            <img src="<?php echo $Bilder[2]; ?>" alt="Image 3" onclick="openModal(2)">
        </div>
    </div>
    <div class="button-container">
        <button type="button" aria-label="Copy link" class="btn1" onclick="copyLink()">
            <img src="img/clipboard.svg" alt="Copy link icon" class="svg-icon">
        </button>
        <button type="button" aria-label="Add to Favourites" class="btn2" onclick="anotherAction()">
            <img id="heart-icon" src="img/heart_unmarked.svg" alt="Another action icon" class="svg-icon">
        </button>
        <button type="button" aria-label="Print page" class="btn3" onclick="printPage()">
            <img src="img/print.svg" alt="Print page icon" class="svg-icon">
        </button>
    </div>
</main>

<!-- Modal Structure -->
<div id="myModal" class="modal">
    <span class="close" onclick="closeModal()">&times;</span>
    <img class="modal-content" id="img01">
    <a class="prev" onclick="changeImage(-1)">&#10094;</a>
    <a class="next" onclick="changeImage(1)">&#10095;</a>
</div>

<!-- Custom Modal Structure -->
<div id="customModal">
    <div class="content">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle">
            <path d="M9 11l3 3L22 4"></path>
            <path d="M22 12a10 10 0 1 1-10-10"></path>
        </svg>
        <p>Der Link wurde in der Zwischenablage gespeichert</p>
    </div>
</div>





<?php include 'footer.php'; ?>
</body>
</html>