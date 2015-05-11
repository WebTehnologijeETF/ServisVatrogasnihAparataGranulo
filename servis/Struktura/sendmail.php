<?php
$to = "egranulo2@etf.unsa.ba";
$subject = "Test poruka - kontakt forma";
$txt = 'Ime: ' . $_POST['Name'] . '\n' . 'Email: ' . $_POST['Email'] . '\n' . 'Tip: ' . $_POST['Tip'] . '\n' . 'Poruka: ' . $_POST['Poruka'];
$headers = 'CC: khodzic@devlogic.eu' . '\r\n' . 'Reply-To: ' . $_POST['Email'];
$isMailSent = mail($to,$subject,$txt,$headers);
echo '<script>' . 'alert("' . $isMailSent . '")' . '</script>';
?>