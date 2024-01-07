<?php

use Exception;

class GermanMinerAPI
{

    private static $apiKey = '<API-Key>';


    /**
     * API-Informationen
     * Gibt Level und verbleibende Anfragen zurück.
     *
     * @return array|bool
     * @throws Exception
     */
    public static function getApiInfo() {
        return self::fetchJson('api/info');
    }

    /**
     * Kontoauszug abrufen
     *
     * @return array|bool
     * @throws Exception
     */
    public static function getBankActivitystatement($accountNumber, $page) {
        self::validateAccountNumber($accountNumber, 'accountNumber');

        return self::fetchJson('bank/activitystatement', array(
            'accountNumber' => $accountNumber,
            'page' => $page
        ));
    }

    /**
     * Kontoinformationen abrufen
     *
     * @return array|bool
     * @throws Exception
     */
    public static function getBankInfo($accountNumber) {
        self::validateAccountNumber($accountNumber, 'accountNumber');

        return self::fetchJson('bank/info', array(
            'accountNumber' => $accountNumber
        ));
    }

    /**
     * Auflistung aller Bankkonten
     * Gibt alle Bankkonten zurück, auf die der Inhaber des API-Keys zugreifen kann
     *
     * @return array|bool
     * @throws Exception
     */
    public static function getBankList() {
        return self::fetchJson('bank/list');
    }

    /**
     * Kontonummer abfragen (+ 3 Euro Gebühr)
     *
     * @return array|bool
     * @throws Exception
     */
    public static function bankLookup($uuid) {
        self::validateUuid($uuid, 'uuid');

        return self::fetchJson('bank/lookup', array(
            'uuid' => $uuid
        ));
    }

    /**
     * Transaktion tätigen
     *
     * @return array|bool
     * @throws Exception
     */
    public static function createBankTransaction($accountNumber, $amount, $targetAccountNumber, $message = null) {
        self::validateAccountNumber($accountNumber, 'accountNumber');

        return self::fetchJson('bank/transaction', array(
            'accountNumber' => $accountNumber,
            'amount' => $amount,
            'targetAccountNumber' => $targetAccountNumber,
            'message' => $message
        ));
    }

    /**
     * BIZ-Informationen abrufen
     *
     * @return array|bool
     * @throws Exception
     */
    public static function getBizInfo($bizId) {
        return self::fetchJson('biz/info', array(
            'bizId' => $bizId
        ));
    }

    /**
     * FirmenShop-Statistiken einsehen
     *
     * @return array|bool
     * @throws Exception
     */
    public static function getCompanyChestshopStats() {
        return self::fetchJson('company/chestshop/stats');
    }

    /**
     * Firmenbeschreibung setzen
     * Eine Änderung über die API kostet wie im Bürgeramt auch 250 Euro.
     *
     * @return array|bool
     * @throws Exception
     */
    public static function setCompanyDescription($data) {
        return self::fetchJson('company/description/set', array(
            'data' => $data
        ));
    }

    /**
     * Mitarbeiter kündigen
     *
     * @return array|bool
     * @throws Exception
     */
    public static function companyDismiss($uuid) {
        self::validateUuid($uuid, 'uuid');

        return self::fetchJson('company/dismiss', array(
            'uuid' => $uuid
        ));
    }

    /**
     * Firmeninformationen abrufen
     *
     * @return array|bool
     * @throws Exception
     */
    public static function getCompanyInfo() {
        return self::fetchJson('company/info');
    }

    /**
     * Lohn setzen
     *
     * @return array|bool
     * @throws Exception
     */
    public static function setCompanyLoan($amount, $uuid) {
        self::validateUuid($uuid, 'uuid');

        return self::fetchJson('company/loan/set', array(
            'amount' => $amount,
            'uuid' => $uuid
        ));
    }

    /**
     * Firmenname setzen
     * Eine Änderung über die API kostet wie im Bürgeramt auch 250 Euro.
     *
     * @return array|bool
     * @throws Exception
     */
    public static function setCompanyName($data) {
        return self::fetchJson('company/name/set', array(
            'data' => $data
        ));
    }

    /**
     * Staatsfirmen-Verkaufsstatistiken einsehen
     *
     * @return array|bool
     * @throws Exception
     */
    public static function getCompanyStatecompanyStats() {
        return self::fetchJson('company/statecompany/stats');
    }

    /**
     * Fraktions-Informationen abrufen
     * Du musst in einer Fraktion mindestens als Leader oder Co-Leader beschäftigt sein
     *
     * @return array|bool
     * @throws Exception
     */
    public static function getFractionInfo($fraction = null) {
        return self::fetchJson('fraction/info', array(
            'fraction' => $fraction
        ));
    }

