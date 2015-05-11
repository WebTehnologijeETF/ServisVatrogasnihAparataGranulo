<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="/servis/Stilovi/contactstyle.css">
    <script type="text/javascript" src="/servis/Skripte/jquery.js"></script>
    <script type="text/javascript" src="/servis/Skripte/dropit.js"></script>
    <script type="text/javascript" src="/servis/Skripte/validate.js"></script>
    <script type="text/javascript" src="/servis/Skripte/SinglePageConversion.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Granulo - RE d.o.o</title>
</head>
<body>
<div id="wrapper_div" class="container">
    <div id="header_div">
        <img id="header_logo_image" src="/servis/Resursi/Slike/header_logo.png" alt="Slika nije ucitana">
    </div>
    <div id="navbar_container" class="container">
        <div id="navbar_div" class="nav">
            <ul id="lista_meni">
                <li ><a class="djelatnost" onclick="AjaxLoadJQuery('/servis/Struktura/indexrevised.html')">NOVOSTI</a></li>
                <li ><a class="djelatnost" onclick="AjaxLoadJQuery('/servis/Struktura/tabelarniprikaz.html')">CJENOVNIK</a></li>
                <li id="drpdown" ><a class="djelatnost" onclick="AjaxLoadJQuery('/servis/Struktura/ostalo.html')">NAŠI PARTNERI</a>
                    <ul >
                        <li><a class="djelatnost" href="http://www.abcfireinc.net/">ABC Fire Inc.</a></li>
                        <li><a class="djelatnost" href="http://www.abcofire.com/">ABCO Fire</a></li>
                        <li><a class="djelatnost" href="http://www.silcofireprotection.com/">Silco Fire Protection</a></li>
                    </ul>
                </li>
                <li ><a class="djelatnost" onclick="AjaxLoadJQuery('/servis/Struktura/ostalo.html')">NAŠE USLUGE</a></li>
                <li ><a class="djelatnost" onclick="AjaxLoadJQuery('/servis/Struktura/ostalo.html')">REFERENCE</a></li>
                <li ><a class="djelatnost" onclick="AjaxLoadJQuery('/servis/Struktura/kontakt.php')">KONTAKT</a></li>
                <li ><a class="djelatnost" onclick="AjaxLoadJQuery('/servis/Struktura/proizvodi.html')">PROIZVODI</a></li>
            </ul>
        </div>
    </div>
    <div id="contact_container" class="container">
        <?php include('C:/wamp/www/servis/Skripte/serverSideValidation.php'); ?>
		<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && validateAll($_POST['Name'], $_POST['Email'], $_POST['Poruka'], $_POST['Tip'], $_POST['Brojtel'])){ include('C:/wamp/www/servis/Skripte/showInputs.php'); } ?>
        <div id="contact_div">
            <form id="contact_form" name="inputForm" action="kontakt.php" method="post" class="formElements">
                <label>Vaše ime</label><br>
                <input type="text" name="Name" class="individualFormElement" id="cf_name" <?php if(isFormSubmitted()) echo 'value="' .$_POST['Name'] . '"';?>><span id="nameError" <?php if(isFormSubmitted() && !validateName($_POST['Name'])) echo 'class="spanErrorClass"'; ?>><?php if(isFormSubmitted()){ if(!validateName($_POST['Name'])) printError("NemaImena"); } ?></span><br>
                <label>Vaša e - mail adresa</label><br>
                <input type="text" id="cf_email" class="individualFormElement" name="Email" <?php if(isFormSubmitted()) echo 'value="' .$_POST['Email'] . '"';?>><span id="emailError" <?php if(isFormSubmitted() && !validateEmail($_POST['Email'])) echo 'class="spanErrorClass"'; ?>><?php if(isFormSubmitted()){ if(!validateEmail($_POST['Email'])) printError("Email"); } ?></span><br>
                <label>Vaša opština</label><br>
                <input type="text" name="Opstina" class="individualFormElement" id="cf_opstina"><br>
                <label>Vaš grad</label><br>
                <input type="text" name="Grad" class="individualFormElement" id="cf_grad"><br>
                <label>Vaš broj telefona</label><br>
                <input type="text" id="cf_brojtel" class="individualFormElement" name="Brojtel" <?php if(isFormSubmitted()) echo 'value="' .$_POST['Brojtel'] . '"';?>><span id="brojtelError" <?php if(isFormSubmitted() && !validateBrojtel($_POST['Brojtel'])) echo 'class="spanErrorClass"'; ?>><?php if(isFormSubmitted()){ if(!validateBrojtel($_POST['Brojtel'])) printError("Telefon"); } ?></span><br>
                <label>Predmet poruke</label><br>
                <select name="Predmet" class="individualFormElement" id="cf_predmet" onchange="setToValueFromCmbBox()">
                    <option value="Ponuda">Ponuda</option>
                    <option value="Kupovina">Kupovina</option>
                    <option value="Pohvala">Pohvala</option>
                    <option value="Zalba">Žalba</option>
                </select><span id="predmetError"></span><br>
                <label>Tip komitenta</label><br>
                <input name="Tip" class="individualFormElement" type="text" id="cf_tip" <?php if(isFormSubmitted()) echo 'value="' .$_POST['Tip'] . '"';?> readOnly><span id="tipError" <?php if(isFormSubmitted() && !validateTip($_POST['Tip'])) echo 'class="spanErrorClass"'; ?>><?php if(isFormSubmitted()){ if(!validateEmail($_POST['Tip'])) printError("Tip"); } ?></span><br>
                <label>Poruka</label><br>
                <textarea name="Poruka" id="cf_message"> <?php if(isFormSubmitted()) echo $_POST['Poruka'];?>
                </textarea><span id="porukaError" <?php if(isFormSubmitted() && !validatePoruka($_POST['Poruka'])) echo 'class="spanErrorClass"'; ?>><?php if(isFormSubmitted()){ if(!validatePoruka($_POST['Poruka'])) printError("Poruka"); } ?></span><br>
                <input type="submit" class="individualFormElement" id="submitButton" name="submitButton" value="Pošalji" onclick="validateInput();">
            </form>
        </div>
    </div>
    <div class="clearfooter"></div>
</div>
<div id="footer_div">
    <img id="footer_image" src="/servis/Resursi/slike/footer_bg.png" alt="Slika nije ucitana">
    <p id="footer_text" class="djelatnost">Copyright &copy; Eldar Granulo 2015.</p>
</div>
</body>
</html>