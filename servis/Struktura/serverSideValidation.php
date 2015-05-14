<?php

/* Skripta za validaciju u slučaju da je korisnik iskljucio JS ili koristi stariji browser bez podrske za HTML5
 * Slanje maila na egranulo2@etf.unsa.ba
 */

// Funkcija za validaciju imena
function validateName($name){
	if($name == "") return false;
	else if(containsNumbers($name)) return false;
	else return true;	
}

// Funkcija za validaciju emaila
function validateEmail($email){
	return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Funkcija za validaciju broja telefona
function validateBrojtel($phone_number){
	if($phone_number != ""){
		if(strlen($phone_number) != 9) return false;
		else if(!containsNumbers($phone_number)) return false;
		else return true;	
	}
	else{
		return true;
	}
}

// Funkcija za validaciju tipa 
function validateTip($tip){
	if($tip == "") return false;
	else{
		if($tip != "Pravno lice" && $tip != "Pravno/Fizičko lice"){
			return false;
		}
		else{
			return true;
		}
	}
}

// Funkcija za validaciju poruke
function validatePoruka($poruka){
	if($poruka == "") return false;
	return true;
}

function containsNumbers($string){
	return ctype_digit($string); // ugradjena funkcija provjerava da li se string sastoji samo od brojeva
}

function validateAll($name, $mail, $poruka, $tip, $brojtel){
	return validateName($name) && validateEmail($mail) && validatePoruka($poruka) && validateTip($tip) && validateBrojtel($brojtel);
}

function isFormSubmitted(){
	return ($_SERVER['REQUEST_METHOD'] == 'POST');
}

function printError($errorType){
	if($errorType == "NemaImena") echo "Ime nije validno(sadrzi brojeve ili specijalne znakove ili ga niste unijeli";
	else if($errorType == "ImeBrojeviZnakovi") echo "Ime ne smije sadržavati brojeve i specijalne znakove";
	else if($errorType == "Tip") echo "Morate izabrati tip";
	else if($errorType == "Telefon") echo "Telefon nije u pravom formatu";
	else if($errorType == "Email") echo "E - mail nije validan";
	else if($errorType == "Poruka") echo "Morate unijeti poruku";
}

?>