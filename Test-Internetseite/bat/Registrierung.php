<?php
// bat/Registrierung.php
if(!isset($_SESSION)){session_start();}

// Überprüfe, ob das Formular abgeschickt wurde
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Hole die POST-Daten
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $phone = htmlspecialchars($_POST["phone"]);
    $passwort = htmlspecialchars($_POST["passwort"]);
    $adresse = htmlspecialchars($_POST["addr"]);
    $hausnummer = htmlspecialchars($_POST["hausnr"]);
    $postleitzahl = htmlspecialchars($_POST["plz"]);
    $stadt = htmlspecialchars($_POST["stadt"]);

    // Validiere die Eingaben
    if (empty($name) || empty($email) || empty($passwort) || empty($adresse) || empty($hausnummer) || empty($postleitzahl) || empty($stadt)) {
        // Wenn ein erforderliches Feld leer ist, zeige einen Fehler an
        echo "Bitte füllen Sie alle erforderlichen Felder aus.";
    } elseif (!preg_match("/^[a-zA-Z]+$/", $name)) {
        echo "Der Name sollte nur Buchstaben enthalten.";
    } elseif (strlen($passwort) < 8 || !preg_match("/[a-zA-Z]/", $passwort) || !preg_match("/[0-9]/", $passwort)) {
        echo "Das Passwort sollte mindestens 8 Zeichen enthalten und Buchstaben sowie Zahlen.";
    } elseif (!preg_match("/^[0-9]{5}$/", $postleitzahl)) {
        echo "Die Postleitzahl sollte genau 5 Ziffern enthalten.";
    } elseif (!preg_match("/^[a-zA-Z]+$/", $stadt)) {
        echo "Die Stadt sollte nur Buchstaben enthalten.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Wenn die E-Mail-Adresse nicht gültig ist, zeige einen Fehler an
        echo "Bitte geben Sie eine gültige E-Mail-Adresse ein.";
    } elseif (!is_numeric($phone)) {
        // Wenn die Telefonnummer keine Zahl ist, zeige einen Fehler an
        echo "Die Telefonnummer sollte eine numerische Zahl sein.";
    } elseif (!is_numeric($hausnummer) || !is_numeric($postleitzahl)) {
        // Wenn Hausnummer oder Postleitzahl keine Zahlen sind, zeige einen Fehler an
        echo "Hausnummer und Postleitzahl sollten numerische Werte sein.";
    } else {
        // Alle Validierungen sind erfolgreich, hier kannst du die Daten speichern oder weiterverarbeiten
        echo "Die Registrierung war erfolgreich!";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $phone = htmlspecialchars($_POST["phone"]);
    $passwort = htmlspecialchars($_POST["passwort"]);
    $addr = htmlspecialchars($_POST["addr"]);
    $hausnr = htmlspecialchars($_POST["hausnr"]);
    $plz = htmlspecialchars($_POST["plz"]);
    $stadt = htmlspecialchars($_POST["stadt"]);
    $vname = htmlspecialchars($_POST["vname"]);
    $nname = htmlspecialchars($_POST["nname"]);
    $mitnr = '0';

    $hostname = '127.0.0.1';
    $username = 'root';
    $password = 'mysql123';
    $databasename = 'deineDatenbank';
    $charset = 'utf8mb4';

    $error_message = "";

    try {
        $con = new PDO("mysql:host=$hostname;dbname=$databasename;charset=$charset", $username, $password);

        $stmt = $con->prepare("SELECT * FROM Benutzer WHERE Benutzername = :name");
        $stmt->bindParam(':name', $name);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo "Benutzername bereits vergeben.";
        } else {
            $insertStmt = $con->prepare("INSERT INTO Benutzer (Benutzername, Passwort, Email, Telefonnummer, Strasse, Hausnummer, Postleitzahl, Stadt, Vorname, Nachname, MitarbeiterID) VALUES (:name, :passwort, :email, :phone, :addr, :hausnr, :plz, :stadt, :vname, :nname, :mitnr)");
            $insertStmt->bindParam(':name', $name);
            $insertStmt->bindParam(':passwort', $passwort);
            $insertStmt->bindParam(':email', $email);
            $insertStmt->bindParam(':phone', $phone);
            $insertStmt->bindParam(':addr', $addr);
            $insertStmt->bindParam(':hausnr', $hausnr);
            $insertStmt->bindParam(':plz', $plz);
            $insertStmt->bindParam(':stadt', $stadt);
            $insertStmt->bindParam(':vname', $vname);
            $insertStmt->bindParam(':nname', $nname);
            $insertStmt->bindParam(':mitnr', $mitnr);
            $insertStmt->execute();

            echo "Benutzer erfolgreich erstellt.";
            
        }
    } catch (PDOException $e) {
        $error_message = "DB-Verbindungsfehler: " . $e->getMessage();
    } finally {
        unset($con);
        echo "Benutzer erfolgreich erstellt.";
            sleep(3);

// Leite auf eine andere Seite weiter
header("Location: ../Anmeldung.php");
exit;
    }

    if ($error_message !== "") {
        echo $error_message;
    }
} else {
    echo "Das Formular wurde nicht korrekt abgeschickt.";
}



    }
} else {
    // Das Formular wurde nicht abgeschickt, handle dies entsprechend
    echo "Das Formular wurde nicht korrekt abgeschickt.";
}







?>