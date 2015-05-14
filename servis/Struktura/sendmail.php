<?php
$to = "egranulo2@etf.unsa.ba";
$subject = "Test poruka - kontakt forma";
$name = strip_tags($_POST['Name']);
$mail = strip_tags($_POST['Email']);
$tip = strip_tags($_POST['Tip']);
$poruka = strip_tags($_POST['Poruka']);
/*echo ini_get("SMTP");
ini_set("SMTP", "smtp.sendgrid.net");
ini_set("smtp_port", "587");
ini_set("username", "tzatudw6Tw");
ini_set("password", "Hg7xEVSHaw");
ini_set("auth_username", "tzatudw6Tw");
ini_set("auth_password", "Hg7xEVSHaw");*/
$txt = 'Ime: ' . $name . "\r\n" . 'Email: ' . $mail . "\r\n" . 'Tip: ' . $tip . "\r\n" . 'Poruka: ' . $poruka;
$headers = 'From: egranulo2@etf.unsa.ba CC: khodzic@devlogic.eu' . "\r\n" . 'Reply-To: ' . $mail;
//$isMailSent = mail($to, $subject, $txt, $headers);
//if($isMailSent) header("Location: index.php?poslan=da");
//else header("Location: index.php");

// koristenje sendgrid servisa

$url = 'https://api.sendgrid.com/';
$user = 'tzatudw6Tw';
$pass = 'Hg7xEVSHaw';
$cc = 'khodzic@devlogic.eu';
$params = array(
    'api_user'  => $user,
    'api_key'   => $pass,
    'to'        => 'egranulo2@etf.unsa.ba',
    'subject'   => 'Test kontakt forme - Eldar Granulo',
    'text'      => $txt,
    'from'      => $mail,
	'cc'		=> $cc
  );


$request =  $url.'api/mail.send.json';

// Generate curl request
$session = curl_init($request);
// Tell curl to use HTTP POST
curl_setopt ($session, CURLOPT_POST, true);
// Tell curl that this is the body of the POST
curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
// Tell curl not to return headers, but do return the response
curl_setopt($session, CURLOPT_HEADER, false);
// Tell PHP not to use SSLv3 (instead opting for TLS)
curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

// obtain response
$response = curl_exec($session);
curl_close($session);

// print everything out
print_r($response);

$json_response = json_decode($response, true);
if($json_response["message"] == "success") header("Location: index.php?poslan=da");
else header("Location: index.php?poslan=ne");

?>