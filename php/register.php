<?php
require_once('gmapi.php');
GermanMinerAPI::$apiKey = 'aea87ae0f19c8b71244518ed2';

function registerUser($username, $apiToken) {
    try {
        // Beispiel: Überprüfen der API-Informationen für den Benutzer
        $apiInfo = gmapi::getApiInfo();
        // Hier könntest du weitere Logik hinzufügen, um die Registrierung zu steuern,
        // basierend auf den API-Daten oder anderen Informationen von GermanMiner

        // Du könntest auch andere API-Methoden für zusätzliche Überprüfungen verwenden
        // GermanMinerAPI::getPlayerInfo(), GermanMinerAPI::getCompanyInfo(), usw.

        // Annahme: Registrierung war erfolgreich
        echo "Registrierung für Benutzer '$username' mit API-Token '$apiToken' erfolgreich!";
    } catch (Exception $e) {
        // Fehlerbehandlung, falls eine Exception auftritt
        echo 'Fehler bei der Registrierung: ' . $e->getMessage();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $apiToken = $_POST["apiToken"];

    // Überprüfen, ob das Benutzername- und API-Token-Feld nicht leer ist
    if (!empty($username) && !empty($apiToken)) {
       
        registerUser($username, $apiToken)

        echo "Registrierung erfolgreich!";
    } else {
        echo "Benutzername und API-Token sind erforderlich!";
    }
}
?>
