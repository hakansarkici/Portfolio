<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $loungeID = $_POST['LoungeID'];
    $KundeID = 0;

    $hostname = '127.0.0.1';
    $username = 'root';
    $password = 'mysql123';
    $databasename = 'deineDatenbank';
    $charset = 'utf8mb4';

    try {
        $con = new PDO("mysql:host=$hostname;dbname=$databasename;charset=$charset", $username, $password);


            // Update the chosen field based on the user ID
            echo "UPDATE Lounges SET KundeID = 0 WHERE LoungeID = $massageID";
            $updateStmt = $con->prepare("UPDATE Lounges SET KundeID = :new WHERE LoungeID = :loungeID");
            $updateStmt->bindParam(':new', $KundeID);
            $updateStmt->bindParam(':loungeID', $loungeID);
            $updateStmt->execute();

            echo "Massage erfolgreich aktualisiert.";

    } catch (PDOException $e) {
        $error_message = "DB-Verbindungsfehler: " . $e->getMessage();
    } finally {
        unset($con);
        sleep(1);

        // Leite auf eine andere Seite weiter
        header("Location: ../Anmeldung.php");
        exit;
    }

}
?>