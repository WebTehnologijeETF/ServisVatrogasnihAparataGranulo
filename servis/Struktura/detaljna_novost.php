<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="/servis/Stilovi/stylerevised.css">
    <script type="text/javascript" src="/servis/Skripte/jquery.js"></script>
    <script type="text/javascript" src="/servis/Skripte/dropit.js"></script>
    <script type="text/javascript" src="/servis/Skripte/SinglePageConversion.js"></script>
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
             <ul id="lista_meni">
                 <li ><a class="djelatnost" onclick="AjaxLoadJQuery('/servis/Struktura/index.php')">NOVOSTI</a></li>
                 <li ><a class="djelatnost" onclick="AjaxLoadJQuery('/servis/Struktura/tabelarniprikaz.html')">CJENOVNIK</a></li>
                 <li id="drpdown" ><a class="djelatnost" onclick="AjaxLoadJQuery('/servis/Struktura/ostalo.html')">NAŠI PARTNERI</a>
                     <ul id="drpdownlist">
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
        <div id="news_container" class="container">
         <div id="news_div">
			<?php 
				$receivedData = $_POST["news_item"];
				$news_item = json_decode($receivedData, true); // pretvara u asocijativni niz
				echo '<article class="newsContainer">';
				echo '<img src="' . $news_item["slika"] . '" class="news_image" alt=" ">';
				echo '<h1 class="news_header">' . $news_item["naslov"] . '</h1>';
				echo '<p class="authorsAndDate">Autor: ' . $news_item["autor"] . ' ' . 'Datum i vrijeme objave: ' . $news_item["datetime"] . '</p>';
				echo '<p class="news_item">' . $news_item["opis"] . $news_item["detaljnije"] . '</p>';
				echo '</article>';
			?>
         </div>
        </div>
        <div class="clearfooter"></div>
    </div>
    <div id="footer_div">
            <img id="footer_image" src="/servis/Resursi/slike/footer_bg.png" alt="Slika nije ucitana">
            <p id="footer_text" class="djelatnost"></p>
    </div>
</body>
</html>