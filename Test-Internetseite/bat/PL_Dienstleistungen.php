<?php
session_start();
$hostname = '127.0.0.1';
$username = 'root';
$password = 'mysql123';
$databasename = 'deineDatenbank';
$charset = 'utf8mb4';

/*CREATE TABLE Lounges (
    LoungeID INT,
    Slot varchar(255),
    KundeID INT);*/


    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        echo "Loungeart: " . $_POST['Privatlounge'] . "<br>";
        echo "Slot: " . $_POST['Slot'] . "<br>";
        echo "LoungeID".$_POST['LoungeID']; // Semikolon hinzugefügt
    
        if (isset($_SESSION['anmeldename']) && isset($_SESSION['pw'])){
            try {
                $con = new PDO("mysql:host=$hostname;dbname=$databasename;charset=$charset", $username, $password);
    
                // Generate LoungeID
                $loungeID = $_POST['LoungeID'];
    
                // Get values from the form
                $userID = $_SESSION['BenutzerID'];
                $slot = $_POST['Slot'];
                echo "bis hier<br>";
    
                // Insert into the database
                $updateStmt = $con->prepare("UPDATE Lounges SET KundeID = :userID WHERE LoungeID = :loungeID AND Slot = :slot");
                $updateStmt->bindParam(':loungeID', $loungeID, PDO::PARAM_INT);
                $updateStmt->bindParam(':slot', $slot, PDO::PARAM_STR);
                $updateStmt->bindParam(':userID', $userID, PDO::PARAM_INT);
                echo "bis hier2 <br>";
                $updateStmt->execute();
    
                echo "Benutzer erfolgreich aktualisiert.";
    
            } catch (PDOException $e) {
                $error_message = "DB-Verbindungsfehler: " . $e->getMessage();
            } finally {
                unset($con);

    // Unset session variables after inserting into the database
    unset($_SESSION['Privatlounge']);
    unset($_SESSION['Slot']);

    sleep(1);

        // Leite auf eine andere Seite weiter
        header("Location: ../Anmeldung.php");
        exit;
}}else{sleep(3);

    // Leite auf eine andere Seite weiter
    header("Location: ../Anmeldung.php");
    exit;}
}
?>