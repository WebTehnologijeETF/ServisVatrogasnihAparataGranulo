<?php

// Prikazivanje unijetih podataka na formi i dugmeta za potvrdu istog

// varijable
$name = $_POST['Name'];
$mail = $_POST['Email'];
$poruka = $_POST['Poruka'];
$tip = $_POST['Tip'];
$brojtel = $_POST['Brojtel'];

echo		 '<p class="h2Style">Provjerite da li ste ispravno unijeli podatke:</p>';
echo         '<p class="djelatnost">Ime: ' .$name. '</p>';
echo         '<p class="djelatnost">Email: ' .$mail. '</p>';
echo         '<p class="djelatnost">Poruka: ' .$poruka. '</p>';
echo         '<p class="djelatnost">Tip: ' .$tip. '</p>';
echo         '<p class="djelatnost">Broj telefona: ' .$brojtel. '</p>';
echo 		 '<form class="formElements" method="post" action="sendmail.php">';
echo            '<input type="hidden" name="Name" value="' . $name . '">';
echo            '<input type="hidden" name="Email" value="' . $mail . '">';
echo            '<input type="hidden" name="Poruka" value="' . $poruka . '">';
echo            '<input type="hidden" name="Tip" value="' . $tip . '">';
echo            '<input type="hidden" name="Brojtel" value="' . $brojtel . '">';
echo         	'<input type="submit" id="siguranButton" value="Siguran sam"><br>';
echo         '</form>';
echo 		 '<p class="h2Style">Ako ste pogrešno unijeli podatke, ovdje ih možete ispraviti:</p>';

?>