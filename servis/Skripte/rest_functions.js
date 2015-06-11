
function printNewsArticle(article_data)
{
	var articleData = article_data;
	var articleElement = document.createElement('article');
	articleElement.className = 'newsContainer';
	articleElement.id = 'vijest' + articleData.ID;
	document.getElementById('news_div').appendChild(articleElement);
	var imageDivElement = document.createElement('div');
	imageDivElement.className = 'maxDimensionsImage';
	var imageElement = document.createElement('img');
	imageElement.className = 'news_image';
	imageElement.alt = 'Slika nije učitana, pokušajte ponovo!';
	imageElement.src = articleData.Slika;
	imageElement.id = 'slika' + articleData.ID;
	imageDivElement.appendChild(imageElement);
	var newsHeaderElement = document.createElement('h1');
	newsHeaderElement.className = 'news_header';
	newsHeaderElement.innerHTML = articleData.Naslov;
	var paragraphElement = document.createElement('p');
	paragraphElement.id = 'opis' + articleData.ID;
	paragraphElement.className = 'news_item';
	paragraphElement.innerHTML = articleData.Opis;
	articleElement.appendChild(imageDivElement);
	articleElement.appendChild(newsHeaderElement);
	articleElement.appendChild(paragraphElement);
	if(articleData.Detaljnije != null) 
	{
		var detaljnijeLink = document.createElement('a');
		detaljnijeLink.id = 'detaljno' + articleData.ID;
		detaljnijeLink.className = 'detaljnijeLink';
		detaljnijeLink.onclick = 
		function() 
		{ 
			printDetaljnije(articleData.Detaljnije, articleData.ID);
			detaljnijeLink.style.visibility = 'hidden';		
			document.getElementById('hide' + articleData.ID).style.visibility = 'visible';
		}
		detaljnijeLink.innerHTML = "Detaljnije...";
		var hideLinkElement = document.createElement('a');
			hideLinkElement.id = 'hide' + articleData.ID;
			hideLinkElement.className = 'detaljnijeLink';
			hideLinkElement.innerHTML = 'Sakrij detaljnije';
			hideLinkElement.style.visibility = 'hidden';
			hideLinkElement.onclick = 
			function() 
			{
				detaljnijeLink.style.visibility = 'visible';
				document.getElementById('detaljno_p' + articleData.ID).style.visibility = 'hidden';
				hideLinkElement.style.visibility = 'hidden';
			}
			articleElement.appendChild(detaljnijeLink);	
			articleElement.appendChild(hideLinkElement);
	}
	var ostaviKomentarElement = document.createElement('a');
	ostaviKomentarElement.className = 'detaljnijeLink';
	ostaviKomentarElement.href = 'komentar.php?idVijesti=' + articleData.ID;
	ostaviKomentarElement.innerHTML = 'Ostavite komentar...';
	articleElement.appendChild(ostaviKomentarElement);
}

function printComments(comment_data, news_id, print_margin)
{
	var commentData = comment_data;
	var article = document.createElement('article');
	article.className = 'newsContainer';
	article.id = 'komentari' + news_id;
	if(commentData.Email != "" || commentData.Email != null) 
	{ 
		var mailElement = document.createElement('a');
		mailElement.href = 'mailto:' + commentData.Email;
		mailElement.className = 'comment_header';
		mailElement.innerHTML = commentData.Autor;
		article.appendChild(mailElement);
	}
	else
	{
		var mailElement = document.createElement('h1');
		mailElement.className = 'comment_header';
		mailElement.innerHTML = commentData.Autor;
		article.appendChild(mailElement);
	}
	var paragraphElement = document.createElement('p');
	paragraphElement.className = 'comment_show';
	paragraphElement.innerHTML = 'Vrijeme komentara: ' + commentData.Datum;
	article.appendChild(paragraphElement);
	if(commentData.Email != "" || commentData.Email != null) 
	{
		var mail = document.createElement('p');
		mail.className = 'comment_show';
		mail.innerHTML = commentData.Komentar;
		article.appendChild(mail);
	}
	var toInsertAfter = document.getElementById('vijest' + news_id);
	var slika = document.getElementById('slika' + news_id);
	if(print_margin) article.setAttribute("style", "margin-top:" + slika.height.toString() + "px");
	toInsertAfter.appendChild(article);
}

