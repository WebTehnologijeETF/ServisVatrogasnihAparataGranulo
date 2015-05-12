function dropItDown() {
		var menulist = document.getElementById('drpdownlist');
		menulist.style.visibility = "visible";
    }

function pullItBack() {
	var menulist = document.getElementById('drpdownlist');
	menulist.style.visibility = "hidden";
}

function addEventListenersToBody(){
	document.getElementById('drpdown').onmouseover = function() { dropItDown();};
	document.getElementById('drpdown').onmouseout = function () { pullItBack(); };
	textArea = document.inputForm.Poruka.value;
    if(textArea != null) {
        textArea = textArea.replace(/(^\s*)|(\s*$)/gi, "");
        textArea = textArea.replace(/[ ]{2,}/gi, " ");
        textArea = textArea.replace(/\n /, "\n");
        document.inputForm.Poruka.value = textArea;
    }
}