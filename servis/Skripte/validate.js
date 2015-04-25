var ended = false;
function validate(){
    if(document.inputForm.Grad.value != "" || document.inputForm.Opstina.value != ""){
        var isTrue = validateInput();
        while(state != 4);
        return isTrue;
    }
    else return validateInput();
}

function clearTextArea(){
    textArea = document.inputForm.Poruka.value;
    textArea = textArea.replace(/(^\s*)|(\s*$)/gi,"");
    textArea = textArea.replace(/[ ]{2,}/gi," ");
    textArea = textArea.replace(/\n /,"\n");
    document.inputForm.Poruka.value = textArea;
}

function validateEmail(){
    var isValid = true;
    var mailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
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
    return isValid;
}

function validateName(){
    var isValid = true;
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
    return isValid;
}

function validateBrojTel(){
    var isValid = true;
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
    return isValid;
}

function validatePoruka(){
    var isValid = true;
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

function validateTip(){
    var isValid = true;
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

function AjaxValidateMjestoOpcina(state){
    var requestObject = new XMLHttpRequest();
    var mjesto = encodeURIComponent(inputForm.Grad.value);
    var opcina_tekst = encodeURIComponent(inputForm.Opstina.value);
    var isValid = true;
    requestObject.open('GET','http://zamger.etf.unsa.ba/wt/mjesto_opcina.php?opcina=' + opcina_tekst + '&mjesto=' + mjesto, true);
    requestObject.onreadystatechange = function()
    {
        if(requestObject.status == 200 && requestObject.readyState == 4){
            var JSONArray = JSON.parse(requestObject.responseText);
            if(JSONArray.greska == "Nepostojeće mjesto"){
                document.inputForm.Grad.setCustomValidity("Mjesto mora postojati!");
                isValid = false;
            }
            else if(JSONArray.greska == "Nepostojeća općina"){
                document.inputForm.Opstina.setCustomValidity("Općina mora postojati!");
                isValid = false;
            }
            else{
                document.inputForm.Opstina.setCustomValidity("");
                document.inputForm.Grad.setCustomValidity("");
            }
            validateWithoutAjax(isValid);
        }
    }
    if(requestObject.readyState == 4) return;
    requestObject.send();
}

function validateWithoutAjax(isValidAjax){
    var $form =  $('#inputForm');
    $form.find('input[type="submit"]').on('click', function(event) {
        event.preventDefault();
        var isValidNoPhone = validateTip() && validateName() && validateEmail()
            && validatePoruka() && isValidAjax;
        var isValidPhone = validateTip() && validateName() && validateEmail()
            && validatePoruka() && validateBrojTel() && isValidAjax;
        if (document.inputForm.Brojtel.value != "") {
            if (isValidPhone) $form.submit();
        }
        else {
            if (isValidNoPhone) $form.submit();
        }
    });
}

function validateInput(){
    clearTextArea();
    var state = 0;
    if(document.inputForm.Grad.value != "" || document.inputForm.Opstina.value != ""){
        var requestObject = new XMLHttpRequest();
        var mjesto = encodeURIComponent(inputForm.Grad.value);
        var opcina_tekst = encodeURIComponent(inputForm.Opstina.value);
        var isValid = true;

        requestObject.onreadystatechange = function()
        {
            if(requestObject.status == 200 && requestObject.readyState == 4){
                var JSONArray = JSON.parse(requestObject.responseText);
                if(JSONArray.greska == "Nepostojeće mjesto"){
                    document.inputForm.Grad.setCustomValidity("Mjesto mora postojati!");
                    isValid = false;
                }
                else if(JSONArray.greska == "Nepostojeća općina"){
                    document.inputForm.Opstina.setCustomValidity("Općina mora postojati!");
                    isValid = false;
                }
                else{
                    document.inputForm.Opstina.setCustomValidity("");
                    document.inputForm.Grad.setCustomValidity("");
                }
                validateWithoutAjax(isValid);
            }
        }
        if(requestObject.readyState == 4) return;
        requestObject.open('GET','http://zamger.etf.unsa.ba/wt/mjesto_opcina.php?opcina=' + opcina_tekst + '&mjesto=' + mjesto, false);
        requestObject.send();
    }
    else{
        if(document.inputForm.Brojtel.value != "") return validateTip() && validateName() && validateEmail()
            && validatePoruka() && validateBrojTel();
        else return validateTip() && validateName() && validateEmail()
            && validatePoruka();
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

function clearCustomValidity(){
    var elements = document.inputForm.elements;
    for(var i = 0; i < elements.length; i++){
        elements[i].setCustomValidity("");
    }
}
