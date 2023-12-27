<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $massageID = $_POST['MassageID'];
    $KundeID = 0;

    $hostname = '127.0.0.1';
    $username = 'root';
    $password = 'mysql123';
    $databasename = 'deineDatenbank';
    $charset = 'utf8mb4';

    try {
        $con = new PDO("mysql:host=$hostname;dbname=$databasename;charset=$charset", $username, $password);


            // Update the chosen field based on the user ID
            echo "UPDATE Massagen SET KundeID = 0 WHERE MassageID = $massageID";
            $updateStmt = $con->prepare("UPDATE Massagen SET KundeID = :new WHERE MassageID = :massageID");
            $updateStmt->bindParam(':new', $KundeID);
            $updateStmt->bindParam(':massageID', $massageID);
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