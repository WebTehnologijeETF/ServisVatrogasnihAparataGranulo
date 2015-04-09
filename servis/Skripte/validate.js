


function validateInput(){
    var isValid = true;
    var mailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    /* clear textarea spaces */
    textArea = document.inputForm.Poruka.value;
    textArea = textArea.replace(/(^\s*)|(\s*$)/gi,"");
    textArea = textArea.replace(/[ ]{2,}/gi," ");
    textArea = textArea.replace(/\n /,"\n");
    document.inputForm.Poruka.value = textArea;
    if( document.inputForm.Name.value == "")
    {
        document.inputForm.Name.setCustomValidity("Morate unijeti ime!");
        document.inputForm.Name.focus();
        isValid = false;
    }
    else if(containsNumbers(document.inputForm.Name.value)){
        document.inputForm.Name.setCustomValidity( "Ime ne smije sadržavati brojeve!");
        document.inputForm.Name.focus();
        isValid = false;
    }
    else{
        document.inputForm.Name.setCustomValidity("");
    }
    if(document.inputForm.Email.value == "" || document.inputForm.Email.value == null){
        document.inputForm.Email.setCustomValidity("Morate unijeti e - mail!" );
        document.inputForm.Email.focus();
        isValid = false;
    }
    else if(!mailRegex.test(document.inputForm.Email.value))
    {
        document.inputForm.Email.setCustomValidity("Unesite email u pravom formatu!" );
        document.inputForm.Email.focus();
        isValid = false;
    }
    else{
        document.inputForm.Email.setCustomValidity("");
    }

    if(document.inputForm.Brojtel.value != ""){
        if(document.inputForm.Brojtel.value.length != 9){
            document.inputForm.Brojtel.setCustomValidity("Telefon mora imati 9 cifara!");
            document.inputForm.Brojtel.focus();
            isValid = false;
        }
        else if(!containsNumbers(document.inputForm.Brojtel.value)){
            document.inputForm.Brojtel.setCustomValidity("Telefon ne smije sadrzavati slova, brojeve i specijalne znakove!");
            document.inputForm.Brojtel.focus();
            isValid = false;
        }
        else{
            document.inputForm.Brojtel.setCustomValidity("");
        }
    }

    if(document.inputForm.Poruka.value == ""){
        document.inputForm.Poruka.setCustomValidity("Morate unijeti tekst poruke!");
        document.inputForm.Poruka.focus();
        isValid = false;
    }
    else{
        document.inputForm.Poruka.setCustomValidity("");
    }

    if(document.inputForm.Tip.value == ""){
        document.inputForm.Poruka.setCustomValidity("Morate izabrati tip!");
        document.inputForm.Poruka.focus();
        isValid = false;
    }
    else{
        document.inputForm.Poruka.setCustomValidity("");
    }

    return isValid;
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

function clearCustomValidity(){
    var elements = document.inputForm.elements;
    for(var i = 0; i < elements.length; i++){
        elements[i].setCustomValidity("");
    }
}
