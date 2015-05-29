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

function clearAdminTextAreas()
{
	var opisAdd = document.DodavanjeVijesti.Opis.value;
	opisAdd = opisAdd.replace(/(^\s*)|(\s*$)/gi,"");
    opisAdd = opisAdd.replace(/[ ]{2,}/gi," ");
    opisAdd = opisAdd.replace(/\n /,"\n");
	document.DodavanjeVijesti.Opis.value = '';
	var opisEdit = document.DodavanjeVijesti.Opis.value;
	opisEdit = opisEdit.replace(/(^\s*)|(\s*$)/gi,"");
    opisEdit = opisEdit.replace(/[ ]{2,}/gi," ");
    opisEdit = opisEdit.replace(/\n /,"\n");
	document.DodavanjeVijesti.Opis_edit.value = '';
	var detaljnijeAdd = document.DodavanjeVijesti.Detaljnije.value;
	detaljnijeAdd = detaljnijeAdd.replace(/(^\s*)|(\s*$)/gi,"");
    detaljnijeAdd = detaljnijeAdd.replace(/[ ]{2,}/gi," ");
    detaljnijeAdd = detaljnijeAdd.replace(/\n /,"\n");
	document.IzmjenaVijesti.Detaljnije.value = '';
	var detaljnijeEdit = document.DodavanjeVijesti.Detaljnije_edit.value;
	detaljnijeEdit = detaljnijeEdit.replace(/(^\s*)|(\s*$)/gi,"");
    detaljnijeEdit = detaljnijeEdit.replace(/[ ]{2,}/gi," ");
    detaljnijeEdit = detaljnijeEdit.replace(/\n /,"\n");
	document.IzmjenaVijesti.Detaljnije_edit.value = '';
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

function validateEmailAdd(){
    var isValid = true;
    var mailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    if(document.DodavanjeKorisnika.Mail.value == "" || document.DodavanjeKorisnika.Mail.value == null){
        document.DodavanjeKorisnika.Mail.setCustomValidity("Morate unijeti e - mail!" );
        document.DodavanjeKorisnika.Mail.focus();
        isValid = false;
    }
    else if(!mailRegex.test(document.DodavanjeKorisnika.Mail.value))
    {
        document.DodavanjeKorisnika.Mail.setCustomValidity("Unesite email u pravom formatu!" );
        document.DodavanjeKorisnika.Mail.focus();
        isValid = false;
    }
    else{
        document.DodavanjeKorisnika.Mail.setCustomValidity("");
    }
    return isValid;
}

function validateEmailEdit(){
    var isValid = true;
    var mailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    if(document.PromjenaKorisnika.Email_user_edit.value == "" || document.PromjenaKorisnika.Email_user_edit.value == null){
        document.PromjenaKorisnika.Email_user_edit.setCustomValidity("Morate unijeti e - mail!" );
        document.PromjenaKorisnika.Email_user_edit.focus();
        isValid = false;
    }
    else if(!mailRegex.test(document.PromjenaKorisnika.Email_user_edit.value))
    {
        document.PromjenaKorisnika.Email_user_edit.setCustomValidity("Unesite email u pravom formatu!" );
        document.PromjenaKorisnika.Email_user_edit.focus();
        isValid = false;
    }
    else{
        document.PromjenaKorisnika.Email_user_edit.setCustomValidity("");
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

function validateUsernameAdd()
{
	var isValid = true;
	var control = document.DodavanjeKorisnika.KorisnickoIme;
    if( control.value == "")
    {
        control.setCustomValidity("Morate unijeti korisničko ime!");
        control.focus();
        isValid = false;
    }
    else if(containsOnlySpaces(control.value)){
        document.inputForm.Name.setCustomValidity( "Korisničko ime ne može biti samo od razmaka!");
        document.inputForm.Name.focus();
        isValid = false;
    }
    else{
        control.setCustomValidity("");
    }
    return isValid;
}

function validatePasswordEdit()
{
	var isValid = true;
	var control = document.PromjenaKorisnika.Pw_user_edit;
    if( control.value == "")
    {
        control.setCustomValidity("Morate unijeti lozinku!");
        control.focus();
        isValid = false;
    }
	return isValid;
}

function validateURL(url){
    return(url.match(/\.(jpeg|jpg|gif|png)$/) != null);
}

function validateNovostAdd()
{
	var isValid = true;
	var naslov = document.DodavanjeVijesti.Naslov.value;
	var autor = document.DodavanjeVijesti.Autor.value;
	var slika = document.DodavanjeVijesti.Slika.value;
	var opis = document.DodavanjeVijesti.Opis.value;
	var detaljno = document.DodavanjeVijesti.Detaljnije.value;
	if(naslov == "") { document.DodavanjeVijesti.Naslov.setCustomValidity("Morate unijeti naslov!"); document.DodavanjeVijesti.Naslov.focus(); isValid = false;}
	else { document.DodavanjeVijesti.Naslov.setCustomValidity("");  }
	if(autor == "") { document.DodavanjeVijesti.Autor.setCustomValidity("Morate unijeti autora!"); document.DodavanjeVijesti.Autor.focus(); isValid = false; }
	else { document.DodavanjeVijesti.Autor.setCustomValidity(""); }
	if(validateURL(slika)) { document.DodavanjeVijesti.Slika.setCustomValidity("Morate unijeti validan URL!"); document.DodavanjeVijesti.Slika.focus(); isValid = false;}
	else { document.DodavanjeVijesti.Slika.setCustomValidity(""); }
	if(opis == "" || !containsOnlySpaces(opis)) { document.DodavanjeVijesti.Opis.setCustomValidity("Morate unijeti opis vijesti!"); document.DodavanjeVijesti.Opis.focus(); isValid = false;}
	else{
		document.DodavanjeVijesti.Opis.setCustomValidity("");
	}
	return isValid;
}

function validateNovostEdit()
{
	var isValid = true;
	var naslov = document.IzmjenaVijesti.Naslov_edit.value;
	var autor = document.IzmjenaVijesti.Autor_edit.value;
	var slika = document.IzmjenaVijesti.Slika_edit.value;
	var opis = document.IzmjenaVijesti.Opis_edit.value;
	var detaljno = document.IzmjenaVijesti.Detaljnije_edit.value;
	if(naslov == "") {document.IzmjenaVijesti.Naslov_edit.setCustomValidity("Morate unijeti naslov!"); document.IzmjenaVijesti.Naslov_edit.focus(); isValid = false;}
	else { document.IzmjenaVijesti.Naslov_edit.setCustomValidity("");  }
	if(autor == "") { document.IzmjenaVijesti.Autor_edit.setCustomValidity("Morate unijeti autora!"); document.IzmjenaVijesti.Autor_edit.focus(); isValid = false; }
	else { document.IzmjenaVijesti.Autor_edit.setCustomValidity(""); }
	if(validateURL(slika)) { document.IzmjenaVijesti.Slika_edit.setCustomValidity("Morate unijeti validan URL!"); document.IzmjenaVijesti.Slika_edit.focus(); isValid = false;}
	else { document.IzmjenaVijesti.Slika.setCustomValidity(""); }
	if(opis == "" || containsOnlySpaces(opis)) { document.IzmjenaVijesti.Opis_edit.setCustomValidity("Morate unijeti opis!"); document.IzmjenaVijesti.Opis_edit.focus(); isValid = false;}
	else{

		document.IzmjenaVijesti.Opis_edit.setCustomValidity("");
	}
	return isValid;
}

function validatePasswordAdd()
{
	var isValid = true;
	var control = document.DodavanjeKorisnika.Lozinka;
    if( control.value == "")
    {
        control.setCustomValidity("Morate unijeti lozinku!");
        control.focus();
        isValid = false;
    }
	else control.setCustomValidity("");
	return isValid;
}

function validateUsernameEdit()
{
	var isValid = true;
	var control = document.PromjenaKorisnika.Username_edit;
    if( control.value == "")
    {
        control.setCustomValidity("Morate unijeti korisničko ime!");
        control.focus();
        isValid = false;
    }
    else if(containsOnlySpaces(control.value)){
        document.inputForm.Name.setCustomValidity( "Korisničko ime ne može biti samo od razmaka!");
        document.inputForm.Name.focus();
        isValid = false;
    }
    else{
        control.setCustomValidity("");
    }
    return isValid;
}

function validateName(control_id, name)
{
	var isValid = true;
	var control = document.getElementById(control_id);
    if( control.value == "")
    {
        control.setCustomValidity("Morate unijeti ime!");
        control.focus();
        isValid = false;
    }
    else if(containsNumbers(control.value)){
        control.setCustomValidity( "Ime ne smije sadržavati brojeve!");
        control.focus();
        isValid = false;
    }
    else{
        control.setCustomValidity("");
    }
    return isValid;
}

function validateEmpty(control_id, string)
{
	var control = document.getElementById(control_id);
	var isValid = true;
	if(string == ""){ control.setCustomValidity("Morate unijeti tekst!"); isValid = false; }
	else control.setCustomValidity("");
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
    var form = document.getElementById('contact_form');
    var isValidNoPhone = validateTip() && validateName() && validateEmail()
        && validatePoruka() && isValidAjax;
    var isValidPhone = validateTip() && validateName() && validateEmail()
        && validatePoruka() && validateBrojTel() && isValidAjax;

    if (document.inputForm.Brojtel.value != "") {
        if (isValidPhone) form.submit();
    }
    else {
        if (isValidNoPhone) form.submit();
    }
}

function validateUsers(username, password, control_id)
{
	return validateUsername(control_id, username) && validateUsername(control_id, password);
}

function validatePassword(password, control_id)
{
	return validateUsername(control_id, password);
}


function validateNovost(control_id, naslov, autor, slika, detaljno)
{
	return (validateEmpty(control_id, naslov) && validateName(control_id, autor) && validateEmpty(control_id, detaljno));
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
        requestObject.open('GET','http://zamger.etf.unsa.ba/wt/mjesto_opcina.php?opcina=' + opcina_tekst + '&mjesto=' + mjesto, true);
        requestObject.send();
    }
    else{
        if(document.inputForm.Brojtel.value != ""){ 
			var valid = validateTip() && validateName() && validateEmail()
            && validatePoruka() && validateBrojTel();
			 var form = document.getElementById('contact_form');
				if(valid) form.submit();
			}
        else{
			var valid = validateTip() && validateName() && validateEmail()
            && validatePoruka();
			var form = document.getElementById('contact_form');
				if(valid) form.submit();
		}
    }
}

function containsNumbers(string){

    for(var i = 0; i < string.length; i++){
        var charOfString = string.charAt(i);
        if(!isNaN(charOfString)) return true;
    }
}

function containsOnlySpaces(string){
	return /^\w+$/.test(string);
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
