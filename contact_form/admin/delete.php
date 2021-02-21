  
<?php

/***************************************
 * 
 *                DELETE
 *          Ta bort meddelanden
 * 
 ***************************************/

require_once("header.php");
require_once("../connect.php");

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    if ($_GET['id'] == 'all') {
        $sql = "DELETE FROM meddelanden";
    } else {
        $sql = "DELETE FROM meddelanden WHERE id = :id";
    }

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $rowCount = $stmt->rowCount();

    $rowCount > 1 ? $unit = "meddelanden" : $unit = "meddelande";

    $message = "<div class='pb-0 alert alert-danger' role='alert'>
                    <p>$rowCount $unit har raderats!</p>
                </div>";

    if ($rowCount != 0) echo $message;
}

echo "<p><a href='index.php'>Visa alla meddelanden</a>";