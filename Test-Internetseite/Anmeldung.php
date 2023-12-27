<?php                 
    session_start();
?>

<!DOCTYPE html>
<html class="wide wow-animation" lang="en">

<head>
    <title>Anmeldung</title>
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
    <style>
    .ie-panel {
        display: none;
        background: #212121;
        padding: 10px 0;
        box-shadow: 3px 3px 5px 0 rgba(0, 0, 0, .3);
        clear: both;
        text-align: center;
        position: relative;
        z-index: 1;
    }

    html.ie-10 .ie-panel,
    html.lt-ie-10 .ie-panel {
        display: block;
    }
    </style>
</head>

<body>
    <div class="ie-panel"><a href=http://windows.microsoft.com/en-US/internet-explorer /><img
            src="images/ie8-panel/warning_bar_0000_us.jpg" height="42" width="820"
            alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today."></a>
    </div>
    <div class="preloader">
        <div class="preloader-body">
            <div class="cssload-container"><span></span><span></span><span></span><span></span>
            </div>
        </div>
    </div>
    <div class="page">
        <div id="anmeldung">
            <!--Page Header-->
            <header class="section page-header">
                <!-- RD Navbar-->
                <div class="rd-navbar-wrap">
                    <nav class="rd-navbar rd-navbar-classic" data-layout="rd-navbar-fixed"
                        data-sm-layout="rd-navbar-fixed" data-md-layout="rd-navbar-fixed"
                        data-md-device-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-static"
                        data-lg-device-layout="rd-navbar-fixed" data-xl-layout="rd-navbar-static"
                        data-xl-device-layout="rd-navbar-static" data-xxl-layout="rd-navbar-static"
                        data-xxl-device-layout="rd-navbar-static" data-lg-stick-up-offset="46px"
                        data-xl-stick-up-offset="46px" data-xxl-stick-up-offset="46px" data-lg-stick-up="true"
                        data-xl-stick-up="true" data-xxl-stick-up="true">
                        <div class="rd-navbar-main-outer">
                            <div class="rd-navbar-main">
                                <!-- RD Navbar Panel-->
                                <div class="rd-navbar-panel">
                                    <!-- RD Navbar Toggle-->
                                    <button class="rd-navbar-toggle"
                                        data-rd-navbar-toggle=".rd-navbar-nav-wrap"><span></span></button>
                                    <!-- RD Navbar Brand-->
                                    <div class="rd-navbar-brand"><a class="brand" href="index.html"><img
                                                src="images/logo_klein_Fotor.png" alt width="210" height="40" /></a>
                                    </div>
                                </div>
                                <div class="rd-navbar-main-element">
                                    <div class="rd-navbar-nav-wrap">
                                        <!-- RD Navbar Share-->
                                        <div class="rd-navbar-share fl-bigmug-line-share27"
                                            data-rd-navbar-toggle=".rd-navbar-share-list">
                                            <ul class="list-inline rd-navbar-share-list">
                                                <li class="rd-navbar-share-list-item"><a class="icon fa fa-facebook"
                                                        href="#"></a></li>
                                                <li class="rd-navbar-share-list-item"><a class="icon fa fa-twitter"
                                                        href="#"></a></li>
                                                <li class="rd-navbar-share-list-item"><a class="icon fa fa-google-plus"
                                                        href="#"></a></li>
                                                <li class="rd-navbar-share-list-item"><a class="icon fa fa-instagram"
                                                        href="#"></a></li>
                                            </ul>
                                        </div>
                                        <ul class="rd-navbar-nav">
                                            <li class="rd-nav-item active"><a class="rd-nav-link"
                                                    href="./index.html">Home</a></li>
                                            <li class="rd-nav-item"><a class="rd-nav-link"
                                                    href="./OP.html">Öffnungszeiten & Preise</a></li>
                                            <li class="rd-nav-item"><a class="rd-nav-link" href="./Events.html">Events
                                                    und Aktuelles</a></li>
                                            <li class="rd-nav-item"><a class="rd-nav-link" href="./shop.html">Shop</a>
                                            </li>
                                            <li class="rd-nav-item"><a class="rd-nav-link"
                                                    href="./Dienstleistungen.php">Dienstleistungen</a></li>
                                            <li class="rd-nav-item"><a class="rd-nav-link"
                                                    href="#anmeldung">Anmelden</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
            </header><br><br>

            <?php 
            
            if(!isset($_SESSION)){session_start();}

                if(isset($_POST['name'])){
                    $_SESSION['anmeldename']=$_POST['name'];
                }
                if(isset($_POST['passwort'])){
                    $_SESSION['pw']=$_POST['passwort'];
                }
                
                
                if (isset($_SESSION['anmeldename']) && isset($_SESSION['pw'])) {
                    $name = $_POST['name'];
                    $passwort = $_POST['passwort'];
                    $hostname = '127.0.0.1';
                    $username = 'root';
                    $password = 'mysql123';
                    $databasename = 'deineDatenbank';
                    $charset = 'utf8mb4';
                    $error_message = "";



                    try {
                        $con = new PDO("mysql:host=$hostname;dbname=$databasename;charset=$charset", $username, $password);
                        // Prepare the SQL statement
                        //$result = $con->query("SELECT * FROM Benutzer");
                        $stmt = $con->query("SELECT * FROM Benutzer WHERE Benutzername = '$name' AND Passwort = '$passwort'");
                        // Bind parameters
                        // Fetch the result

                        foreach ($stmt as $row) {// Use single quotes inside the double quotes
                            /*echo $row['BenutzerID']."<br>";
                            echo $row['Benutzername']."<br>";*/

                            $_SESSION['BenutzerID']= $row['BenutzerID'];
                            $_SESSION['anmeldename']=$row['Benutzername'];
                            /*echo $_SESSION['BenutzerID']."<br>";
                            echo $_SESSION['anmeldename']."<br>";*/
                            $_SESSION['pw']=$row['Passwort'];
                            $_SESSION['email']=$row['Email'];
                            $_SESSION['telefon']=$row['Telefonnummer'];
                            $_SESSION['stra']=$row['Straße'];
                            $_SESSION['hausnr']=$row['Hausnummer'];
                            $_SESSION['plz']=$row['Postleitzahl'];
                            $_SESSION['stadt']=$row['Stadt'];
                            $_SESSION['vorname']=$row['Vorname'];
                            $_SESSION['nachname']=$row['Nachname']; //MitarbeiterID
                        }
                    } catch (PDOException $e) {
                        $error_message = "DB-Verbindungsfehler: " . $e->getMessage();
                    } finally {
                        unset($con);
                    }
  
 
 
                    // Display the error message
                    if ($error_message !== "") {
                        echo $error_message;
                    }
          
          
                }
                      

                if (isset($_SESSION["anmeldename"])) {
                    require('bat/Inhalte.php');
                }else{
                    require('bat/ErsterScreen.php');
                }
            ?>


            <!-- Page Footer--><br><br>
            <footer class="section section-fluid footer-minimal context-dark">
                <div class="bg-gray-15">
                    <div class="container-fluid">
                        <div class="footer-minimal-inset oh">
                            <ul class="footer-list-category-2">
                                <li><a href="./sessausgabe.php">Segitz-Therme<br>Ottostraße 22<br>90762 Fürth</a></li>
                                <li><a href="#">Info@segitz-therme.de</a></li>
                                <li><a href="#">+49 174 973 4062</a></li>
                            </ul>
                        </div>
                        <div class="footer-minimal-bottom-panel text-sm-left">
                            <div class="row row-10 align-items-md-center">
                                <div class="col-sm-6 col-md-4 text-sm-right text-md-center">
                                    <div>
                                        <ul class="list-inline list-inline-sm footer-social-list-2">
                                            <li><a class="icon fa fa-facebook" href="#"></a></li>
                                            <li><a class="icon fa fa-twitter" href="#"></a></li>
                                            <li><a class="icon fa fa-google-plus" href="#"></a></li>
                                            <li><a class="icon fa fa-instagram" href="#"></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4 order-sm-first">
                                    <!-- Rights-->
                                    <p class="rights"><span>&copy;&nbsp;</span><span class="copyright-year"></span>
                                        <span>Gruppe-2</span>
                                    </p>
                                </div>
                                <div class="col-sm-6 col-md-4 text-md-right"><span>All
                                        rights reserved.</span> <span>Design&nbsp;by&nbsp;<a
                                            href=https://www.google.de>Projekt-Gruppe-2</a></span>
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
        <!-- coded by Himic-->