    /**
     * Fraktions-Vehicles abrufen
     * Du musst in einer Fraktion mindestens als Leader oder Co-Leader beschäftigt sein
     *
     * @return array|bool
     * @throws Exception
     */
    public static function fractionVehicles($fraction = null) {
        return self::fetchJson('fraction/vehicles', array(
            'fraction' => $fraction
        ));
    }

    /**
     * Vitalwerte der Mitglieder abrufen
     * Du musst in einer Fraktion mindestens als Leader oder Co-Leader beschäftigt sein
     *
     * @return array|bool
     * @throws Exception
     */
    public static function fractionVital($fraction = null) {
        return self::fetchJson('fraction/vital', array(
            'fraction' => $fraction
        ));
    }

    /**
     * GM-Link
     * VERALTET: Um einen Nutzer zu verifizieren, benötigst du die UUID, den GMLink-Code und einen Hash. Den GMLink-Code erhältst du durch den Spieler, welcher /gmlink im Chat eingeben muss. Der Hash muss ein MD5-Hash der IP-Adresse des Spielers sein.
     *
     * @return array|bool
     * @throws Exception
     */
    public static function gmlink($code, $hash, $uuid) {
        self::validateGmlinkCode($code, 'code');
        self::validateUuid($uuid, 'uuid');

        return self::fetchJson('gmlink', array(
            'code' => $code,
            'hash' => $hash,
            'uuid' => $uuid
        ));
    }

    /**
     * GM-Link 2 - Anfordern
     * Aufforderung zur Verifizierung in den Chat des Spielers senden. Den GMLink-Code erhältst du durch den Spieler, welcher /gmlink in den Chat eingeben muss.
     *
     * @return array|bool
     * @throws Exception
     */
    public static function gmlink2Request($appName, $code) {
        return self::fetchJson('gmlink2/request', array(
            'appName' => $appName,
            'code' => $code
        ));
    }

    /**
     * GM-Link 2 - Prüfen
     * Sobald der Spieler die Aufforderung im Chat bestätigt hat, kannst du eine Anfrage an diesen Endpunkt senden um seinen Spielernamen und UUID herauszufinden, welchen du zur Authentifizierung nutzen kannst.
     *
     * @return array|bool
     * @throws Exception
     */
    public static function gmlink2Validate($code) {
        return self::fetchJson('gmlink2/validate', array(
            'code' => $code
        ));
    }

    /**
     * Spielerinformationen
     * Gibt Informationen über den Inhaber des API-Schlüssels zurück.
     *
     * @return array|bool
     * @throws Exception
     */
    public static function getPlayerInfo() {
        return self::fetchJson('player/info');
    }

    /**
     * Aktiendaten abrufen
     * Gibt Informationen über die Aktien(-Order) des Inhabers des API-Schlüssels zurück.
     *
     * @return array|bool
     * @throws Exception
     */
    public static function playerStocks() {
        return self::fetchJson('player/stocks');
    }

    /**
     * Vehicles abrufen
     * Gibt Informationen über die Vehicles des Inhabers des API-Schlüssels zurück.
     *
     * @return array|bool
     * @throws Exception
     */
    public static function playerVehicles() {
        return self::fetchJson('player/vehicles');
    }

    /**
     * Vitalwerte abrufen
     * Gibt die Vitalwerde des Inhabers des API-Schlüssels zurück.
     *
     * @return array|bool
     * @throws Exception
     */
    public static function playerVital($uuid = null) {
        return self::fetchJson('player/vital', array(
            'uuid' => $uuid
        ));
    }

    /**
     * Sicherungsinformationen abrufen
     *
     * @return array|bool
     * @throws Exception
     */
    public static function getProtectionInfo($x, $y, $z) {
        return self::fetchJson('protection/info', array(
            'x' => $x,
            'y' => $y,
            'z' => $z
        ));
    }

    /**
     * Spieler zur Sicherung hinzufügen
     *
     * @return array|bool
     * @throws Exception
     */
    public static function addProtectionPlayer($uuid, $x, $y, $z) {
        self::validateUuid($uuid, 'uuid');

        return self::fetchJson('protection/player/add', array(
            'uuid' => $uuid,
            'x' => $x,
            'y' => $y,
            'z' => $z
        ));
    }

    /**
     * Spieler von der Sicherung entfernen
     *
     * @return array|bool
     * @throws Exception
     */
    public static function removeProtectionPlayer($uuid, $x, $y, $z) {
        self::validateUuid($uuid, 'uuid');

        return self::fetchJson('protection/player/remove', array(
            'uuid' => $uuid,
            'x' => $x,
            'y' => $y,
            'z' => $z
        ));
    }