function printCommentCounts(count_data)
{
	var news_id = count_data.Novost;
	var news_item = document.getElementById('vijest' + news_id);
	if(count_data.Broj != 0)
	{
		var countElement = document.createElement('a');
		countElement.id = 'count' + news_id;
		countElement.className = 'comment_item';
		countElement.innerHTML = count_data.Broj + ' komentara';
		countElement.onclick = 
		function()
		{
			loadNewsComments(news_id);
		}
		news_item.appendChild(countElement);
	}
	else 
	{
		var paragraph = document.createElement('p');
		paragraph.className = 'comment_item';
		paragraph.id = 'nema' + news_id;
		paragraph.innerHTML = 'Nema komentara';
		news_item.appendChild(paragraph);
	}
}

function printDetaljnije(detaljnije_data, news_id)
{
	if(document.getElementById('detaljno_p' + news_id) != null){ document.getElementById('detaljno_p' + news_id).style.visibility = 'visible'; return; }
	var detaljno = document.createElement('p');
	detaljno.className = 'news_item';
	detaljno.id = 'detaljno_p' + news_id;
	detaljno.innerHTML = detaljnije_data;
	var toInsertAfter = document.getElementById('opis' + news_id);
	toInsertAfter.appendChild(detaljno);
}

// adding function

function dodajKomentar()
{
	var autor = komentar_forma.Autor.value;
	var email = komentar_forma.Email.value;
	var poruka = document.getElementById('komentar_input').value;
	var idVijesti = komentar_forma.idVijesti.value;
	
	var komentar = {
		Autor: autor,
		Email: email,
		Poruka: poruka,
		ID: idVijesti
	};
	
	var requestObject = new XMLHttpRequest();
    var url = "Servisi/rest_servis.php?akcija=dodajKomentar";
    requestObject.onreadystatechange = function () {
        if(requestObject.readyState == 4 && requestObject.status == 200){
            AjaxLoadJQuery('index.php');
        }
    }
    requestObject.open("POST", url, true);
	requestObject.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    requestObject.send("akcija=dodajKomentar&komentar=" + JSON.stringify(komentar));
}

// end adding function




function loadNewsComments(news_id)
{
	var requestObject = new XMLHttpRequest();
    var url = "Servisi/rest_servis.php?akcija=dajKomentareZaVijest&novost=" + news_id;
    requestObject.onreadystatechange = function () {
        if(requestObject.readyState == 4 && requestObject.status == 200){
            var productData = JSON.parse(requestObject.responseText);
			if(document.getElementById('komentari' + news_id) != null) return;
			for(var i = 0; i < productData.length; i++)
			{
				if(i == 0) printComments(productData[i], news_id, true);
				else printComments(productData[i], news_id, false);
			}
        }
    }
    requestObject.open("GET", url, true);
    requestObject.send();
}

function loadCommentCounts()
{
	var requestObject = new XMLHttpRequest();
    var url = "Servisi/rest_servis.php?akcija=dajBrojKomentara";
    requestObject.onreadystatechange = function () {
        if(requestObject.readyState == 4 && requestObject.status == 200){
            var productData = JSON.parse(requestObject.responseText);
			for(var i = 0; i < productData.length; i++)
			{
				printCommentCounts(productData[i]);
			}
        }
    }
    requestObject.open("GET", url, true);
    requestObject.send();
}

function loadAllNews()
{
	var requestObject = new XMLHttpRequest();
    var url = "Servisi/rest_servis.php?akcija=dajSveVijesti";
    requestObject.onreadystatechange = function () {
        if(requestObject.readyState == 4 && requestObject.status == 200){
            var productData = JSON.parse(requestObject.responseText);
			for(var i = 0; i < productData.length; i++)
			{
				printNewsArticle(productData[i]);
			}
			loadCommentCounts();
			addEventListenersToBody();
        }
    }
    requestObject.open("GET", url, true);
    requestObject.send();
}