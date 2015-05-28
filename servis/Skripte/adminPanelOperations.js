function fillEditNews(newsArray)
{
	var comboBox = document.getElementById('edit_news_combo');
	var selectedIndex = comboBox.selectedIndex;
	var naslovTF = document.getElementById('naslov_edit_input');
	var autorTF = document.getElementById('autor_edit_input');
	var slikaTF = document.getElementById('slika_edit_input');
	var opisTF = document.getElementById('opis_edit_input');
	var detaljnijeTF = document.getElementById('detaljnije_edit_input');
	var jsonArray = newsArray[selectedIndex];
	naslovTF.value = jsonArray["Naslov"];
	autorTF.value = jsonArray["Autor"];
	opisTF.value = jsonArray["Opis"];
	detaljnijeTF.value = jsonArray["Detaljna"];
	slikaTF.value = jsonArray["Slika"];
}