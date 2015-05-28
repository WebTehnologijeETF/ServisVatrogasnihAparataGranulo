<?php

include('funkcije_baza.php');

$connection = connect_to_db();
// insertovanje komentara ako ih ima
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	if($_POST["Email"] != "")
	{
		$insertQuery = "INSERT INTO komentari(datum, autor, email, novost, tekst_komentara) VALUES(curdate(), ?, ?, ?, ?)";
		if($stmnt = $connection->prepare($insertQuery)){
		$stmnt->bind_param('ssis', $ime, $email, $vijest, $komentar);
				$ime = htmlspecialchars($_POST["Autor"]);
				$email = htmlspecialchars($_POST["Email"]);
				$komentar = htmlspecialchars($_POST["Komentar"]);
				$vijest = htmlspecialchars($_POST["idVijesti"]);
			$stmnt->execute();
			echo $stmnt->error;
			$stmnt->close();
		}
		else
		{
			printf("Prepared Statement Error: %s\n", $stmnt->error);
		}
	}
	else
	{
		$insertQuery = "INSERT INTO komentari(datum, autor, novost, tekst_komentara) VALUES(curdate(), ?, ?, ?)";
		$stmnt = $connection->prepare($insertQuery);
		$stmnt->bind_param('sis', $ime, $vijest, $komentar);
			$ime = htmlspecialchars($_POST["Autor"]);
			$komentar = htmlspecialchars($_POST["Komentar"]);
			$vijest = htmlspecialchars($_POST["idVijesti"]);
		$stmnt->execute();
		$stmnt->close();
	}
}

$query = 'SELECT id "Vijest", datum "Datum", UNIX_TIMESTAMP(vrijeme_vijesti) "Vrijeme", autor "Autor", slika_url "Slika", opis_vijesti "Opis", detaljna_vijest "Detaljnije", naslov "Naslov"
		  FROM novosti ORDER BY datum DESC';
$statement = $connection->prepare($query);
$commentQuery = 'SELECT count(*) "Broj" FROM komentari WHERE novost=?';
$commentStatement = $connection->prepare($commentQuery);
if($statement)
{
	if($statement->execute())
	{
		$result = $statement->get_result();
		while($news_item = $result->fetch_array(MYSQLI_ASSOC))
		{
		
			echo '<article class="newsContainer">';
			echo '<div class="maxDimensionsImage">';
			echo '<img src="' . $news_item["Slika"] . '" class="news_image" alt=" ">';
			$commentStatement->bind_param('i', $news_item["Vijest"]);
			if($commentStatement->execute())
			{
				$commentCount = $commentStatement->get_result();
				while($commentInstance = $commentCount->fetch_array(MYSQLI_ASSOC))
				{
					$count = $commentInstance["Broj"];
					if($count != 0) echo '<a class="comment_item" href="prikaz_komentara.php?komentariVijest=' . $news_item["Vijest"] . '">' . $count . ' komentara</a>';
					else echo '<p class="comment_item">Nema komentara</p>' ;
				}
			}
			echo '</div>';
			echo '<h1 class="news_header">' . ucfirst(strtolower($news_item["Naslov"])) . '</h1>';
			echo '<p class="news_item">' . $news_item["Opis"] . '</p>';
			if($news_item["Detaljnije"] != "") echo "<a onclick='loadSingleNewsItem(" . json_encode($news_item) . ")' class='detaljnijeLink'>Detaljnije...</a><br><br>";
			echo '<a class="detaljnijeLink" href="komentar.php?idVijesti=' . $news_item["Vijest"] . '">Ostavite komentar...</a>';
			echo '</article>';
		}
	}
	$statement->close();
}
?>