document.addEventListener("DOMContentLoaded", () => {
    const anzeigeContainer = document.getElementById("anzeigen-container");
    const formContainer = document.getElementById("anzeige-form-container");
    const form = document.getElementById("anzeige-form");
    const abbrechenButton = document.getElementById("abbrechen");
   

    // Anzeigen laden
    fetch("Meine_anzeige.php")
        .then(response => response.json())
        .then(anzeigen => {
            anzeigen.forEach(anzeige => {
                const div = document.createElement("div");
                div.className = "anzeige";
                div.innerHTML = `
                    <img src="${anzeige.BildLink}" alt="Bild" />
                    <h3>${anzeige.Titel}</h3>
                    <p>${anzeige.Beschreibung}</p>
                    <p>${anzeige.Stadt}, ${anzeige.Postleitzahl}</p>
                    <button onclick="bearbeiten(${anzeige.WohnungId})">Bearbeiten</button>
                    <button onclick="loeschen(${anzeige.WohnungId})">Löschen</button
                `;
                anzeigeContainer.appendChild(div);
            });
        });

    // Neue Anzeige hinzufügen
    document.getElementById("neue-anzeige").addEventListener("click", () => {
        formContainer.classList.remove("hidden");
       // form.reset();
       // document.getElementById("wohnungId").value = "";
    });

    // Formular abschicken
   


form.addEventListener("submit", (e) => {
    e.preventDefault();  

   
    const formData1 = new FormData(form); // create FormData from form
    console.log("Form Data:", formData1);  // Protokollierung der FormData
    
    fetch("hizufugen_bearbeiten.php", {
        method: "POST",
        body: formData1, // Übergeben der Daten im FormData-Format 
    })
    .then(response => {
        if (!response.ok) {
            return response.text().then(text => { throw new Error(text) });
        }
        return response.json();
    })
    .then(data => {
        console.log("Server Response:", data); // Protokollierung der Serverantwort
        location.reload(); // Die Seite neu laden
    })
    .catch(error => {
        console.error("Error:", error); // Protokollierung der Fehler
    });
});





    
    abbrechenButton.addEventListener("click", () => {
        formContainer.classList.add("hidden");
    });
});

function bearbeiten(id) {
    fetch(`Meine_anzeige.php?id=${id}`)
    .then(response => response.json())
    .then(anzeige => {
        console.log("Datenempfang:", anzeige);
        Object.keys(anzeige).forEach(key => {
            const input = document.getElementById(key);
            if (key === "BildLink") {
                document.getElementById("BildLink-preview").src = anzeige[key];}
            if (input) input.value = anzeige[key];
        });
        document.getElementById("anzeige-form-container").classList.remove("hidden");
    })
    .catch(error => {
        console.error("Fehler beim Datenempfang:", error);
    });

}

function loeschen(id) {
    if (confirm("Möchten Sie die Anzeige wirklich löschen?")) {
        fetch(`anzeige_leoschen.php`, {
            method: "POST", // benutzen wir die POST-Methode
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                action: "delete", // Aktion: Löschen
                id: id
            })
        })
        .then(response => {
            if (!response.ok) {
                return response.text().then(text => { throw new Error(text); });
            }
            return response.json();
        })
        .then(data => {
            console.log("Server Response:", data);
            if (data.success) {
                // Löschen der  Anzeige aus dem DOM (Document Object Model) 
                const deletedElement = document.querySelector(`[onclick="loeschen(${id})"]`).closest(".anzeige");
                if (deletedElement) {
                    deletedElement.remove();
                }
            } else {
                alert("Die Anzeige konnte nicht gelöscht werden.");
            }
        })
        .catch(error => {
            console.error("Error:", error);
            alert("Ein Fehler ist aufgetreten. Die Anzeige wurde nicht gelöscht.");
        });
    }
}