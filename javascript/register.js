window.addEventListener("message", function(event) {
    if (event.data === "Registrierung erfolgreich") {
        // Hier kannst du weitere Aktionen ausführen, z.B. den Benutzer anmelden
        console.log("Benutzer wurde erfolgreich registriert.");
        // Führe hier deine Anmelde- oder Weiterleitungslogik aus
    }
});