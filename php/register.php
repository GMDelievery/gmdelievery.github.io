<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $apiToken = $_POST["apiToken"];

    // Überprüfen, ob das Benutzername- und API-Token-Feld nicht leer ist
    if (!empty($username) && !empty($apiToken)) {
       
        echo "Registrierung erfolgreich!";
    } else {
        echo "Benutzername und API-Token sind erforderlich!";
    }
}
?>
