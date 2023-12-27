<section class="section">
    <h3>Benutzer</h3>
    <a href=' bat/unset.php '><button type='submit' style='background-color: #2fafdd; color: #fff; padding: 10px 20px; 
    border: none; border-radius: 4px; cursor: pointer;'>Abmelden</button></a>
    <div class="container">
        <table class="table">
            <br><br>
            <tbody>
                <?php
                if(!isset($_SESSION)){session_start();}
                $attributes = array(
                    "Name" => "anmeldename",
                    "Passwort" => "pw",
                    "Email" => "email",
                    "Telefon" => "telefon",
                    "Straße" => "stra",
                    "Hausnummer" => "hausnr",
                    "Postleitzahl" => "plz",
                    "Stadt" => "stadt",
                    "Vorname" => "vorname",
                    "Nachname" => "nachname"
                );

                foreach ($attributes as $label => $sessionKey) {
                    echo "<tr>
                            <td>$label:</td>
                            <td>" . (isset($_SESSION[$sessionKey]) ? $_SESSION[$sessionKey] : "Nicht verfügbar") . "</td>
                            <td>
                                <button style='background-color: #2fafdd; color: #fff; padding: 10px 20px; 
                                border: none; border-radius: 4px; cursor: pointer;'data-toggle='modal' data-target='#modal".$sessionKey."'>Ändern</button>
                            </td>
                        </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</section>


<?php

    $name = $_POST['name'];
    $passwort = $_POST['passwort'];
    $hostname = '127.0.0.1';
    $username = 'root';
    $password = 'mysql123';
    $databasename = 'deineDatenbank';
    $charset = 'utf8mb4';
    $error_message = "";
    $BenutzerID = $_SESSION['BenutzerID'];



    try {
        $con = new PDO("mysql:host=$hostname;dbname=$databasename;charset=$charset", $username, $password);
        $stmt = $con->prepare("SELECT * FROM Einkaeufe WHERE benutzerid = :BenutzerID");
        $stmt->bindParam(':BenutzerID', $BenutzerID, PDO::PARAM_INT);
        $stmt->execute();
    
        echo '<section class="section">
                <h3>Käufe</h3>
                <div class="container">
                    <table class="table">
                    <br><br>
                        <tbody>';
    
        foreach ($stmt as $row) {
            echo "<tr>
                    <td>EinkaufID:</td>
                    <td>{$row['EinkaufID']}</td>
                </tr>
                <tr>
                    <td>ProduktName:</td>
                    <td>{$row['ProduktName']}</td>
                </tr>
                <tr>
                    <td>Menge:</td>
                    <td>{$row['Menge']}</td>
                </tr>
                <tr>
                    <td>Preis:</td>
                    <td>{$row['Preis']}</td>
                </tr>
                <tr>
                    <td>Einkaufsdatum:</td>
                    <td>{$row['Einkaufsdatum']}</td>
                </tr>";
        }
    
        echo '</tbody>
                </table>
            </div>
        </section>';
    } catch (PDOException $e) {
        $error_message = "DB-Verbindungsfehler: " . $e->getMessage();
    } finally {
        unset($con);
    }
    


try {
    $con = new PDO("mysql:host=$hostname;dbname=$databasename;charset=$charset", $username, $password);

    // Massagen
    $stmtMassagen = $con->prepare("SELECT * FROM Massagen WHERE KundeID = :BenutzerID");
    $stmtMassagen->bindParam(':BenutzerID', $BenutzerID, PDO::PARAM_INT);
    $stmtMassagen->execute();

    echo '<section class="section">
            <h3>Massagen</h3>
            <div class="container">
                <table class="table">
                <br><br>
                    <tbody>';

    foreach ($stmtMassagen as $row) {
        $attributes = array(
            "Slot" => $row['Slot'],
            "Massageart" => $row['MassageArt'],
            "MassageID" => $row['MassageID']
            // Add more attributes as needed
        );

        foreach ($attributes as $label => $value) {
            echo "<tr>
                    <td>$label:</td>
                    <td>$value</td>
                </tr>";
        }
        echo "<tr>
                <td><form method='POST' action ='bat/massageaendern.php'>
                <input type='hidden' name='MassageID' value='{$row['MassageID']}'>
                <button style='background-color: #2fafdd; color: #fff; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; type='submit'>Stornieren</button>
                </form></td>
            </tr>";
    }

    echo '</tbody>
            </table>
        </div>
    </section>';

    // Lounges
    $stmtLounges = $con->prepare("SELECT * FROM Lounges WHERE KundeID = :BenutzerID");
    $stmtLounges->bindParam(':BenutzerID', $BenutzerID, PDO::PARAM_INT);
    $stmtLounges->execute();

    echo '<section class="section">
            <h3>Lounges</h3>
            <div class="container">
                <table class="table">
                    <br><br>
                    <tbody>';

    foreach ($stmtLounges as $row) {
        $attributes = array(
            "LoungeID" => $row['LoungeID'],
            "Slot" => $row['Slot']
            // Add more attributes as needed
        );

        foreach ($attributes as $label => $value) {
            echo "<tr>
                    <td>$label:</td>
                    <td>$value</td>
                </tr>";
        }
        echo "<tr>
                <td><form method='POST' action ='bat/loungeaendern.php'>
                <input type='hidden' name='LoungeID' value='{$row['LoungeID']}'>
                <button style='background-color: #2fafdd; color: #fff; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; type='submit'>Stornieren</button>
                </form></td>
            </tr>";
    }

    echo '</tbody>
            </table>
        </div>
    </section>';
} catch (PDOException $e) {
    $error_message = "DB-Verbindungsfehler: " . $e->getMessage();
} finally {
    unset($con);
}

// Display the error message
if ($error_message !== "") {
    echo $error_message;
}


    /*echo $_SESSION['anmeldename']."<br>";
    echo $_SESSION['anmeldename']."<br>";
    echo session_id();*/

?>