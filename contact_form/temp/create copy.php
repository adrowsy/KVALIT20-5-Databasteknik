<!-- start create.php -->

<form novalidate action="<?php echo htmlspecialchars('#'); ?>" method="post" class="row">
    <div class="col-md-6 form-group">
        <input name="namn" type="text" required class="form-control" placeholder="Namn">
    </div>
    <div class="col-md-6 form-group">
        <input name="epost" type="email" required class="form-control" placeholder="E-post">
    </div>
    <div class="col-md-12 form-group">
        <textarea name="meddelande" cols="30" rows="5" required class="form-control" placeholder="Skriv ett meddelande"></textarea>
    </div>

    <div class="col-md-12 form-group d-grid gap-2 d-md-flex justify-content-md-end">
        <button type="submit" class="btn btn-primary me-md-2">Skicka meddelande</button>
    </div>
</form>


<?php

/***************************************
 * 
 *                CREATE
 *          Skriv ett meddelande
 * 
 ***************************************/

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    require_once("connect.php");

    // Test att skriva ut arrayen med formulärdata
    echo "<p><pre>";
    //print_r($_POST);
    echo "</pre>";


    ##TODO: FELSÖK FILTRERAD DATA, funkar @ ??
    # Kolla https://www.w3schools.com/php/php_form_url_email.asp
    /*
    if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
        $nameErr = "Only letters and white space allowed";
    }
*/

    // Rensa otillåtna tecken från inputfält (sanitize)
    $namn = filter_var($_POST['namn'], FILTER_SANITIZE_STRING);
    $epost = filter_var($_POST['epost'], FILTER_SANITIZE_EMAIL);
    $meddelande = filter_var($_POST['meddelande'], FILTER_SANITIZE_STRING);

    if ((!filter_var($_POST['epost'], FILTER_VALIDATE_EMAIL) === false)
        &&
        (preg_match("/^[a-zA-Z-' ]*$/", $namn))) {

        // Skapa en SQL-sats (förbereda en sats)
        $stmt = $conn->prepare("INSERT INTO meddelanden (namn, epost, meddelande)
                                    VALUES (:namn, :epost, :meddelande)");

        // Binda parametrar (binda variabler med platshållare)
        $stmt->bindParam(':namn', $namn);
        $stmt->bindParam(':epost', $epost);
        $stmt->bindParam(':meddelande', $meddelande);

        // Kör SQL-sats
        $stmt->execute();

        // Hämta sista id som infogats A_I
        $last_id = $conn->lastInsertId();

        $message = "<div class='alert alert-success pb-0' role='alert'>
        <p>Tack $namn. Ditt meddelande har skickats (nr.  $last_id)</p>
        </div>";
    } else {
        $message = "<div class='alert alert-warning pb-0' role='alert'>
    <p> Felmeddelande </p>
    </div>";
    }

    echo $message;
}
?>
<!-- slut create.php -->