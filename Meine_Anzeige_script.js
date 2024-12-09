document.addEventListener("DOMContentLoaded", () => {
    const anzeigeContainer = document.getElementById("anzeigen-container");
    const formContainer = document.getElementById("anzeige-form-container");
    const form = document.getElementById("anzeige-form");
    const abbrechenButton = document.getElementById("abbrechen");
    const form1 = document.getElementById("file-form");

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
                `;
                anzeigeContainer.appendChild(div);
            });
        });

    // Neue Anzeige hinzufügen
    document.getElementById("neue-anzeige").addEventListener("click", () => {
        formContainer.classList.remove("hidden");
    });

    // Formular abschicken
   


form.addEventListener("submit", (e) => {
    e.preventDefault();  

   
    const formData1 = new FormData(form); // Создаем FormData из формы
    console.log("Form Data:", formData1);  // Логируем собранные данные

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
/*
form1.addEventListener("submit", (e) => {
    e.preventDefault();

    const formData = new FormData(form1); // Создаем FormData из формы

    fetch("bild_bearbeiten.php", {
        method: "POST",
        body: formData, // Передаем данные в формате FormData
    })
    .then(response => {
        if (!response.ok) {
            return response.text().then(text => { throw new Error(text) });
        }
        return response.json();
    })
    .then(data => {
        console.log("Server Response:", data); // Логируем ответ сервера
        location.reload(); // Перезагружаем страницу
    })
    .catch(error => {
        console.error("Error:", error); // Логируем ошибку
    });
});
*/




    
    abbrechenButton.addEventListener("click", () => {
        formContainer.classList.add("hidden");
    });
});

function bearbeiten(id) {
    fetch(`Meine_anzeige.php?id=${id}`)
    .then(response => response.json())
    .then(anzeige => {
        console.log("Полученные данные:", anzeige);
        Object.keys(anzeige).forEach(key => {
            const input = document.getElementById(key);
            if (key === "BildLink") {
                document.getElementById("BildLink-preview").src = anzeige[key];}
            if (input) input.value = anzeige[key];
        });
        document.getElementById("anzeige-form-container").classList.remove("hidden");
    })
    .catch(error => {
        console.error("Ошибка при получении данных:", error);
    });

}
