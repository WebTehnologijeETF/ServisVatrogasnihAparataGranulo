
function show(popupDivID) {
    document.getElementById(popupDivID).style.display = "block";
    window.onscroll = function () {
        window.scrollTo(0, 0);
    }
}

function hide(popupDivID){
    document.getElementById(popupDivID).style.display = "none";
    window.onscroll = null;
}