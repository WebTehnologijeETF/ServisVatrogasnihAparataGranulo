<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="/servis/Stilovi/stylerevised.css">
	<link rel="stylesheet" href="/servis/Stilovi/contactstyle.css">
    <script type="text/javascript" src="/servis/Skripte/dropit.js"></script>
    <script type="text/javascript" src="/servis/Skripte/SinglePageConversion.js"></script>
	<script type="text/javascript" src="/servis/Skripte/popupOperations.js"></script>
	<script type="text/javascript" src="/servis/Skripte/rest_functions.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Granulo - RE d.o.o</title>
</head>
<body onload="addEventListenersToBody()">
    <div id="wrapper_div" class="container">
         <div id="header_div">
             <img id="header_logo_image" src="/servis/Resursi/Slike/header_logo.png" alt="Slika nije ucitana">
         </div>
        <div id="navbar_container" class="container">
         <div id="navbar_div" class="nav">
             <?php include('printnavbar.php'); ?>
         </div>
         </div>
        <div id="news_container" class="container">
         <div id="news_div" class="newsDivOneNewsItemComments">
		 	<form id="komentar_forma" name="komentar_forma" action="index.php" class="formElementsComment" method="post" >
				<label id="ime_label">Vaše ime</label><br>
				<input type="text" class="individualFormElement" id="ime_input" name="Autor" value="" required/><br>
				<label id="email_label">Vaš email</label><br>
				<input type="text" class="individualFormElement" id="email_input" name="Email" value=""/><br>
				<label id="email_label">Vaš komentar</label><br>
				<textarea name="Komentar" class="individualFormElement" id="komentar_input"> 
                </textarea><br>
				<input type="hidden" id="idvijesti" name="idVijesti" value="<?php if(isset($_GET["idVijesti"])) echo $_GET["idVijesti"]; ?>"/><br>
				<input type="button" class="individualFormElement" id="commentSubmit" name="commentSubmit" onclick="dodajKomentar(); return false;" value="Ostavi komentar">
			</form>
         </div>
        </div>
        <div class="clearfooter"></div>
    </div>
    <div id="footer_div">
            <img id="footer_image" src="/servis/Resursi/Slike/footer_bg.png" alt="Slika nije ucitana">
            <p id="footer_text" class="djelatnost"></p>
    </div>
</body>
</html>