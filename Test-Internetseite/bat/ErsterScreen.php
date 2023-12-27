<?php if(!isset($_SESSION)){session_start();}?>

<!-- Contact Form-->
<section class="section">
    <div class="container">
        <form style=" display: grid;
            gap: 15px;" method="post" action="./Anmeldung.php">
            <input style="padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 100%;
            box-sizing: border-box;" id="name" type="text" name="name">
            <label style="display: block;
            margin-bottom: 5px;
            text-align: left;" for="name">Name</label>
            <input style="padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 100%;
            box-sizing: border-box;" id="passwort" type="password" name="passwort">
            <label style="display: block;
            margin-bottom: 5px;
            text-align: left;" for="passwort">Passwort</label>
            <button style="background-color: #2fafdd;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;" type="submit">Anmelden</button>
        </form>
    </div>

    <div class="container">
        <button style="background-color: #2fafdd;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;" href="#modalCta" data-toggle="modal">Registrieren</button>
    </div>
</section>


<div class="modal fade" id="modalCta" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Registrieren</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form style=" display: grid;gap: 15px;" method="post" action="bat/Registrierung.php">
                    <input
                        style="padding: 10px;border: 1px solid #ccc;border-radius: 4px;width: 100%;box-sizing: border-box;"
                        id="contact-modal-name" type="text" name="name">
                    <label style="display: block;margin-bottom: 5px;text-align: left;"
                        for="contact-modal-name">Name</label>
                    <input
                        style="padding: 10px;border: 1px solid #ccc;border-radius: 4px;width: 100%;box-sizing: border-box;"
                        id="contact-modal-name" type="text" name="passwort">
                    <label style="display: block;margin-bottom: 5px;text-align: left;"
                        for="contact-modal-phone">Passwort</label>
                    <input
                        style="padding: 10px;border: 1px solid #ccc;border-radius: 4px;width: 100%;box-sizing: border-box;"
                        id="contact-modal-email" type="email" name="email">
                    <label style="display: block;margin-bottom: 5px;text-align: left;"
                        for="contact-modal-email">E-mail</label>
                    <input
                        style="padding: 10px;border: 1px solid #ccc;border-radius: 4px;width: 100%;box-sizing: border-box;"
                        id="contact-modal-phone" type="text" name="phone">
                    <label style="display: block;margin-bottom: 5px;text-align: left;"
                        for="contact-modal-phone">Telefonnummer</label>
                    <input
                        style="padding: 10px;border: 1px solid #ccc;border-radius: 4px;width: 100%;box-sizing: border-box;"
                        id="contact-modal-name" type="text" name="addr">
                    <label style="display: block;margin-bottom: 5px;text-align: left;"
                        for="contact-modal-name">Straße</label>
                    <input
                        style="padding: 10px;border: 1px solid #ccc;border-radius: 4px;width: 100%;box-sizing: border-box;"
                        id="contact-modal-phone" type="text" name="hausnr">
                    <label style="display: block;margin-bottom: 5px;text-align: left;"
                        for="contact-modal-phone">Hausnummer</label>
                    <input
                        style="padding: 10px;border: 1px solid #ccc;border-radius: 4px;width: 100%;box-sizing: border-box;"
                        id="contact-modal-phone" type="text" name="plz">
                    <label style="display: block;margin-bottom: 5px;text-align: left;"
                        for="contact-modal-phone">Postleitzahl</label>
                    <input
                        style="padding: 10px;border: 1px solid #ccc;border-radius: 4px;width: 100%;box-sizing: border-box;"
                        id="contact-modal-name" type="text" name="stadt">
                    <label style="display: block;margin-bottom: 5px;text-align: left;"
                        for="contact-modal-name">Stadt</label>
                    <input
                        style="padding: 10px;border: 1px solid #ccc;border-radius: 4px;width: 100%;box-sizing: border-box;"
                        id="contact-modal-phone" type="text" name="vname">
                    <label style="display: block;margin-bottom: 5px;text-align: left;"
                        for="contact-modal-phone">Vorname</label>
                    <input
                        style="padding: 10px;border: 1px solid #ccc;border-radius: 4px;width: 100%;box-sizing: border-box;"
                        id="contact-modal-name" type="text" name="nname">
                    <label style="display: block;margin-bottom: 5px;text-align: left;"
                        for="contact-modal-name">Nachname</label>
                    <button
                        style="background-color: #2fafdd;color: #fff;padding: 10px 20px;border: none;border-radius: 4px;cursor: pointer;"
                        type="submit">Registrieren</button>
                </form>
            </div>
        </div>
    </div>
</div>