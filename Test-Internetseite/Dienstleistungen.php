<?php
                
                session_start();
                $hostname = '127.0.0.1';
                $username = 'root';
                $password = 'mysql123';
                $databasename = 'deineDatenbank';
                $charset = 'utf8mb4';
                
                try {
                    $con = new PDO("mysql:host=$hostname;dbname=$databasename;charset=$charset", $username, $password);
                
                    // Abfrage für alle Massagen
                    $masquery = "SELECT * FROM Massagen";
                    $masstmt = $con->query($masquery);

                    $loquery = "SELECT * FROM Lounges";
                    $lostmt = $con->query($loquery);
                
                } catch (PDOException $e) {
                    $error_message = "DB-Verbindungsfehler: " . $e->getMessage();
                    echo $error_message;
                }
                
                
?>

<!DOCTYPE html>
<html class="wide wow-animation" lang="en">
    <head>
        <title>Dienstleistungen</title>
        <meta name="format-detection" content="telephone=no">
        <meta name="viewport"
            content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta charset="utf-8">
        <link rel="icon" href="images/favicon.ico" type="image/x-icon">
        <!-- Stylesheets-->
        <link rel="stylesheet" type="text/css"
            href="//fonts.googleapis.com/css?family=Poppins:400,500,600%7CTeko:300,400,500%7CMaven+Pro:500">
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/fonts.css">
        <link rel="stylesheet" href="css/style.css">
        <style>.ie-panel{display: none;background: #212121;padding: 10px 0;box-shadow: 3px 3px 5px 0 rgba(0,0,0,.3);clear: both;text-align:center;position: relative;z-index: 1;} html.ie-10 .ie-panel, html.lt-ie-10 .ie-panel {display: block;}</style>
    </head>
    <body>
        <div class="ie-panel"><a
                href="http://windows.microsoft.com/en-US/internet-explorer/"><img
                    src="images/ie8-panel/warning_bar_0000_us.jpg" height="42"
                    width="820"
                    alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today."></a></div>
        <div class="preloader">
            <div class="preloader-body">
                <div class="cssload-container"><span></span><span></span><span></span><span></span>
                </div>
            </div>
        </div>
        <div class="page">
            <div id="dienstleistungen">
                <!--Page Header-->
                <header class="section page-header">
                    <!-- RD Navbar-->
                    <div class="rd-navbar-wrap">
                        <nav class="rd-navbar rd-navbar-classic"
                            data-layout="rd-navbar-fixed"
                            data-sm-layout="rd-navbar-fixed"
                            data-md-layout="rd-navbar-fixed"
                            data-md-device-layout="rd-navbar-fixed"
                            data-lg-layout="rd-navbar-static"
                            data-lg-device-layout="rd-navbar-fixed"
                            data-xl-layout="rd-navbar-static"
                            data-xl-device-layout="rd-navbar-static"
                            data-xxl-layout="rd-navbar-static"
                            data-xxl-device-layout="rd-navbar-static"
                            data-lg-stick-up-offset="46px"
                            data-xl-stick-up-offset="46px"
                            data-xxl-stick-up-offset="46px"
                            data-lg-stick-up="true" data-xl-stick-up="true"
                            data-xxl-stick-up="true">
                            <div class="rd-navbar-main-outer">
                                <div class="rd-navbar-main">
                                    <!-- RD Navbar Panel-->
                                    <div class="rd-navbar-panel">
                                        <!-- RD Navbar Toggle-->
                                        <button class="rd-navbar-toggle"
                                            data-rd-navbar-toggle=".rd-navbar-nav-wrap"><span></span></button>
                                        <!-- RD Navbar Brand-->
                                        <div class="rd-navbar-brand"><a
                                                class="brand" href="index.html"><img
                                                    src="images/logo_klein_Fotor.png"
                                                    alt width="210" height="40" /></a></div>
                                    </div>
                                    <div class="rd-navbar-main-element">
                                        <div class="rd-navbar-nav-wrap">
                                            <!-- RD Navbar Share-->
                                            <div
                                                class="rd-navbar-share fl-bigmug-line-share27"
                                                data-rd-navbar-toggle=".rd-navbar-share-list">
                                                <ul
                                                    class="list-inline rd-navbar-share-list">
                                                    <li
                                                        class="rd-navbar-share-list-item"><a
                                                            class="icon fa fa-facebook"
                                                            href="#"></a></li>
                                                    <li
                                                        class="rd-navbar-share-list-item"><a
                                                            class="icon fa fa-twitter"
                                                            href="#"></a></li>
                                                    <li
                                                        class="rd-navbar-share-list-item"><a
                                                            class="icon fa fa-google-plus"
                                                            href="#"></a></li>
                                                    <li
                                                        class="rd-navbar-share-list-item"><a
                                                            class="icon fa fa-instagram"
                                                            href="#"></a></li>
                                                </ul>
                                            </div>
                                            <ul class="rd-navbar-nav">
                                                <li class="rd-nav-item active"><a
                                                        class="rd-nav-link"
                                                        href="./index.html">Home</a></li>
                                                <li class="rd-nav-item"><a
                                                        class="rd-nav-link"
                                                        href="./OP.html">Öffnungszeiten & Preise</a></li>
                                                <li class="rd-nav-item"><a
                                                        class="rd-nav-link"
                                                        href="./Events.html">Events und Aktuelles</a></li>
                                                <li class="rd-nav-item"><a
                                                        class="rd-nav-link"
                                                        href="./Shop.html">Shop</a></li>
                                                <li class="rd-nav-item"><a
                                                        class="rd-nav-link"
                                                        href="#dienstleistungen">Dienstleistungen</a></li>
                                                <li class="rd-nav-item"><a
                                                        class="rd-nav-link"
                                                        href="./Anmeldung.php">Anmelden</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </nav>
                    </div>
                </header>

                <!-- Banner-->
                <section class="section section-fluid bg-default">
                    
                    <div class="parallax-container"
                        data-parallax-img="images/massage_dienstleistungen.jpeg" alt="Dienstleistungen">
                        
                        <div
                            class="parallax-content section-xl context-dark bg-overlay-68 bg-mobile-overlay">
                            <div class="container">

                                <!--Überschrift-->
                                <h1 class="whiteshadow" style="color: black; text-align: center">Dienstleistungen</h1>
                                
                                <div
                                    class="row row-30 justify-content-end text-right">
                                    
                                    <div class="col-sm-7">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="section section-sm section-fluid bg-default" id="team">
                    <div class="container-fluid">
                    Hier können Sie Ihre Erfahrung von der Entspannung bis zum Genuss erweitern. Unsere Therme bietet 
                    auch eine Vielzahl von Massagen und Körperbehandlungen, um Ihnen ein Gefühl von Wohlbefinden zu 
                    geben. Buchen Sie jetzt Ihre Massage- oder Lounge-Slots und genießen Sie Ihre 
                    Erfahrung von der Entspannung bis zum Genuss.                      
                    <p></p>  
                    </div>
                  </section>

                <section>
                
                <div class="container">
                    <h3>Massagen</h3>
                    <br>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Massagen</th>
                                <th scope="col">Slots</th>
                                <th scope="col">Status</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            while ($row = $masstmt->fetch(PDO::FETCH_ASSOC)) {
                                echo "<tr>";
                                echo "<form method='POST' action ='bat/M_Dienstleistungen.php'>";
                                echo "<td><input type='hidden' name='Massageart' value='{$row['MassageArt']}'>{$row['MassageArt']}</td>";
                                echo "<td><input type='hidden' name='Slot' value='{$row['Slot']}'>{$row['Slot']}</td>";
                                echo "<td><input type='hidden' name='MassageID' value='{$row['MassageID']}'>";

                                if ($row['KundeID'] === null || $row['KundeID'] === 0) {
                                    echo '<span style="color: #039e4e;">frei</span>';
                                } else {
                                    echo '<span style="color: red;">gebucht</span>';
                                }

                                echo "</td>";
                                echo '<td>';
            
                                if ($row['KundeID'] === null || $row['KundeID'] === 0) {
                                    echo '<button type="submit" style="background-color: #2fafdd; color: #fff; padding: 10px 20px; 
                                    border: none; border-radius: 4px; cursor: pointer;">reservieren</button>';
                                } else {
                                    echo '<button type="submit" style="background-color: grey; color: #fff; padding: 10px 20px; 
                                    border: none; border-radius: 4px; cursor: not-allowed;" disabled>belegt</button>';
                                }

                                echo "</td>";
                                echo "</form>";
                                echo "</tr>";
                            }
                        ?>
                        </tbody>
                    </table>
                </div>
            
                <div class="container">
                    <h3>Privat-Lounges</h3>
                    <br>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Slots</th>
                                <th scope="col">Status</th>
                                <th scope="col"></th>
                            </tr>
                        </thead><tbody>
                        <?php
                           while ($row = $lostmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<tr>";
                            echo "<form method='POST' action ='bat/PL_Dienstleistungen.php'>";
                            echo "<td><input type='hidden' name='Slot' value='{$row['Slot']}'>{$row['Slot']}</td>";
                            echo "<td><input type='hidden' name='LoungeID' value='{$row['LoungeID']}'>";
                
                            if ($row['KundeID'] === null || $row['KundeID'] === 0) {
                                echo '<span style="color: #039e4e;">frei</span>';
                            } else {
                                echo '<span style="color: red;">gebucht</span>';
                            }
                
                            echo "</td>";
                            echo '<td>';
                            
                            if ($row['KundeID'] === null || $row['KundeID'] === 0) {
                                echo '<button type="submit" style="background-color: #2fafdd; color: #fff; padding: 10px 20px; 
                                border: none; border-radius: 4px; cursor: pointer;">reservieren</button>';
                            } else {
                                echo '<button type="submit" style="background-color: grey; color: #fff; padding: 10px 20px; 
                                border: none; border-radius: 4px; cursor: not-allowed;" disabled>belegt</button>';
                            }
                
                            echo "</td>";
                            echo "</form>";
                            echo "</tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </section>

                  <!-- Page Footer -->
                <footer
                    class="section section-fluid footer-minimal context-dark">
                    <div class="bg-gray-15">
                        <div class="container-fluid">
                            <div class="footer-minimal-inset oh">
                                <ul class="footer-list-category-2">
                                    <li><a href="#">Segitz-Therme<br>Ottostraße 22<br>90762 Fürth</a></li>
                                    <li><a href="#">Info@segitz-therme.de</a></li>
                                    <li><a href="#">+49 174 973 4062</a></li>
                                </ul>
                            </div>
                            <div
                                class="footer-minimal-bottom-panel text-sm-left">
                                <div class="row row-10 align-items-md-center">
                                    <div
                                        class="col-sm-6 col-md-4 text-sm-right text-md-center">
                                        <div>
                                            <ul
                                                class="list-inline list-inline-sm footer-social-list-2">
                                                <li><a
                                                        class="icon fa fa-facebook"
                                                        href="#"></a></li>
                                                <li><a
                                                        class="icon fa fa-twitter"
                                                        href="#"></a></li>
                                                <li><a
                                                        class="icon fa fa-google-plus"
                                                        href="#"></a></li>
                                                <li><a
                                                        class="icon fa fa-instagram"
                                                        href="#"></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div
                                        class="col-sm-6 col-md-4 order-sm-first">
                                        <!-- Rights-->
                                        <p class="rights"><span>&copy;&nbsp;</span><span
                                                class="copyright-year"></span>
                                            <span>Hakan Sarkici
                                            </span>
                                        </p>
                                    </div>
                                    <div class="col-sm-6 col-md-4 text-md-right"><span>All
                                            rights reserved.</span> <span>Design&nbsp;by&nbsp;<a
                                                href="https://www.google.de">Hakan Sarkici</a></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
            <!-- Global Mailform Output-->
            <div class="snackbars" id="form-output-global"></div>
            <!-- Javascript-->
            <script src="js/core.min.js"></script>
            <script src="js/script.js"></script>
        </body>
    </html>