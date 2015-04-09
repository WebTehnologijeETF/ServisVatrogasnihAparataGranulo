
function validateInput(){

    if( document.inputForm.Name.value == "" )
    {
        alert( "Please provide your name!" );
        document.inputForm.Name.focus() ;
        return false;
    }
    if(!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(document.inputForm.Email.value))
    {
        alert( "Unesite email u pravom formatu!" );
        document.inputForm.Email.focus() ;
        return false;
    }

}
