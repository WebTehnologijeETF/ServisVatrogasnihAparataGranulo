<?php

include('funkcije_baza.php');

$connection = connect_to_db();
// select komentara ako ih ima
if(isset($_GET["komentariVijest"]))
{
	
	$query = 'SELECT datum "Datum", autor "Autor", email "Email", tekst_komentara "Komentar", vrijeme_komentara "VrijemeKomentara" FROM komentari WHERE novost=? ORDER BY vrijeme_komentara ASC';
	$statement = $connection->prepare($query);
	if($statement)
	{
		$statement->bind_param('i', $vijest_id);
		$vijest_id = $_GET["komentariVijest"];
		if($statement->execute())
		{
			$result = $statement->get_result();
			while($comment = $result->fetch_array(MYSQLI_ASSOC))
			{
				echo '<article class="newsContainer">';
				if($comment["Email"] != "") echo '<a href="mailto:' . $comment["Email"] .  '" class="comment_header">Autor komentara: ' . $comment["Autor"] . '</a>';
				else echo '<h1 class="comment_header">Autor komentara: ' . $comment["Autor"] . '</h1>';
				echo '<p class="comment_show">Vrijeme komentara: ' . date("d.m.Y (h:i)", strtotime($comment["VrijemeKomentara"])) . '</p>';
				if($comment["Email"] != "") echo '<p class="comment_show" >E mail adresa autora: ' . $comment["Email"] . '</p>';
				echo '<p class="comment_show">' . $comment["Komentar"] . '</p>';
				echo '</article>';
			}
		}
	}
} else header("index.php");

?>