</body>

<div class="modal fade" id="modalanmeldename" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Benutzername Ändern</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form style=" display: grid;gap: 15px;" method="post" action="bat/aendern.php">
                    <input
                        style="padding: 10px;border: 1px solid #ccc;border-radius: 4px;width: 100%;box-sizing: border-box;"
                        id="contact-modal-name" type="text" name="name">
                    <label style="display: block;margin-bottom: 5px;text-align: left;"
                        for="contact-modal-name">Name</label>
                    <input type="hidden" name="id" value="<?php echo $_SESSION['BenutzerID'];?>">
                    <input type="hidden" name="art" value="Benutzername">
                    <button
                        style="background-color: #2fafdd;color: #fff;padding: 10px 20px;border: none;border-radius: 4px;cursor: pointer;"
                        type="submit">Ändern</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalpw" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Passwort Ändern</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form style=" display: grid;gap: 15px;" method="post" action="bat/aendern.php">
                    <input
                        style="padding: 10px;border: 1px solid #ccc;border-radius: 4px;width: 100%;box-sizing: border-box;"
                        id="contact-modal-name" type="text" name="name">
                    <label style="display: block;margin-bottom: 5px;text-align: left;"
                        for="contact-modal-name">Passwort</label>
                    <input type="hidden" name="id" value="<?php echo $_SESSION['BenutzerID'];?>">
                    <input type="hidden" name="art" value="Passwort">
                    <button
                        style="background-color: #2fafdd;color: #fff;padding: 10px 20px;border: none;border-radius: 4px;cursor: pointer;"
                        type="submit">Ändern</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalemail" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Email Ändern</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form style=" display: grid;gap: 15px;" method="post" action="bat/aendern.php">
                    <input
                        style="padding: 10px;border: 1px solid #ccc;border-radius: 4px;width: 100%;box-sizing: border-box;"
                        id="contact-modal-name" type="text" name="name">
                    <label style="display: block;margin-bottom: 5px;text-align: left;"
                        for="contact-modal-name">Email</label>
                    <input type="hidden" name="id" value="<?php echo $_SESSION['BenutzerID'];?>">
                    <input type="hidden" name="art" value="Email">
                    <button
                        style="background-color: #2fafdd;color: #fff;padding: 10px 20px;border: none;border-radius: 4px;cursor: pointer;"
                        type="submit">Ändern</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modaltelefon" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Telefonnummer Ändern</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form style=" display: grid;gap: 15px;" method="post" action="bat/aendern.php">
                    <input
                        style="padding: 10px;border: 1px solid #ccc;border-radius: 4px;width: 100%;box-sizing: border-box;"
                        id="contact-modal-name" type="text" name="name">
                    <label style="display: block;margin-bottom: 5px;text-align: left;"
                        for="contact-modal-name">Telefonnummer</label>
                    <input type="hidden" name="id" value="<?php echo $_SESSION['BenutzerID'];?>">
                    <input type="hidden" name="art" value="Telefonnummer">
                    <button
                        style="background-color: #2fafdd;color: #fff;padding: 10px 20px;border: none;border-radius: 4px;cursor: pointer;"
                        type="submit">Ändern</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalstra" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Straße Ändern</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form style=" display: grid;gap: 15px;" method="post" action="bat/aendern.php">
                    <input
                        style="padding: 10px;border: 1px solid #ccc;border-radius: 4px;width: 100%;box-sizing: border-box;"
                        id="contact-modal-name" type="text" name="name">
                    <label style="display: block;margin-bottom: 5px;text-align: left;"
                        for="contact-modal-name">Straße</label>
                    <input type="hidden" name="id" value="<?php echo $_SESSION['BenutzerID'];?>">
                    <input type="hidden" name="art" value="Straße">
                    <button
                        style="background-color: #2fafdd;color: #fff;padding: 10px 20px;border: none;border-radius: 4px;cursor: pointer;"
                        type="submit">Ändern</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalhausnr" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Hausnummer Ändern</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form style=" display: grid;gap: 15px;" method="post" action="bat/aendern.php">
                    <input
                        style="padding: 10px;border: 1px solid #ccc;border-radius: 4px;width: 100%;box-sizing: border-box;"
                        id="contact-modal-name" type="text" name="name">
                    <label style="display: block;margin-bottom: 5px;text-align: left;"
                        for="contact-modal-name">Hausnummer</label>
                    <input type="hidden" name="id" value="<?php echo $_SESSION['BenutzerID'];?>">
                    <input type="hidden" name="art" value="Hausnummer">
                    <button
                        style="background-color: #2fafdd;color: #fff;padding: 10px 20px;border: none;border-radius: 4px;cursor: pointer;"
                        type="submit">Ändern</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalplz" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Postleitzahl Ändern</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form style=" display: grid;gap: 15px;" method="post" action="bat/aendern.php">
                    <input
                        style="padding: 10px;border: 1px solid #ccc;border-radius: 4px;width: 100%;box-sizing: border-box;"
                        id="contact-modal-name" type="text" name="name">
                    <label style="display: block;margin-bottom: 5px;text-align: left;"
                        for="contact-modal-name">Postleitzahl</label>
                    <input type="hidden" name="id" value="<?php echo $_SESSION['BenutzerID'];?>">
                    <input type="hidden" name="art" value="Postleitzahl">
                    <button
                        style="background-color: #2fafdd;color: #fff;padding: 10px 20px;border: none;border-radius: 4px;cursor: pointer;"
                        type="submit">Ändern</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalstadt" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Stadt Ändern</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form style=" display: grid;gap: 15px;" method="post" action="bat/aendern.php">
                    <input
                        style="padding: 10px;border: 1px solid #ccc;border-radius: 4px;width: 100%;box-sizing: border-box;"
                        id="contact-modal-name" type="text" name="name">
                    <label style="display: block;margin-bottom: 5px;text-align: left;"
                        for="contact-modal-name">Stadt</label>
                    <input type="hidden" name="id" value="<?php echo $_SESSION['BenutzerID'];?>">
                    <input type="hidden" name="art" value="Stadt">
                    <button
                        style="background-color: #2fafdd;color: #fff;padding: 10px 20px;border: none;border-radius: 4px;cursor: pointer;"
                        type="submit">Ändern</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalvorname" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Vorname Ändern</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form style=" display: grid;gap: 15px;" method="post" action="bat/aendern.php">
                    <input
                        style="padding: 10px;border: 1px solid #ccc;border-radius: 4px;width: 100%;box-sizing: border-box;"
                        id="contact-modal-name" type="text" name="name">
                    <label style="display: block;margin-bottom: 5px;text-align: left;"
                        for="contact-modal-name">Vorname</label>
                    <input type="hidden" name="id" value="<?php echo $_SESSION['BenutzerID'];?>">
                    <input type="hidden" name="art" value="Vorname">
                    <button
                        style="background-color: #2fafdd;color: #fff;padding: 10px 20px;border: none;border-radius: 4px;cursor: pointer;"
                        type="submit">Ändern</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalnachname" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Nachname Ändern</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form style=" display: grid;gap: 15px;" method="post" action="bat/aendern.php">
                    <input
                        style="padding: 10px;border: 1px solid #ccc;border-radius: 4px;width: 100%;box-sizing: border-box;"
                        id="contact-modal-name" type="text" name="name">
                    <label style="display: block;margin-bottom: 5px;text-align: left;"
                        for="contact-modal-name">Nachname</label>
                    <input type="hidden" name="id" value="<?php echo $_SESSION['BenutzerID'];?>">
                    <input type="hidden" name="art" value="Nachname">
                    <button
                        style="background-color: #2fafdd;color: #fff;padding: 10px 20px;border: none;border-radius: 4px;cursor: pointer;"
                        type="submit">Ändern</button>
                </form>
            </div>
        </div>
    </div>
</div>

</html>