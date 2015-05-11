<?php_

/* Skripta za validaciju u slučaju da je korisnik iskljucio JS ili koristi stariji browser bez podrske za HTML5
 * Slanje maila na egranulo2@etf.unsa.ba
 */

 // Konstante
 $containsNumbersRegex = '#[0-9]#';
 
// Funkcija za postavljanje span elementa greske i sakrivanje istog
function displayErrorSpan($span_id, $error_msg){

}

function hideErrorSpan($span_id){
	
}
 
// Funkcija za validaciju imena
function validateName($name){
	if($name == ""){
		displayErrorSpan('nameError', 'Morate unijeti ime');
		return false;
	}
	else if(containsNumbers($name)) {
		displayErrorSpan('nameError', 'Ime ne smije sadržavati brojeve');
		return false;
	}
	else{
		hideErrorSpan('nameError');
		return true;
	}
}

// Funkcija za validaciju emaila
function validateEmail($email){
	return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Funkcija za validaciju broja telefona
function validateBrojtel($phone_number){
	if($phone_number != ""){
		if(strlen($phone_number) != 9){
			displayErrorSpan('phoneError', 'Telefon mora imati 9 cifara');
			return false;
		}
		else if(!containsNumbers($phone_number)){
			displayErrorSpan('phoneError', 'Telefon smije sadrzavati samo brojeve');
			return false;
		}
		else{
			hideErrorSpan('phoneError');
			return true;
		}
	}
	else{
		hideErrorSpan('phoneError');
		return true;
	}
}

// Funkcija za validaciju tipa 
function validateTip($tip){
	if($tip == ""){
		displayErrorSpan('tipError', 'Morate izabrati tip');
		return false;
	}
	else{
		if($tip != "Pravno lice" && $tip != "Pravno/Fizičko lice"){
			displayErrorSpan('tipError', 'Tip nije validan!');
			return false;
		}
		else{
			hideErrorSpan('tipError');
			return true;
		}
	}
}

// Funkcija za validaciju poruke
function validatePoruka($poruka){
	if($poruka == ""){
		displayErrorSpan('porukaError', 'Morate unijeti tekst poruke');
		return false;
	}
	hideErrorSpan('porukaError');
	return true;
}

function containsNumbers($string){
	return ctype_digit($string); // ugradjena funkcija provjerava da li se string sastoji samo od brojeva
}

// Preuzimanje podataka iz forme i spasavanje u varijable
$name = $_POST["Name"];
$brojtel = $_POST["Brojtel"];
$tip = $_POST["Tip"];
$mail = $_POST["Email"];
$poruka = $_POST["Poruka"];

$validity = validateBrojtel($brojtel) && validateEmail($mail) && validateName($name) && validateTip($tip) && validatePoruka($poruka);

//Forma je validna
	if($validity){
		// posalji na stranicu za potvrdu
	}
//Forma nije validna
	else{
		// reloadaj page i prikazi sve greske
	}

?>