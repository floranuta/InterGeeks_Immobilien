<!DOCTYPE html>

 <!--   <link rel="stylesheet" href="styles.css"> -->
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <link rel="stylesheet" href="../styles/Meine_Anzeige_styles.css"> 
    <title>Meine Anzeigen</title>
</head>
<header>
<?php
include("../includes/header1.php");

?>

</header>
<body>
    <div id="anzeigen-container"></div>
    <button id="neue-anzeige">Neue Anzeige hinzufügen</button>
    <div id="anzeige-form-container" class="hidden">
        <form id="anzeige-form" enctype="multipart/form-data" >
            <img src="" alt="Bild" id="BildLink-preview" style="width: 200px; height: auto;">
            <input type="hidden" name="WohnungId" id="WohnungId">
            <label>Stadt: <input type="text" name="Stadt" id="Stadt"></label>
            <label>Postleitzahl: <input type="text" name="Postleitzahl" id="Postleitzahl"></label>
            <label>Adresse: <input type="text" name="Adresse" id="Adresse"></label>
            <label>Zimmerzahl: <input type="number" name="Zimmerzahl" id="Zimmerzahl"></label>
            <label>Wohnfläche: <input type="number" name="Wohnflaeche" id="Wohnflaeche"></label>
            <label>Etage: <input type="number" name="Etage" id="Etage"></label>
            <label>Kaltmiete: <input type="number" name="Kaltmiete" id="Kaltmiete"></label>
            <label>Nebenkosten: <input type="number" name="Nebenkosten" id="Nebenkosten"></label>
            <label>Kaution: <input type="number" name="Kaution" id="Kaution"></label>
            <label>Titel: <input type="text" name="Titel" id="Titel"></label>
            <label>Beschreibung: <textarea name="Beschreibung" id="Beschreibung"></textarea></label>
            <label>Haustiere: <input type="text" name="Haustiere" id="Haustiere"></label>
            <label>Baujahr: <input type="number" name="Baujahr" id="Baujahr"></label>
            <label>Wohnungstype: <input type="number" name="Wohnungstype" id="Wohnungstype"></label>
            
            <label>Bild: <input type="file" id="file-input" name="file-input"></label>
           
      <!--       <input type="hidden" name="BildLink" id="BildLink">-->

            <button type="submit">Speichern</button>
            <button type="button" id="abbrechen">Abbrechen</button>
            </form>
    <!--     <form id="file-form" method="post" enctype="multipart/form-data">
           
        </form>-->
    </div>
    <script src="../js/Meine_Anzeige_script.js"></script>
</body>

<footer>
<?php
include("../includes/footer1.php");

?>

</footer>

</html>
