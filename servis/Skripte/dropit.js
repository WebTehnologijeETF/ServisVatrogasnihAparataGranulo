$(document).ready(function() {

    $('#drpdown').bind('mouseover', dropItDown);
    $('#drpdown').bind('mouseout', pullItBack);

    function dropItDown() {
        $('#drpdown').find('ul').css('visibility', 'visible');
    };

    function pullItBack() {
        $('#drpdown').find('ul').css('visibility', 'hidden');
    };
});
