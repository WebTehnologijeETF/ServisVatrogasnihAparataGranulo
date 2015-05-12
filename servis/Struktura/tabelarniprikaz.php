<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="/servis/Stilovi/tablestyle.css">
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
           <?php include('printnavbar.php'); ?>
        </div>
    </div>
    <div id="table_container">
        <p id="news_item3" class="news_item">Ovo je naš cjenovnik zajedno sa količinama pojedinih artikala.<br>
        Sve cijene su u KM.</p>
        <div id="table_div">
            <table class="tableStyle">
                <tr class="headerRow" >
                    <td class="tableheaderdata" colspan="3">Cjenovnik</td>
                </tr>
                <tr>
                    <td class="tabledata">Artikal</td>
                    <td class="tabledata">Cijena</td>
                    <td class="tabledata">Količina</td>
                </tr>
                <tr>
                    <td class="tabledata">Aparat CO2 5kg</td>
                    <td class="tabledata">30,00 KM</td>
                    <td class="tabledata">10 kom.</td>
                </tr>
                <tr>
                    <td class="tabledata">Aparat S9 Gloria</td>
                    <td class="tabledata">15,00 KM</td>
                    <td class="tabledata">15 kom.</td>
                </tr>
                <tr>
                    <td class="tabledata">Aparat S6 Pastor</td>
                    <td class="tabledata">13,00 KM</td>
                    <td class="tabledata">10 kom.</td>
                </tr>
                <tr>
                    <td class="tabledata">Aparat P9 Felix</td>
                    <td class="tabledata">15,00 KM</td>
                    <td class="tabledata">10 kom.</td>
                </tr>
                <tr>
                    <td class="tabledata">Aparat 50 kg</td>
                    <td class="tabledata">100,00 KM</td>
                    <td class="tabledata">10 kom.</td>
                </tr>
            </table>
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