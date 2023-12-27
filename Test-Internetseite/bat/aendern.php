<?php   

if(!isset($_SESSION)){session_start();}

$hostname = '127.0.0.1';
$username = 'root';
$password = 'mysql123';
$databasename = 'deineDatenbank';
$charset = 'utf8mb4';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ... your existing code ...

    try {
        $con = new PDO("mysql:host=$hostname;dbname=$databasename;charset=$charset", $username, $password);

        // Get values from the form
        $userID = $_POST['id'];
        $art = $_POST['art'];
        $aenderung = $_POST['name']; // Corrected typo from § to $
        echo "UserID: $userID, Art: $art, Aenderung: $aenderung";


        // Check if the chosen field is already taken
        $stmt = $con->prepare("SELECT * FROM Benutzer WHERE $art = :name");
        $stmt->bindParam(':name', $aenderung);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo "Benutzername bereits vergeben.";
        } else {
            // Update the chosen field based on the user ID
            echo "UPDATE Benutzer SET $art = $aenderung WHERE BenutzerID = $userID";
            $updateStmt = $con->prepare("UPDATE Benutzer SET $art = :new WHERE BenutzerID = :userID");
            $updateStmt->bindParam(':new', $aenderung);
            $updateStmt->bindParam(':userID', $userID);
            $updateStmt->execute();

            echo "Benutzer erfolgreich aktualisiert.";

            // ... your existing code ...
        }
    } catch (PDOException $e) {
        $error_message = "DB-Verbindungsfehler: " . $e->getMessage();
    } finally {
        unset($con);
        sleep(3);

// Leite auf eine andere Seite weiter
header("Location: ../Anmeldung.php");
exit;
    }

    if (isset($error_message) && $error_message !== "") {
        echo $error_message;
    }
} else {
    echo "Das Formular wurde nicht korrekt abgeschickt.";
}



?>