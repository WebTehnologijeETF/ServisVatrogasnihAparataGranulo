<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="/servis/Stilovi/tablestyle.css">
    <link rel="stylesheet" href="/servis/Stilovi/popupForm.css">
    <script type="text/javascript" src="/servis/Skripte/jquery.js"></script>
    <script type="text/javascript" src="/servis/Skripte/dropit.js"></script>
    <script type="text/javascript" src="/servis/Skripte/SinglePageConversion.js"></script>
    <script type="text/javascript" src="/servis/Skripte/productOperations.js"></script>
    <script type="text/javascript" src="/servis/Skripte/popupOperations.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Granulo - RE d.o.o</title>
</head>
<body onload="initialLoadWithHidePopup(); addEventListenersToBody();">
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
        <p id="tableheader" class="news_item">Pregled proizvoda i njihovih količina</p>
        <div id="table_div">

            <table id="productsTable" class="tableStyle">

            </table>
            <div class="centeredButtons">
                <button type="button" id="popup" onclick="show('addProductPopup')">Dodaj proizvod</button>
                <button type="button" onclick="show('deleteProductPopup')">Ukloni proizvod</button>
                <button type="button" onclick="show('editProductPopup')">Izmijeni podatke</button>
                <button type="button" onclick="loadProducts()">Prikaži sve proizvode</button>
            </div>
        </div>
    </div>
    <div class="blackout">
    </div>
    <div id="deleteProductPopup">
        <div id="deletePopupContact">
            <form id="deleteform" method="post" name="deleteForm">
                <img id="deleteclose" src="/servis/Resursi/Slike/close.png" onclick ="hide('deleteProductPopup');">
                <h2>Brisanje proizvoda</h2>
                <hr>
                <input id="Id" name="idproizvod" placeholder="ID proizvoda" type="text" required>
                <input type="submit" value="Pošalji" class="popupButtons" onclick="deleteProduct(); return false;">
            </form>
        </div>
    </div>
    <div id="addProductPopup">
        <div id="popupContact">
            <form id="form" method="post" name="form">
                <img id="close" src="/servis/Resursi/Slike/close.png" onclick ="hide('addProductPopup');">
                <h2>Dodavanje proizvoda</h2>
                <hr>
                <input id="name" name="naziv" placeholder="Naziv proizvoda" type="text" required>
                <input id="kolicina" name="kolicina" placeholder="Količina proizvoda" type="text" required>
                <input id="url" name="url" placeholder="URL slike" type="text" required>
                <input type="submit" value="Pošalji" class="popupButtons" onclick="addProduct(); return false;">
            </form>
        </div>
        <!-- Popup Div Ends Here -->
    </div>
    <div id="editProductPopup">
    <div id="editPopupContact">
            <form id="editForm" method="post" name="editForm">
                <img id="editClose" src="/servis/Resursi/Slike/close.png" onclick ="hide('editProductPopup');">
                <h2>Izmjena proizvoda</h2>
                <hr>
                <input id="editID" name="editid" placeholder="ID proizvoda" type="text" required>
                <input id="editName" name="editnaziv" placeholder="Naziv proizvoda" type="text" required>
                <input id="editKolicina" name="editkolicina" placeholder="Količina proizvoda" type="text" required>
                <input id="editUrl" name="editurl" placeholder="URL slike" type="text" required>
                <input type="submit" value="Pošalji" class="popupButtons" onclick="updateProduct(); return false;">
            </form>
        </div>
    </div>
    <div class="clearfooter"></div>
</div>
<div id="footer_div">
    <img id="footer_image" src="/servis/Resursi/slike/footer_bg.png" alt="Slika nije ucitana">
</div>
</body>
</html>