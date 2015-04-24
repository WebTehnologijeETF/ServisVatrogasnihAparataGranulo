
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