    /**
     * Blockinventar löschen
     * Der Block muss gesichert sein. Wenn der Parameter 'loadChunks' auf 'true' gesetzt ist, lädt der Server den Chunk, ansonsten wird ein Fehler zurückgegeben. Wenn ein Chunk geladen wird, werden zusätzlich 10 Anfragen von deinem Limit abgezogen.
     *
     * @return array|bool
     * @throws Exception
     */
    public static function getWorldClearInventory($y, $x, $z, $loadChunks = null) {
        return self::fetchJson('world/clear/inventory', array(
            'y' => $y,
            'x' => $x,
            'z' => $z,
            'loadChunks' => $loadChunks
        ));
    }

    /**
     * Blockinventar abrufen
     * Der Block muss gesichert sein. Wenn der Parameter 'loadChunks' auf 'true' gesetzt ist, lädt der Server den Chunk, ansonsten wird ein Fehler zurückgegeben. Wenn ein Chunk geladen wird, werden zusätzlich 10 Anfragen von deinem Limit abgezogen.
     *
     * @return array|bool
     * @throws Exception
     */
    public static function getWorldInventory($y, $x, $z, $loadChunks = null) {
        return self::fetchJson('world/inventory', array(
            'y' => $y,
            'x' => $x,
            'z' => $z,
            'loadChunks' => $loadChunks
        ));
    }

    /**
     * Item verschieben
     * Beide Blöcke müssen gesichert sein und auf dem Selben Grundstück stehen. Wenn der Parameter 'loadChunks' auf 'true' gesetzt ist, lädt der Server den Chunk, ansonsten wird ein Fehler zurückgegeben. Wenn ein Chunk geladen wird, werden zusätzlich 20 Anfragen von deinem Limit abgezogen.
     *
     * @return array|bool
     * @throws Exception
     */
    public static function worldMoveItem($amount, $fromSlot, $fromX, $fromY, $fromZ, $toSlot, $toX, $toY, $toZ, $loadChunks = null) {
        return self::fetchJson('world/move/item', array(
            'amount' => $amount,
            'fromSlot' => $fromSlot,
            'fromX' => $fromX,
            'fromY' => $fromY,
            'fromZ' => $fromZ,
            'toSlot' => $toSlot,
            'toX' => $toX,
            'toY' => $toY,
            'toZ' => $toZ,
            'loadChunks' => $loadChunks
        ));
    }
    
    /*
     * Utility-Functions
     */
    
    private static function validateUuid($uuid, $parameterName) {
        if (strlen(str_replace('-', '', $uuid)) != 32) {
            throw new Exception('API returned error: Ungültiger Parameter: ' . $parameterName);
        }
    }
    
    private static function validateGmlinkCode($code, $parameterName) {
        $split = explode('-', $code);
        if (strlen($code) != 11 || count($split) != 3 || !is_numeric($split[0]) ||  !is_numeric($split[1]) || !is_numeric($split[2]) || $split[0] != (($split[1] + $split[2]) % 1000)) {
            throw new Exception('API returned error: Ungültiger Parameter: ' . $parameterName . ' (Der GMLink-Code ist ungültig)');
        }
    }
    
    private static function validateAccountNumber($accountNumber, $parameterName) {
        if (strlen($accountNumber) != 11 || substr(strtoupper($accountNumber), 0, 3) !== 'DEF') {
            throw new Exception('API returned error: Ungültiger Parameter: uuid' . $parameterName);
        }
    }
    
    private static function fetchJson($path, $parameters = null)
    {
        $output = static::fetch($path, $parameters);

        if (!empty($output)) {
            $json = static::parseJson($output);
            if (is_array($json) && isset($json['success'])) {

                if (!$json['success']) {
                    throw new Exception('API returned error: ' . $json['error']);
                }

                return isset($json['data']) ? $json['data'] : true;
            } else {
                throw new Exception('API returned invalid JSON.');
            }
        }

        throw new Exception('API returned nothing.');
    }

    private static function parseJson(string $json)
    {
        $data = json_decode($json, true);
        return empty($data) ? false : $data;
    }

    private static function fetch($path, $parameters = null) {
        return self::getData('https://api.germanminer.de/v2/' . $path . '?key=' . self::$apiKey . '&' .  ($parameters == null ? '' : http_build_query($parameters)));
    }

    private static function getData($url) {
        if (function_exists('curl_init') and extension_loaded('curl')) {
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);

            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);

            $output = curl_exec($ch);
            curl_close($ch);

            return $output;
        } else {
            return @file_get_contents($url);
        }
    }
}
?>