<?php
require_once('gmapi.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $apiToken = $_POST["apiToken"];

    // Überprüfen, ob das Benutzername- und API-Token-Feld nicht leer ist
    if (!empty($username) && !empty($apiToken)) {
       
        GermanMinerAPI::$apiKey = $apiToken;
        
        echo '<script type="text/javascript">
            alert("Registrierung erfolgreich!");
            window.opener.postMessage("Registrierung erfolgreich", "*");
            window.close();
          </script>';
    } else {
        // Fehlerbehandlung für nicht unterstützte Methoden
    http_response_code(405);
    echo "405 Method Not Allowed";
    }
}
?>
