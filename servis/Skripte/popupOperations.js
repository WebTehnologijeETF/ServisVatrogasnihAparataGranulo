
function show(popupDivID) {
    document.getElementById(popupDivID).style.display = "block";
	window.scrollTo(0, 0);
    window.onscroll = function () {
        window.scrollTo(0, 0);
    }
}

function showWithId(popupDivID, id) {
    document.getElementById(popupDivID).style.display = "block";
	window.scrollTo(0, 0);
    window.onscroll = function () {
        window.scrollTo(0, 0);
    }
}

function hide(popupDivID){
    document.getElementById(popupDivID).style.display = "none";
    window.onscroll = null;
}