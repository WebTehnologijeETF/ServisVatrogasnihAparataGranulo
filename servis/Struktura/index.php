<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="/servis/Stilovi/stylerevised.css">
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
             <?php include('printnavbar.php'); ?>
         </div>
         </div>
        <div id="news_container" class="container">
         <div id="news_div" class="newsDivNormalState">
		 	<?php if(isset($_GET['poslan'])){ 
				$porukada = 'Hvala što ste nas kontaktirali!';
				$porukane = 'Servis trenutno nije dostupan.';
				if($_GET['poslan'] == 'da')
				echo '<h1 class="news_header">' . $porukada  . '</h1>';
				else echo '<h1 class="news_header">' . $porukane  . '</h1>';	
			}?>
			<?php include('novosti.php');?>
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