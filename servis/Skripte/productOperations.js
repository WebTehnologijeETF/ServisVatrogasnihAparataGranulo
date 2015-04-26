/* Quick product validation functions */
function validateName(name){
    if(containsNumbers(name)) return "Brojevi";
    if(name == "") return "Prazno";
}

function containsNumbers(string){

    for(var i = 0; i < string.length; i++){
        var charOfString = string.charAt(i);
        if(!isNaN(charOfString)) return true;
    }
}

function validateAmount(amount){
    if(amount < 0) return "Negativna";
    else if(isNaN(amount)) return "Nijebroj";
}

function validateURL(url){
    return(url.match(/\.(jpeg|jpg|gif|png)$/) != null);
}

function validateFields(name, url, amount){
    if(validateName(name) == "Brojevi") {
        document.form.naziv.setCustomValidity("Ime ne smije sadržavati brojeve!");
        return false;
    }
    else if(validateName(name) == "Prazno"){
        document.form.naziv.setCustomValidity("Morate unijeti ime!");
        return false;
    }
    else{
        document.form.naziv.setCustomValidity("");
    }
    if(validateAmount(amount) == "Negativna"){
        document.form.kolicina.setCustomValidity("Kolicina ne moze biti negativna!");
        return false;
    }
    else if(validateAmount(amount) == "Nijebroj"){
        document.form.kolicina.setCustomValidity("Kolicina moze biti samo broj!");
        return false;
    }
    else{
        document.form.kolicina.setCustomValidity("");
    }
    if(!validateURL(url) && url != ""){
        document.form.url.setCustomValidity("URL ne pokazuje na sliku!");
        return false;
    }
    else if(url == ""){
        document.form.url.setCustomValidity("Morate unijeti URL!");
        return false;
    }
    else{
        document.form.url.setCustomValidity("");
    }
    return true;
}

function addProduct(){

    var isValid = true;
    var url = "http://zamger.etf.unsa.ba/wt/proizvodi.php?brindexa=16390";

    var amount = document.form.kolicina.value;
    var naziv = document.form.naziv.value;
    var slikaurl = document.form.url.value;

    var validity = validateFields(naziv, slikaurl, amount);
    if(!validity) return false;
    var product = {
        naziv: naziv,
        kolicina: amount,
        slika: slikaurl
    };
    var requestObject = new XMLHttpRequest();
    requestObject.onreadystatechange = function(event) {
        if (requestObject.readyState == 4 && requestObject.status == 200)
        {
            alert('Uspjesan unos!');
            loadProducts();
            event.preventDefault();
        }
    }
    requestObject.open("POST", url, false);
    requestObject.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    requestObject.send("akcija=dodavanje" + "&brindexa=16390&proizvod=" + JSON.stringify(product));
}

function deleteProduct(productID){

}

function updateProduct(productID){

}

function loadProducts(){
    var requestObject = new XMLHttpRequest();
    var url = "http://zamger.etf.unsa.ba/wt/proizvodi.php?brindexa=16390";
    requestObject.onreadystatechange = function () {
        if(requestObject.readyState == 4 && requestObject.status == 200){
            var productData = JSON.parse(requestObject.responseText);
            var table = document.getElementById('productsTable');
            table.innerHTML = "";
            var columnNameRow = table.insertRow();
            for(var x = 0; x < 4; x++){
                var cell;
                if(x == 0){
                    cell = columnNameRow.insertCell(0);
                    cell.innerHTML = "ID proizvoda";
                    cell.className = cell.className + " tabledata";
                }
                else if(x == 1){
                    cell = columnNameRow.insertCell(1);
                    cell.innerHTML = "Naziv proizvoda";
                    cell.className = cell.className + " tabledata";
                }
                else if(x == 2){
                    cell = columnNameRow.insertCell(2);
                    cell.innerHTML = "Količina proizvoda";
                    cell.className = cell.className + " tabledata";
                }
                else{
                    cell = columnNameRow.insertCell(3);
                    cell.innerHTML = "Slika proizvoda";
                    cell.className = cell.className + " tabledata";
                }
            }
                for (var i = 0; i < productData.length; i++) {
                    var currRow = table.insertRow();
                    var firstCell;
                    firstCell = currRow.insertCell(0);
                    firstCell.className = firstCell.className + " tabledata";
                    firstCell.innerHTML = productData[i].id;
                    var secondCell = currRow.insertCell(1);
                    secondCell.className = firstCell.className + " tabledata";
                    secondCell.innerHTML = productData[i].naziv;
                    var thirdCell = currRow.insertCell(2);
                    thirdCell.className = firstCell.className + " tabledata";
                    thirdCell.innerHTML = productData[i].kolicina;
                    var imageCell = currRow.insertCell(3);
                    imageCell.className = imageCell.className + " tabledata";
                    imageCell.innerHTML = "<img src='" +  productData[i].slika + "' alt='Slika nije ucitana' />";
                }

        }
    }
    requestObject.open("GET", url, true);
    requestObject.send();
}

function initialLoadWithHidePopup(){
    hide('addProductPopup');
    loadProducts();
}