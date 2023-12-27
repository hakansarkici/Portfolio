<?php

if(!isset($_SESSION)){session_start();}

$hostname = '127.0.0.1';
$username = 'root';
$password = 'mysql123';
$databasename = 'deineDatenbank';
$charset = 'utf8mb4';

$error_message = "";



    try {
        $con = new PDO("mysql:host=$hostname;dbname=$databasename;charset=$charset", $username, $password);


        // Prepare the SQL statement
        $result = $con->query("SELECT * FROM Benutzer");

        //$stmt = $con->query("SELECT * FROM Benutzer WHERE Benutzername = '$name' AND Passwort = '$passwort'");

        // Fetch the result
        foreach ($result as $row) {
            echo $row['Benutzername']; // Use single quotes inside the double quotes
        }

    } catch (PDOException $e) {
        $error_message = "DB-Verbindungsfehler: " . $e->getMessage();
    } finally {
        unset($con);
    }
    


// Display the error message
if ($error_message !== "") {
    echo $error_message;
}/*

$hostname = '127.0.0.1';
$username = 'root';
$password = 'mysql123';
$databasename = 'deineDatenbank';
$charset = 'utf8mb4';

session_start(); // Start or resume a session
$error_message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $passwort = $_POST['passwort'];

    try {
        $con = new PDO("mysql:host=$hostname;dbname=$databasename;charset=$charset", $username, $password);


        // Prepare the SQL statement
        $result = $con->query("SELECT * FROM Benutzer");

        //$stmt = $con->query("SELECT * FROM Benutzer WHERE Benutzername = '$name' AND Passwort = '$passwort'");

        // Fetch the result
        foreach ($stmt as $row) {
            echo $row['Benutzername']; // Use single quotes inside the double quotes
        }

    } catch (PDOException $e) {
        $error_message = "DB-Verbindungsfehler: " . $e->getMessage();
    } finally {
        unset($con);
    }
    

}
// Display the error message
if ($error_message !== "") {
    echo $error_message;
}

*/
?>