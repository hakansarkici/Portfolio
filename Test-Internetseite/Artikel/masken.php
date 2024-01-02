<?php

                session_start();

                if (isset($_SESSION['anmeldename']) && isset($_SESSION['pw'])) {
                    $_SESSION['Artikel'] = "Gesichtsmasken - 5 Stück";
                    $_SESSION['Preis'] = "7,90 €";
            
                    $href = "../bat/Einkauf.php";
                } else {
                    $href = "../Anmeldung.php";
                }

?>

<!DOCTYPE html>
<html class="wide wow-animation" lang="en">
    <head>
        <title>Shop</title>
        <meta name="format-detection" content="telephone=no">
        <meta name="viewport"
            content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta charset="utf-8">
        <link rel="icon" href="../images/favicon.ico" type="image/x-icon">
        <!-- Stylesheets-->
        <link rel="stylesheet" type="text/css"
            href="//fonts.googleapis.com/css?family=Poppins:400,500,600%7CTeko:300,400,500%7CMaven+Pro:500">
        <link rel="stylesheet" href="../css/bootstrap.css">
        <link rel="stylesheet" href="../css/fonts.css">
        <link rel="stylesheet" href="../css/style.css">
        <style>.ie-panel{display: none;background: #212121;padding: 10px 0;box-shadow: 3px 3px 5px 0 rgba(0,0,0,.3);clear: both;text-align:center;position: relative;z-index: 1;} html.ie-10 .ie-panel, html.lt-ie-10 .ie-panel {display: block;}</style>
    </head>
    <body>
        <div class="ie-panel"><a
                href="http://windows.microsoft.com/en-US/internet-explorer/"><img
                    src="../images/ie8-panel/warning_bar_0000_us.jpg" height="42"
                    width="820"
                    alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today."></a></div>
        <div class="preloader">
            <div class="preloader-body">
                <div class="cssload-container"><span></span><span></span><span></span><span></span>
                </div>
            </div>
        </div>
        <div class="page">
            <div id="shop">
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
                                                class="brand" href="../index.html"><img
                                                    src="../images/logo_klein_Fotor.png"
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
                                                        href="../index.html">Home</a></li>
                                                <li class="rd-nav-item"><a
                                                        class="rd-nav-link"
                                                        href="../Preise.html">Öffnungszeiten & Preise</a></li>
                                                <li class="rd-nav-item"><a
                                                        class="rd-nav-link"
                                                        href="../Events.html">Events und Aktuelles</a></li>
                                                <li class="rd-nav-item"><a
                                                        class="rd-nav-link"
                                                        href="#shop">Shop</a></li>
                                                <li class="rd-nav-item"><a
                                                        class="rd-nav-link"
                                                        href="../Dienstleistungen.html">Dienstleistungen</a></li>
                                                <li class="rd-nav-item"><a
                                                        class="rd-nav-link"
                                                        href="../anmeldung.php">Anmelden</a></li>
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
                        data-parallax-img="../images/shop/banner-shopkln.png" alt="Lageplan">
                        
                        <div
                            class="parallax-content section-xl context-dark bg-overlay-68 bg-mobile-overlay">
                            <div class="container">

                                <!--Überschrift-->
                                 <a href="../shop.html"><h1 class="whiteshadow" style="color: black; text-align: center">Shop</h1></a>
                                
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
                        Willkommen im Segitz-Therme Shop – Ihrem exklusiven Ort für Wohlbefinden und Entspannung. Tauchen Sie ein in unsere vielfältige Auswahl an Produkten, sorgfältig ausgewählt, um Ihr Wellness-Erlebnis zu vervollständigen und die entspannte Atmosphäre unserer Therme zu Ihnen nach Hause zu bringen.
                      <p></p>

                      


                          </div>
                    
                </section>
                
                <div class="article-containe7r">
                    <img src="../images/shop/maske.jpeg" alt="Segitz Massageöl" class="article-image">
                    <h1 class="article-title">Gesichtsmasken - 5 Stück</h1>
                    <p class="article-price">7,90 €</p>

                    
                    <a href="<?= $href ?>"><button type="submit" style="background-color: #2fafdd; color: #fff; padding: 10px 20px; 
                        border: none; border-radius: 4px; cursor: pointer;">Jetzt kaufen</button></a>
                    <p class="article-description">
                        <p>
                        Verwöhnen Sie Ihre Haut mit den Segitz-Therme Gesichtsmasken – eine exklusive Kollektion, die entwickelt wurde, um Ihrer Haut eine sorgfältige Pflege und Erholung zu schenken. Mit einer harmonischen Kombination aus hochwertigen Inhaltsstoffen bieten diese Gesichtsmasken eine regenerierende Auszeit, inspiriert von der einzigartigen Atmosphäre der Segitz-Therme.
                        </p>
                        <p>
                        Jede Maske ist durchdacht formuliert, um verschiedene Hautbedürfnisse zu adressieren. Ob Feuchtigkeitspflege, Revitalisierung oder Entspannung – die Segitz-Therme Gesichtsmasken sind darauf ausgerichtet, Ihrer Haut einen gesunden Glanz zu verleihen und das allgemeine Wohlbefinden zu fördern.</p>
                        
                    </div>
    <div class="article-container">
    <h5>Eigenschaften:</h5>
        
        <li>Set aus 5 Gesichtsmasken für verschiedene Hautbedürfnisse</li>
        <li>Hochwertige Formulierungen für intensive Pflege
        </li>
        <li>Inspiriert von der entspannten Atmosphäre der Segitz-Therme
        </li>
        <li>Revitalisierung und Verwöhnung für Ihre Haut
        </li>
    
    </div>

    
                        
                    </p>    
                  </div>



                <!-- Page Footer-->
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
                                            <span>Hakan Sarkici</span>
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
            <script src="../js/core.min.js"></script>
            <script src="../js/script.js"></script>
            <!-- coded by Himic-->
        </body>
    </html>