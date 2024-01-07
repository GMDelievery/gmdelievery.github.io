<?php
require_once('gmapi.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $apiToken = $_POST["apiToken"];

    // Überprüfen, ob das Benutzername- und API-Token-Feld nicht leer ist
    if (!empty($username) && !empty($apiToken)) {
        // Hier könntest du die GermanMinerAPI-Klasse verwenden, um weitere Validierungen durchzuführen oder andere Aktionen auszuführen
        // Beachte: Die GermanMinerAPI::$apiKey muss möglicherweise vor der Verwendung validiert werden

        // Setze den API-Key für die GermanMinerAPI-Klasse
        GermanMinerAPI::$apiKey = $apiToken;
        
        // JavaScript, um das Popup-Fenster zu schließen und im Hauptfenster weiterzuleiten
        echo '<script type="text/javascript">
            alert("Registrierung erfolgreich!");
            window.opener.postMessage("Registrierung erfolgreich", "*");
            window.close();
          </script>';
    } else {
        // Fehlerbehandlung für leere Felder (Benutzername oder API-Token)
        http_response_code(400);
        echo "400 Bad Request - Benutzername und API-Token sind erforderlich.";
    }
} else {
    // Fehlerbehandlung für nicht unterstützte Methoden
    http_response_code(405);
    echo "405 Method Not Allowed";
}
?>
