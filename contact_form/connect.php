<?php

$server = "localhost";
$dbName = "kontakt";
$dbUser = "root";
$dbPass = "root";
$db_DSN = "mysql:host=$server;dbname=$dbName;charset=UTF8";

try {
    $conn = new PDO($db_DSN, $dbUser, $dbPass);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // echo "<code>Databasanslutning OK</code>";

} catch (PDOException $e) {
    echo "<code>Databasanslutning inte OK: </code>
        <pre> " . $e->getMessage() . "</pre>";
    exit(1);
}