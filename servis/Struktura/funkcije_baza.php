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
	
	function getAllVijesti()
	{
		$toRet = array();
		$connection = connect_to_db();
		$query = 'SELECT id "ID", naslov "Naslov", autor "Autor", slika_url "Slika", opis_vijesti "Opis", detaljna_vijest "Detaljna"  FROM novosti';
		if($statement = $connection->prepare($query))
		{
			if($statement->execute())
			{
				$result = $statement->get_result();
				while($rows = $result->fetch_array(MYSQLI_ASSOC))
				{
					array_push($toRet, $rows);
				}
				
			}
			
		}
		$jsonArray = json_encode($toRet);
		return $jsonArray;
	}
	
	function deleteNewsCascading($id)
	{
		$connection = connect_to_db();
		$queryKomentari = "DELETE FROM komentari WHERE novost=?";
		$queryNovost = "DELETE FROM novosti WHERE id=?";
		
		if($komentarStatement = $connection->prepare($queryKomentari))
		{
			$komentarStatement->bind_param('i', $vijest);
			$vijest = $id;
			$komentarStatement->execute();
			$komentarStatement->close();
			if($novostStatement = $connection->prepare($queryNovost))
			{
				$novostStatement->bind_param('i', $novost);
				$novost = $id;
				$novostStatement->execute();
				$novostStatement->close();
			}
		}
	}
	
	function updateNews($id, $slika, $naslov, $opis, $detaljnije, $autor)
	{
		$connection = connect_to_db();
		$queryUpdate = "UPDATE novosti SET slika_url=?, naslov=?, opis_vijesti=?, detaljna_vijest=?, autor=? WHERE id=?";
		if($updateStatement = $connection->prepare($queryUpdate))
		{
			$updateStatement->bind_param('sssssi', $slikaUrl, $naslovVijesti, $opisVijesti, $detaljnaVijest, $autorVijesti, $idVijesti);
			$slikaUrl = $slika;
			$naslovVijesti = $naslov;
			$opisVijesti = $opis;
			$detaljnaVijest = $detaljnije;
			$autorVijesti = $autor;
			$idVijesti = $id;
			$updateStatement->execute();
			$updateStatement->close();
		}
	}
	
	function getAllComments()
	{
		$toRet = array();
		$connection = connect_to_db();
		$query = 'SELECT id "ID", novost "Novost" FROM komentari';
		$queryNovost = 'SELECT naslov "Naslov" FROM novosti WHERE id=?';
		$statementNovost = $connection->prepare($queryNovost);
		if($statement = $connection->prepare($query))
		{
			if($statement->execute())
			{
				$result = $statement->get_result();
				while($rows = $result->fetch_array(MYSQLI_ASSOC))
				{
					$statementNovost->bind_param('i', $naslov);
					$naslov = $rows["Novost"];
					$statementNovost->bind_result($naslovNovosti);
					if($statementNovost->execute())
					{
						while($statementNovost->fetch()) $rows["Naslov"] = $naslovNovosti;
					}
					array_push($toRet, $rows);
				}
				
			}
			
		}
		$jsonArray = json_encode($toRet);
		return $jsonArray;
	}
	
	function deleteComment($id)
	{
		$connection = connect_to_db();
		$queryKomentari = "DELETE FROM komentari WHERE id=?";
		
		if($komentarStatement = $connection->prepare($queryKomentari))
		{
			$komentarStatement->bind_param('i', $komentar);
			$komentar = $id;
			$komentarStatement->execute();
			$komentarStatement->close();
		}
	}
	
	function addUser($username, $password, $email)
	{
		$connection = connect_to_db();
		$queryInsert = "INSERT INTO administratori(username, password, email) VALUES(?, md5(?), ?)";
		
		if($statement = $connection->prepare($queryInsert))
		{
			$statement->bind_param('sss', $user, $pw, $mail);
			$user = $username;
			$pw = $password;
			$mail = $email;
			$statement->execute();
			$statement->close();
		}
	}
	
	function getAllUsers()
	{
		$toRet = array();
		$connection = connect_to_db();
		$query = 'SELECT id "ID", username "KorisnickoIme", password "Lozinka", email "Email" FROM administratori';
		if($statement = $connection->prepare($query))
		{
			if($statement->execute())
			{
				$result = $statement->get_result();
				while($rows = $result->fetch_array(MYSQLI_ASSOC))
				{
					array_push($toRet, $rows);
				}
				
			}
			
		}
		$jsonArray = json_encode($toRet);
		return $jsonArray;
	}
	
	function updateUser($id, $user, $pw, $mail)
	{
		$connection = connect_to_db();
		$queryUpdate = "UPDATE administratori SET username=?, password=md5(?), email=? WHERE id=?";
		if($updateStatement = $connection->prepare($queryUpdate))
		{
			$updateStatement->bind_param('sssi', $userInput, $pwInput, $mailInput, $idInput);
			$userInput = $user;
			$pwInput = $pw;
			$mailInput = $mail;
			$idInput = $id;
			$updateStatement->execute();
			$updateStatement->close();
		}
	}
	
	function deleteUser($id)
	{
		$connection = connect_to_db();
		$queryKorisnici = "DELETE FROM administratori WHERE id=?";
		$queryCount = 'SELECT count(*) "Broj" FROM administratori';
		if($countStatement = $connection->prepare($queryCount))
		{
			$countStatement->bind_result($broj);
			while($countStatement->fetch()){ if($broj == 1) return; }
		}
		if($korisnikStatement = $connection->prepare($queryKorisnici))
		{
			$korisnikStatement->bind_param('i', $korisnik);
			$korisnik = $id;
			$korisnikStatement->execute();
			$korisnikStatement->close();
		}
	}

?>