<?php

/****************************************
 * 
 *                READ
 * Läs tabellen meddelanden från databasen
 * Presentera resultatet i en HTML-tabell
 * 
 ***************************************/

// Hämta $conn (en instans av PDO)
require_once("../connect.php");

// Förbered en SQL-sats
$stmt = $conn->prepare("SELECT * FROM meddelanden");

// Kör SQL-satsen
$stmt->execute();

// Hämta alla rader som finns i contacts
// fetchAll()
// Returns an array containing all of the result set rows
$result = $stmt->fetchAll();

$table = "
    <table class='table table-hover'>
    <tr>
        <th>#</th>
        <th>Namn</th>
        <th>E-post</th>
        <th>Meddelande</th>
        <th>Radera</th>
    </tr>
    ";

foreach ($result as $key => $value) {

    $id = $value['id'];

    $table .= "
        <tr>
            <td>$value[id]</td>
            <td>$value[namn]</td>
            <td>$value[epost]</td>
            <td>$value[meddelande]</td>
            <td>
                <a href='delete.php?id=$value[id]'>Radera</a>
            </td>
        </tr>
    ";
}

$table .= "</table>";

echo $table;

echo "<p><a href='delete.php?id=all'>Radera alla</a>";