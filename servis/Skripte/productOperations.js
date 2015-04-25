

function addProduct(){

    var url = "http://zamger.etf.unsa.ba/wt/proizvodi.php?brindexa=16390";
    var prompt1 = prompt("Unesite id", 000000);
    var idProduct;
    if(prompt1 != null){
        idProduct = prompt1;
    }
    var prompt2 = prompt("Unesite naziv", "proizvod x");
    var nazivProduct;
    if(prompt2 != null){
        nazivProduct = prompt2;
    }
    var product = {
        id: idProduct,
        naziv: nazivProduct
    };
    var requestObject = new XMLHttpRequest();
    requestObject.onreadystatechange = function() {
        if (requestObject.readyState == 4 && requestObject.status == 200)
        {
            alert('Uspjesan unos!');
        }
    }
    requestObject.open("POST", url, true);
    requestObject.send("akcija=dodavanje" + "&brindexa=16390" + "&proizvod=" + JSON.stringify(product));
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
            for(var i = 0; i < productData.length; i++){
                var currRow = table.insertRow();
                var firstCell = currRow.insertCell(i);
                firstCell.innerHTML = productData[i].id;
                var secondCell = currRow.insertCell(i + 1);
                secondCell.innerHTML = productData[i].naziv;
            }
        }
    }
    requestObject.open("GET", url, true);
    requestObject.send();
}
