<?php
if(!isset($_SESSION)){session_start();}
var_dump($_SESSION);
echo session_id();
/*
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
    echo $sessionKey. ;
}*/

?>


