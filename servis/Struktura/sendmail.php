<?php
$to = "egranulo2@etf.unsa.ba";
$subject = "Test poruka - kontakt forma";
$name = strip_tags($_POST['Name']);
$mail = strip_tags($_POST['Email']);
$tip = strip_tags($_POST['Tip']);
$poruka = strip_tags($_POST['Poruka']);

$txt = 'Ime: ' . $name . "\r\n" . 'Email: ' . $mail . "\r\n" . 'Tip: ' . $tip . "\r\n" . 'Poruka: ' . $poruka;
$headers = 'From: eldar@eldar.mail.ba CC: khodzic@devlogic.eu' . "\r\n" . 'Reply-To: ' . $mail;
$isMailSent = mail($to, $subject, $txt, $headers);
if($isMailSent) header("Location: index.php?poslan=da");
else header("Location: index.php");
?>