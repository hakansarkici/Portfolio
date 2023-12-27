<?php 
    session_start();
    session_destroy();
    echo "Destroy";
            sleep(3);

// Leite auf eine andere Seite weiter
header("Location: ../Anmeldung.php");
exit;
?>