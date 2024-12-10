document.addEventListener("DOMContentLoaded", () => {
    const anzeigeContainer = document.getElementById("anzeigen-container");
    const formContainer = document.getElementById("anzeige-form-container");
    const form = document.getElementById("anzeige-form");
    const abbrechenButton = document.getElementById("abbrechen");

    // Anzeigen laden
    fetch("meine_anzeigen.php")
        .then(response => response.json())
        .then(anzeigen => {
            anzeigen.forEach(anzeige => {
                const div = document.createElement("div");
                div.className = "anzeige";
                div.innerHTML = `
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
        const daten = Object.fromEntries(new FormData(form).entries());
        fetch("hinzufuegen_bearbeiten.php", {
            method: "POST",
            body: JSON.stringify(daten),
        })
        .then(() => location.reload());
    });

    abbrechenButton.addEventListener("click", () => {
        formContainer.classList.add("hidden");
    });
});

function bearbeiten(id) {
    fetch(`meine_anzeigen.php?id=${id}`)
        .then(response => response.json())
        .then(anzeige => {
            Object.keys(anzeige).forEach(key => {
                const input = document.getElementById(key);
                if (input) input.value = anzeige[key];
            });
            document.getElementById("anzeige-form-container").classList.remove("hidden");
        });
}
