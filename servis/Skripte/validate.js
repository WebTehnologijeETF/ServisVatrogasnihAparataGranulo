
function validateInput(){

    if( document.inputForm.Name.value == "")
    {
        alert( "Morate unijeti ime!" );
        document.inputForm.Name.focus();
        return false;
    }
    if(containsNumbers(document.inputForm.Name.value)){
        alert( "Ime ne smije sadržavati brojeve!" );
        document.inputForm.Name.focus();
        return false;
    }
    if(!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(document.inputForm.Email.value))
    {
        alert( "Unesite email u pravom formatu!" );
        document.inputForm.Email.focus();
        return false;
    }
    if(document.inputForm.Poruka.value == ""){
        alert( "Morate unijeti tekst poruke!" );
        document.inputForm.Name.focus();
        return false;
    }


}

function containsNumbers(string){

    for(var i = 0; i < string.length; i++){
        var charOfString = string.charAt(i);
        if(!isNaN(charOfString)) return true;
    }
}

function setToValueFromCmbBox(){
    var tbToSet = document.inputForm.Tip;
    var cmbBox = document.inputForm.Predmet;
    var valueCmb = cmbBox.options[cmbBox.selectedIndex].text;
    if(valueCmb == "Ponuda" || valueCmb == "Kupovina") tbToSet.value = "Pravno lice";
    else tbToSet.value = "Pravno/Fizičko lice";
}