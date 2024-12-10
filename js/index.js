// Button-Element holen und initial verstecken
let scrollUpBtn = document.getElementById('scroll-up-btn');
scrollUpBtn.classList.add('hidden');
// Timer für Debouncing
let debounceTimer;
window.addEventListener("scroll", () => {
    //Timer zurücksetzen
    clearTimeout(debounceTimer);
    debounceTimer = setTimeout(() => {
        // Button anzeigen, wenn mehr als eine Fensterhöhe gescrollt wurde
        if (window.scrollY >= window.innerHeight) {
            scrollUpBtn.classList.remove("hidden");
            //console.log(window.scrollY);
        }
        // Button verstecken, wenn weniger gescrollt wurde
        if (window.scrollY < window.innerHeight) {
            scrollUpBtn.classList.add("hidden");
        }
    }, 50);

});


// Klick-Event-Listener für den Button
scrollUpBtn.addEventListener("click", (e) => {
    e.preventDefault();
    //Scrollen zu Position 100px, 
    window.scrollTo({
        top: 100,
        // Glattes Scrollen
        behavior: "smooth"
    });
})




function manageFavourites(event) {
    event.preventDefault();
    // Holt den Button und die zugehörige Wohnungs-ID aus der HTML-Struktur
    let likeBtn = event.target.closest('.appartment-card').querySelector('.like-btn');
    let wohnungId = likeBtn.dataset.WohnungId;
    // Sendet die Wohnungs-ID per POST-Request an den Server
    fetch("index.php", {
        method: "POST",
        // JSON-Daten werden gesendet
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({ wohnungId: wohnungId }),
    })
    .then(response => {
        // Wenn der Server erfolgreich antwortet
        if (response.ok) {
            // Wechselt die Farbe des Buttons zwischen orange und rot
            if (likeBtn.style.color === "orange") {
                console.log(likeBtn.style.color);
                likeBtn.style.color = "red";
            } else {
                likeBtn.style.color = "orange";
            }
        } else {
            throw new Error('Network response was not ok');
        }
    })
    // Fehler im Catch-Block protokollieren
        .catch(error => {
            console.error('Error:', error);
        }
        )
}
function scrollImageStrip(event) {
    event.preventDefault();
    
    let appartmentCard = event.target.closest('.appartment-card');
    let countScroll = parseInt(appartmentCard.dataset.scroll);


    let countScrollHtmlEl = appartmentCard.querySelector('.count-scroll');
    let imgInnerContainer = appartmentCard.querySelector('.img-inner-container');
    let imgQuantity = appartmentCard.querySelectorAll('img').length;
    //Bestimmt maximal scroll Anzahl
    let maxScrolls = imgQuantity * 100 - 100;
    console.log("Count scroll: ", countScroll);
    //Check, ob event auf svg order path passiert ist
    if ((event.target.classList.contains('arrow-right')
        || event.target.parentElement.classList.contains('arrow-right')) && maxScrolls > countScroll) {

        countScroll = 100 + countScroll;
        imgInnerContainer.style.transform = "translate(-" + countScroll + "%)";
        console.log("Count scroll: ", countScroll);
        countScrollHtmlEl.innerText = (countScroll / 100) + 1 + "/" + imgQuantity;
        appartmentCard.dataset.scroll = countScroll.toString();
    } else if (0 < countScroll && (event.target.classList.contains('arrow-left') || event.target.parentElement.classList.contains('arrow-left'))) {
        console.log(appartmentCard.dataset.scrollCount + "dataset");
        countScroll = countScroll - 100;
        imgInnerContainer.style.transform = "translate(-" + countScroll + "%)";
    }
    countScrollHtmlEl.innerText = (countScroll / 100) + 1 + "/" + imgQuantity;
    appartmentCard.dataset.scroll = countScroll.toString();

}



function toggleDropdown(event) {

    const parentDiv = event.target.parentElement;
    parentDiv.querySelector(".dropdown-content").classList.toggle("visible");
}