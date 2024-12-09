<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beschreibung</title>
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
    let isFavorite = <?php echo json_encode($isFavorit); ?>;
    const NutzerId = <?php echo json_encode($user_id); ?>;
    const WohnungId = <?php echo json_encode($wohnungId); ?>;
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
<div class="content-wrapper">
        <div class="container">
            <!-- Title -->
            <h1>Wohnung zur Miete</h1>

            <!-- Price Section -->
            <div class="price-section">
                <p>549€ Kaltmiete zzg Nebenkosten 100€</p>
                <p>Kaution 1000€</p>
            </div>

            <!-- Features Section -->
            <div class="features-section">
                <div class="feature"><strong>3</strong> Zimmer</div>
                <div class="feature"><strong>53,5</strong> Wohnfläche</div>
                <div class="feature"><strong>3.</strong> Geschoss</div>
            </div>

            <!-- Address Section -->
            <div class="address-section">
                <h2>Adresse</h2>
            </div>

            <!-- Description Section -->
            <div class="description-section">
                <h3>Objektbeschreibung</h3>
                <p>Hohe Altbauwohnung, sehr nette Hausbewohner, bunt gemischt: Senioren, Singles, Paare, WGs</p>

                <h3>Raumaufteilung</h3>
                <p>Helle, hohe Räume, 3 Zimmer, Große Küche mit Einbauküche, großes Bad mit Fenster и Dusche, viel Platz für Waschmaschine und Trockner, Gäste-WC, große Flur - alles neu saniert, Holzdielen, Fenster neu, teils fest eingebaute Insektenschutzgitter, Kellerraum mit festem Regal.</p>
            </div>
        </div>

        <!-- Contact Section -->
        <div class="contact-section">
            <div class="contact-header">
                <div class="profile-pic">
                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
    <path d="M0 0h24v24H0z" fill="none"/>
    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
</svg>
                </div>
                <h3>Henri Müller</h3>
            </div>
            <div class="contact-info">
                <button>Email</button>
            <div class="contact-info">
                <button>Telefonnummer</button>
                </div>   
            </div>
        </div>
    </div>
    
</main>

<?php include 'footer.php'; ?>
</body>
</html>