<?php

function connect_to_db()
{
	static $connection;
	
	if(!isset($connection))
	{
		// MySQL connection data
		$credentials = parse_ini_file('mysql_credentials.ini'); ;
		$connection = new mysqli($credentials['host'], $credentials['username'], $credentials['password'], $credentials['dbname']);
	}
	if($connection == false)
	{
		echo '<script>alert("Greška pri konekciji na bazu");</script>';
	}
	else return $connection;
}

$connection = connect_to_db();
$query = 'SELECT datum "Datum", UNIX_TIMESTAMP(vrijeme_vijesti) "Vrijeme", autor "Autor", slika_url "Slika", opis_vijesti "Opis", detaljna_vijest "Detaljnije", naslov "Naslov"
		  FROM novosti ORDER BY datum DESC';
$statement = $connection->prepare($query);

if($statement)
{
	if($statement->execute())
	{
		$result = $statement->get_result();
		while($news_item = $result->fetch_array(MYSQLI_ASSOC))
		{
			echo '<article class="newsContainer">';
			echo '<img src="' . $news_item["Slika"] . '" class="news_image" alt=" ">';
			echo '<h1 class="news_header">' . ucfirst(strtolower($news_item["Naslov"])) . '</h1>';
			echo '<p class="news_item">' . $news_item["Opis"] . '</p>';
			if($news_item["Detaljnije"] != "") echo "<a onclick='loadSingleNewsItem(" . json_encode($news_item) . ")' class='detaljnijeLink'>Detaljnije...</a>";
			echo '</article>';
		}
	}
	$statement->close();
}
?>