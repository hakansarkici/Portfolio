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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "Massageart: " . $_POST['Massageart'] . "<br>";
    echo "Slot: " . $_POST['Slot'] . "<br>";
    echo "MassageID: " . $_POST['MassageID'] . "<br>";

    if (isset($_SESSION['anmeldename']) && isset($_SESSION['pw'])){

    try {
        $con = new PDO("mysql:host=$hostname;dbname=$databasename;charset=$charset", $username, $password);


        // Get values from the form
        $massage = $_POST['Massageart'];
        $userID = $_SESSION['BenutzerID'];
        $slot = $_POST['Slot'];
        $MassageID =$_POST['MassageID'];

        // Insert into the database
        $updateStmt = $con->prepare("UPDATE Massagen SET KundeID = :userID WHERE MassageID = :MassageID AND MassageArt=:massage");
        $updateStmt->bindParam(':MassageID', $MassageID, PDO::PARAM_INT);
        $updateStmt->bindParam(':massage', $massage, PDO::PARAM_STR);
        $updateStmt->bindParam(':userID', $userID, PDO::PARAM_INT);

        $updateStmt->execute();

        echo "Massagen erfolgreich aktualisiert.";

    } catch (PDOException $e) {
        $error_message = "DB-Verbindungsfehler: " . $e->getMessage();
        echo $error_message;
    } finally {
        unset($con);

        sleep(1);

        // Leite auf eine andere Seite weiter
        header("Location: ../Anmeldung.php");
        exit;
    }
}else {sleep(3);

    // Leite auf eine andere Seite weiter
    header("Location: ../Anmeldung.php");
    exit;}
}
?>
