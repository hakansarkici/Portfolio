<?php
session_start();

$hostname = '127.0.0.1';
$username = 'root';
$password = 'mysql123';
$databasename = 'deineDatenbank';
$charset = 'utf8mb4';

try {
    $con = new PDO("mysql:host=$hostname;dbname=$databasename;charset=$charset", $username, $password);

    // Get values from the form
    $userID = $_SESSION['BenutzerID'];
    $artikel = $_SESSION['Artikel'];
    $preis = $_SESSION['Preis'];
    $menge = '1';

    // Insert into the database
    $updateStmt = $con->prepare("INSERT INTO Einkaeufe (ProduktName, Menge, Preis, Einkaufsdatum, benutzerid) VALUES (:artikel, :menge, :preis, '2023-12-20', :userID)");
    $updateStmt->bindParam(':artikel', $artikel);
    $updateStmt->bindParam(':menge', $menge);
    $updateStmt->bindParam(':preis', $preis);
    $updateStmt->bindParam(':userID', $userID);
    $updateStmt->execute();

    echo "Benutzer erfolgreich aktualisiert.";

} catch (PDOException $e) {
    $error_message = "DB-Verbindungsfehler: " . $e->getMessage();
} finally {
    unset($con);

    // Unset session variables after inserting into the database
    unset($_SESSION['Artikel']);
    unset($_SESSION['Preis']);

    sleep(3);

        // Leite auf eine andere Seite weiter
        header("Location: ../Anmeldung.php");
        exit;
}
?>
