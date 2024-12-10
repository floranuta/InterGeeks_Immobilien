<?php
header("Cache-Control: no-store, no-cache, must-revalidate, proxy-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"  href="styles/index.css?v=1.0">
    <title>Document</title>
</head>
<body>


<?php 
$host='localhost';
$username='root';
$password='';
$database='immobilien_db';
$conn=new mysqli($host,$username,$password,$database);
//$nutzer=3;
$filters=[];
$params=[];
$types="";
$stadt="";
$min_zim_zahl="";
$min_wohnflaeche="";
$min_kaltmiete="";
$max_zim_zahl="";
$max_wohnflaeche="";
$max_kaltmiete="";

$sql="SELECT wohnungId, titel,adresse,stadt,wohnflaeche,postleitzahl,kaltmiete,zimmerzahl FROM Wohnungen WHERE 1=1";

 ?>


<?php 

if(!empty($_POST['stadt'])){
    $stadt=$_POST['stadt'];
    $filters[]="stadt LIKE ?";
    $params[]="%".$stadt."%";
    $types.="s";
    
    
    }
    if (!empty($_POST['min-kaltmiete'])) {
        $min_kaltmiete=$_POST['min-kaltmiete'];
        $filters[] = "kaltmiete >= ?";
        $params[] = (int)$min_kaltmiete;
        $types .="i"; 
        
    }
    
    if (!empty($_POST['max-kaltmiete'])) {
        $max_kaltmiete=$_POST['max-kaltmiete'];
        $filters[] = "kaltmiete <= ?";
        $params[] = (int)$max_kaltmiete;
        $types .="i"; 
    }
    
    if (!empty($_POST['min-wohnflaeche'])) {
        $min_wohnflaeche=$_POST['min-wohnflaeche'];
        $filters[] = "wohnflaeche >= ?";
        $params[] = (int)$min_wohnflaeche;
        $types .= "i"; 
    }
    
    if (!empty($_POST['max-wohnflaeche'])) {
        $max_wohnflaeche=$_POST['max-wohnflaeche'];
        $filters[] = "wohnflaeche <= ?";
        $params[] = (int)$max_wohnflaeche;
        $types .= "i"; 
    }
    if (!empty($_POST['min-zim-zahl'])) {
        $min_zim_zahl=$_POST['min-zim-zahl'];
        $filters[] = "zimmerzahl >= ?";
        $params[] = (int)$min_zim_zahl;
        $types .= "i"; 
    }
    
    if (!empty($_POST['max-zim-zahl'])) {
        $max_zim_zahl=$_POST['max-zim-zahl'];
        $filters[] = "zimmerzahl <= ?";
        $params[] = (int)$max_zim_zahl;
        $types .= "i"; 
    }
    if(!empty($filters)){
        $sql.=" AND ".implode(" AND ",$filters);
    }       
                 
        $stmt=$conn->prepare($sql);
        
        if(!empty($params)){
            $stmt->bind_param($types, ...$params);
    
        }
        $stmt->execute();
        


?>


       <div class="filter-bar"> 
        <form class="filter-form" action="#" method="post">
            <div>
            <h5>Ort</h5>
            <input placeholder="Ort" type="text" name="stadt" id="city-input" value="<?php echo $stadt; ?>">
    </div>
            
            
            <div>
            <h5>Kaltmiete</h5>    
            <input name="min-kaltmiete" type="number" placeholder="Min." value="<?php echo $min_kaltmiete; ?>">
            <input name="max-kaltmiete" type="number" placeholder="Max." value="<?php echo $max_kaltmiete; ?>">
            </div>
            <div>
            <h5>Wohnfläche</h5>  
            <input name="min-wohnflaeche" type="number"placeholder="Min." value="<?php echo $min_wohnflaeche; ?>">
            <input name="max-wohnflaeche" type="number" placeholder="Max." value="<?php echo $max_wohnflaeche; ?>">
            </div>
            <div>
            <h5>Zimmerzahl</h5>  
            <input name="min-zim-zahl" type="number" placeholder="Min." value="<?php echo $min_zim_zahl; ?>">
            <input name="max-zim-zahl" type="number" placeholder="Max." value="<?php echo $max_zim_zahl; ?>">
            </div>
            <input type="submit" value="Filter anwenden" class="submit-filter btn">
        </form>

        <form action="./">
        <input type="hidden" value="clear"  >
        <button  type="submit" value="clear" class="clear-filter btn" ><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000"><path d="m592-481-57-57 143-182H353l-80-80h487q25 0 36 22t-4 42L592-481ZM791-56 560-287v87q0 17-11.5 28.5T520-160h-80q-17 0-28.5-11.5T400-200v-247L56-791l56-57 736 736-57 56ZM535-538Z"/></svg></button>
    </form>
    </div>
    
 
<!--<img src="..\\img\\images\\wohnung100\\bedroom-pastele.jpg" alt="image">-->



    
    
    
   
<!----------------------WohnungenList---------------------------------->


    <div class="scroll-list">
        <?php
$result = $stmt->get_result();
while($row=$result->fetch_assoc()){
    $adress_param=urlencode(trim($row['adresse']).',+'.trim($row['postleitzahl']).',+'.trim($row['stadt']));
               $adress_url="https://www.google.com/maps/place/".$adress_param;
               echo '<div class="appartment-card" data-scroll="0">';
               
               $query_all_images="SELECT BildLink,BildId,Name FROM Bilder WHERE wohnungId='". $row['wohnungId']."'";
               $result2=$conn->query($query_all_images);
                if($result2->num_rows>0){
                   echo  '<div class="img-scroller-container">';
                   echo '<div class="img-inner-container">';
                   while($row2=$result2->fetch_assoc()){
                       echo '<img src="' . $row2['BildLink'] . '" alt="image">';
                   
               } }
               echo '</div>';
               echo '<svg class="arrow-left arrow" onclick="scrollImageStrip(event)" xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="#173660"><path d="M576-240 336-480l240-240 51 51-189 189 189 189-51 51Z"/></svg>';
               echo '<svg class="arrow-right arrow" onclick="scrollImageStrip(event)" xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="#173660"><path d="M522-480 333-669l51-51 240 240-240 240-51-51 189-189Z"/></svg>';
               echo '<h1 class="count-scroll">1/'.$result2->num_rows.'</h1>';
               echo '</div>';
               echo '<div class="appartment-info">';
               echo '<a href="Beschreibung.php?wohnungId='.$row['wohnungId'].'"class="titel" target="blank"><h2>'.$row['titel'].'</h2></a>';
               echo '<a href="'.$adress_url.'" target="blank" class="adresse">'.$row['postleitzahl'].' '.$row['stadt'].', '.$row['adresse'].'</a>';
               echo '<div class="wohnfläche info-item">';
               echo '<p >Wohnfläche</p>';
               echo '<p>'.$row['wohnflaeche'].'m&sup2;</p>';
               echo '</div>';
               echo '<div class="kaltmiete info-item">';
               echo '<p>Kaltmiete</p>';
               echo '<p>'.$row['kaltmiete'].'&euro;</p>';
               echo '</div>';
               echo '<div class="zim-zahl info-item">';
               echo '<p>Zim.</p>';
               echo '<p>'.$row['zimmerzahl'].'</p>';
               echo '</div>';
               echo'<svg class="info-icon like-btn" xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="30px" fill="currentColor"><path d="m480-144-50-45q-100-89-165-152.5t-102.5-113Q125-504 110.5-545T96-629q0-89 61-150t150-61q49 0 95 21t78 59q32-38 78-59t95-21q89 0 150 61t61 150q0 43-14 83t-51.5 89q-37.5 49-103 113.5T528-187l-48 43Zm0-97q93-83 153-141.5t95.5-102Q764-528 778-562t14-67q0-59-40-99t-99-40q-35 0-65.5 14.5T535-713l-35 41h-40l-35-41q-22-26-53.5-40.5T307-768q-59 0-99 40t-40 99q0 33 13 65.5t47.5 75.5q34.5 43 95 102T480-241Zm0-264Z"/></svg>';


               
          
               echo '</div>';
               echo '</div>';
            }
    
              
               
            



/*else{
    
    $query_all_wohnungen="SELECT wohnungId, titel,adresse,stadt,wohnflaeche,postleitzahl,kaltmiete,zimmerzahl FROM Wohnungen";
    showContent($conn, $query_all_wohnungen);}*/
?>
</div>
        </div>
        

    

<?php function showContent(mysqli $conn, string $query):void{
  

          
          

     $result=$conn->query($query);
       if($result->num_rows>0){
           while($row=$result->fetch_assoc()){
               $adress_param=urlencode(trim($row['adresse']).',+'.trim($row['postleitzahl']).',+'.trim($row['stadt']));
               $adress_url="https://www.google.com/maps/place/".$adress_param;
               echo '<div class="appartment-card" >';
               
               $query_all_images="SELECT BildLink,BildId,Name FROM Bilder WHERE wohnungId='". $row['wohnungId']."'";
               $result2=$conn->query($query_all_images);
                if($result2->num_rows>0){
                   echo  '<div class="img-scroller-container">';
                   echo '<div class="img-inner-container">';
                   while($row2=$result2->fetch_assoc()){
                       echo '<img src="' . $row2['BildLink'] . '" alt="image">';
                   
               } }
               echo '</div>';
               echo '<svg class="arrow-left arrow" onclick="scrollImageStrip(event)" xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="#173660"><path d="M576-240 336-480l240-240 51 51-189 189 189 189-51 51Z"/></svg>';
               echo '<svg class="arrow-right arrow" onclick="scrollImageStrip(event)" xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="#173660"><path d="M522-480 333-669l51-51 240 240-240 240-51-51 189-189Z"/></svg>';
               echo '<h1 class="count-scroll">1/'.$result2->num_rows.'</h1>';
               echo '</div>';
               
              
               echo '<div class="appartment-info">';
               echo '<a href="Beschreibung.php?wohnungId='.$row['wohnungId'].'"class="titel" target="blank"><h2>'.$row['titel'].'</h2></a>';
               echo '<a href="'.$adress_url.'" target="blank" class="adresse">'.$row['postleitzahl'].' '.$row['stadt'].', '.$row['adresse'].'</a>';
               echo '<div class="wohnfläche info-item">';
               echo '<p >Wohnfläche</p>';
               echo '<p>'.$row['wohnflaeche'].'m&sup2;</p>';
               echo '</div>';
               echo '<div class="kaltmiete info-item">';
               echo '<p>Kaltmiete</p>';
               echo '<p>'.$row['kaltmiete'].'&euro;</p>';
               echo '</div>';
               echo '<div class="zim-zahl info-item">';
               echo '<p>Zim.</p>';
               echo '<p>'.$row['zimmerzahl'].'</p>';
               echo '</div>';
               echo'<svg class="info-icon like-btn" xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="30px" fill="currentColor"><path d="m480-144-50-45q-100-89-165-152.5t-102.5-113Q125-504 110.5-545T96-629q0-89 61-150t150-61q49 0 95 21t78 59q32-38 78-59t95-21q89 0 150 61t61 150q0 43-14 83t-51.5 89q-37.5 49-103 113.5T528-187l-48 43Zm0-97q93-83 153-141.5t95.5-102Q764-528 778-562t14-67q0-59-40-99t-99-40q-35 0-65.5 14.5T535-713l-35 41h-40l-35-41q-22-26-53.5-40.5T307-768q-59 0-99 40t-40 99q0 33 13 65.5t47.5 75.5q34.5 43 95 102T480-241Zm0-264Z"/></svg>';


               echo '</div>';
          
               echo '</div>';
               echo '</div>';
            }}


}

?>




<script>
    //document.querySelector(('.appartment-card')).dataset.scroll="200";
    
    console.log(document.querySelector(('.appartment-card')).dataset.scroll+"data");

    
    
    function scrollImageStrip(event){
        event.preventDefault();
        
       
        let appartmentCard = event.target.closest('.appartment-card');
    
        let countScroll=parseInt(appartmentCard.dataset.scroll);
         
         console.log(countScroll);
        let countScrollHtmlEl=appartmentCard.querySelector('.count-scroll');
        let imgInnerContainer=appartmentCard.querySelector('.img-inner-container');
        let imgQuantity=appartmentCard.querySelectorAll('img').length
        let maxScrolls=imgQuantity*100-100;
        console.log("Count scroll: ",countScroll );
    
        if((event.target.classList.contains('arrow-right')
        ||event.target.parentElement.classList.contains('arrow-right'))&&maxScrolls>countScroll){

        countScroll=100+countScroll;    
        imgInnerContainer.style.transform="translate(-"+countScroll+"%)"; 
        console.log("Count scroll: ",countScroll ); 
        countScrollHtmlEl.innerText=(countScroll/100)+1+"/"+imgQuantity;
        appartmentCard.dataset.scroll=countScroll.toString();
        }else if(0<countScroll&&(event.target.classList.contains('arrow-left')||event.target.parentElement.classList.contains('arrow-left'))){
            console.log(appartmentCard.dataset.scrollCount+"dataset");
            countScroll=countScroll-100;
        imgInnerContainer.style.transform="translate(-"+countScroll+"%)";
    }
    countScrollHtmlEl.innerText=(countScroll/100)+1+"/"+imgQuantity;
        appartmentCard.dataset.scroll=countScroll.toString();
        
    }
    
function toggleDropdown(event){

        const parentDiv=event.target.parentElement;
        parentDiv.querySelector(".dropdown-content").classList.toggle("visible");
    }
    </script>    
</body>
</html>
<!--/* $query_all_images="SELECT BildLink,BildId,Name FROM Bilder";
            $result=$conn->query($query_all_images);
            if($result->num_rows>0){
                while($row=$result->fetch_assoc()){
                    echo '<img src="' . $row['BildLink'] . '" alt="image">';
                    echo '<p>'.$row['BildId'].'</p>';
                    
                }

            }*/-->