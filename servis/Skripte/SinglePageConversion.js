
function AjaxLoadJQuery(pageToLoad){
        var requestObject = new XMLHttpRequest();
        requestObject.onreadystatechange = function()
        {
            if (requestObject.readyState == 4 && requestObject.status == 200)
            {
                document.open();
                document.write(requestObject.responseText);
                document.close();
            }
            if (requestObject.readyState == 4 && requestObject.status == 404)
            {
                alert('belaj');
            }
        };
        requestObject.open("GET", pageToLoad, true);
        requestObject.send();
    }
	
function loadSingleNewsItem(jsonData){
		//resize height
		var requestObject = new XMLHttpRequest();
		var news_item = JSON.stringify(jsonData);
        requestObject.onreadystatechange = function()
        {
            if (requestObject.readyState == 4 && requestObject.status == 200)
            {
                document.open();
                document.write(requestObject.responseText);
                document.close();
            }
            if (requestObject.readyState == 4 && requestObject.status == 404)
            {
                alert('belaj');
            }
        };
        requestObject.open("POST", "detaljna_novost.php", true);
		requestObject.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        requestObject.send("news_item=" + news_item);
}