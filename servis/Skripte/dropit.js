$(document).ready(function() {

    $('#drpdown').bind('mouseover', dropItDown);
    $('#drpdown').bind('mouseout', pullItBack);

    function dropItDown() {
        $('#drpdown').find('ul').css('visibility', 'visible');
    }

    function pullItBack() {
        $('#drpdown').find('ul').css('visibility', 'hidden');
    }

    textArea = document.inputForm.Poruka.value;
    if(textArea != null) {
        textArea = textArea.replace(/(^\s*)|(\s*$)/gi, "");
        textArea = textArea.replace(/[ ]{2,}/gi, " ");
        textArea = textArea.replace(/\n /, "\n");
        document.inputForm.Poruka.value = textArea;
    }
});
