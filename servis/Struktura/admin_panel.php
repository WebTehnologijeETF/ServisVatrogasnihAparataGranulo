<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="/servis/Stilovi/stylerevised.css">
    <script type="text/javascript" src="/servis/Skripte/dropit.js"></script>
    <script type="text/javascript" src="/servis/Skripte/SinglePageConversion.js"></script>
	<script type="text/javascript" src="/servis/Skripte/adminPanelOperations.js"></script>
	<script type="text/javascript" src="/servis/Skripte/popupOperations.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Granulo - RE d.o.o</title>
</head>
<body onload="addEventListenersToBody()">
    <div id="wrapper_div" class="container">
         <div id="header_div">
             <img id="header_logo_image" src="/servis/Resursi/Slike/header_logo.png" alt="Slika nije ucitana">
         </div>
        <div id="navbar_container" class="container">
         <div id="navbar_div" class="nav">
             <?php include('printnavbar.php'); ?>
         </div>
         </div>
        <div id="news_container" class="container">
		<?php 
		
		include('funkcije_baza.php');
		$connection = connect_to_db();
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{	
			if(isset($_POST["Akcija_dodaj_vijest"]) && $_POST["Akcija_dodaj_vijest"] == "dodavanjevijesti")
			{
				if(isset($_POST["Autor"]) && isset($_POST["Naslov"]) && isset($_POST["Opis"])){
					$insertQuery = "INSERT INTO novosti(datum, autor, slika_url, opis_vijesti, detaljna_vijest, naslov) 
									VALUES(curdate(), ?, ?, ?, ?, ?)";
					if($addNews = $connection->prepare($insertQuery))
					{
						$addNews->bind_param('sssss', $autor, $slika, $opis, $detaljnije, $naslov);
						$autor = htmlspecialchars($_POST["Autor"]);
						$slika = htmlspecialchars($_POST["Slika"]);
						$opis = htmlspecialchars($_POST["Opis"]);
						$detaljnije = htmlspecialchars($_POST["Detaljnije"]);
						$naslov = htmlspecialchars($_POST["Naslov"]);
						$addNews->execute();
						$addNews->close();
					}
				}
			}
			else if(isset($_POST["Akcija_brisanje_vijesti"]) && $_POST["Akcija_brisanje_vijesti"] == "brisanjeVijesti")
			{
				$id = htmlspecialchars($_POST["Delete_news"]);
				deleteNewsCascading($id);
			}
			else if(isset($_POST["Izmjena"]) && $_POST["Izmjena"] == "izmjenavijesti")
			{
				$autorEdit = htmlspecialchars($_POST["Autor_edit"]);
				$naslovEdit = htmlspecialchars($_POST["Naslov_edit"]);
				$opisEdit = htmlspecialchars($_POST["Opis_edit"]);
				$detaljnijeEdit = htmlspecialchars($_POST["Detaljnije_edit"]);
				$idEdit = htmlspecialchars($_POST["Edit_news"]);
				$slikaEdit = htmlspecialchars($_POST["Slika_edit"]);
				updateNews($idEdit, $slikaEdit, $naslovEdit, $opisEdit, $detaljnijeEdit, $autorEdit);
			}
		}
		
		session_start();
		// Provjera logina i prikaz login forme
		if(isset($_SESSION["Username"]) && $_SESSION["Username"] != ""){
		 print('<div id="news_div" class="newsDivAdminPanel">
		 	<h1 class="admin_header_centered"> Dodavanje, promjena i brisanje novosti </h1>
				<div class="divColumnClass">
					<form class="adminFormElements" id="add_news" name="DodavanjeVijesti" method="post" action="admin_panel.php">
						<label id="naslov_label">Naslov vijesti</label><br>
						<input type="text" class="individualFormElement" id="naslov_input" name="Naslov" value="" required/><br>
						<label id="autor_label">Autor</label><br>
						<input type="text" class="individualFormElement" id="autor_input" name="Autor" value="" required/><br>
						<label id="slika_label">Slika</label><br>
						<input type="text" class="individualFormElement" id="slika_input" name="Slika" value=""/><br>
						<label id="opis_label">Opis novosti</label><br>
						<textarea name="Opis" class="individualFormElement" id="opis_input"> 
						</textarea><br>
						<label id="detaljnije_label">Detaljna novost</label><br>
						<textarea name="Detaljnije" class="individualFormElement" id="detaljnije_input"> 
						</textarea><br>
						<input type="hidden" name="Akcija_dodaj_vijest" value="dodavanjevijesti">
						<input type="submit" class="individualFormElement" id="addNews" name="addNews" value="Dodajte vijest">
					</form>
				</div>');
				print('<div class="divColumnClass">
					<form class="adminFormElements" id="edit_news" name="IzmjenaVijesti" method="post" action="admin_panel.php">
					<label id="izaberi_vijest_edit_label">Izaberite vijest</label><br>');
					$news = array();
					$news = json_decode(getAllVijesti(), true);
					echo "<select id='edit_news_combo' name='Edit_news' onchange='fillEditNews(" . getAllVijesti() . ")'>";
					foreach($news as $item)
					{
						echo '<option value="' . $item["ID"] .'">' . $item["Naslov"] . '</option>';
					}
					echo "</select><br>";
				print('<label id="naslov_edit_label">Naslov vijesti</label><br>
						<input type="text" class="individualFormElement" id="naslov_edit_input" name="Naslov_edit" value="" required/><br>
						<label id="autor_edit_label">Autor</label><br>
						<input type="text" class="individualFormElement" id="autor_edit_input" name="Autor_edit" value="" required/><br>
						<label id="slika_edit_label">Slika</label><br>
						<input type="text" class="individualFormElement" id="slika_edit_input" name="Slika_edit" value=""/><br>
						<label id="opis_edit_label">Opis novosti</label><br>
						<textarea name="Opis_edit" class="individualFormElement" id="opis_edit_input"> 
						</textarea><br>
						<label id="detaljnije_edit_label">Detaljna novost</label><br>
						<textarea name="Detaljnije_edit" class="individualFormElement" id="detaljnije_edit_input"> 
						</textarea><br>
						<input type="hidden" name="idVijesti" value="">
						<input type="hidden" name="Izmjena" value="izmjenavijesti">
						<input type="submit" class="individualFormElement" id="addNews" name="addNews" value="Izmijenite vijest">
					</form>
				</div>
				<div class="divColumnClass">
					<form class="adminFormElements" id="delete_news" name="BrisanjeVijesti" method="post" action="admin_panel.php">
					<label id="izaberi_vijest_delete_label">Izaberite vijest</label><br>
					');
					$newsToDelete = array();
					$newsToDelete = json_decode(getAllVijesti(), true);
					echo "<select id='delete_news_combo' name='Delete_news'>";
					foreach($newsToDelete as $itemToDelete)
					{
						echo '<option value="' . $itemToDelete["ID"] .'">' . $itemToDelete["Naslov"] . '</option>';
					}
					echo "</select><br><br><input type='submit' class='individualFormElement' id='deleteNews' name='deleteNews' value='Obrišite vijest'><br><br><input type='hidden' name='Akcija_brisanje_vijesti' value='brisanjeVijesti'/>";
					print('</form>
				</div>
			<h1 class="admin_header_centered"> Brisanje komentara na novosti </h1>
				<div class="divColumnClass">
					<form class="adminFormElements" id="delete_comment" name="BrisanjeKomentara" method="post" action="admin_panel.php">
					</form>
				</div>
			<h1 class="admin_header_centered"> Dodavanje, brisanje i promjena korisnika </h1>
				<div class="divColumnClass">
					<form class="adminFormElements" id="add_user" name="DodavanjeKorisnika" method="post" action="admin_panel.php">
					</form>
				</div>	
				<div class="divColumnClass">
					<form class="adminFormElements" id="edit_user" name="PromjenaKorisnika" method="post" action="admin_panel.php">
					</form>
				</div>
				<div class="divColumnClass">
					<form class="adminFormElements" id="delete_user" name="BrisanjeKorisnika" method="post" action="admin_panel.php">
					</form>
				</div>
         </div>
        </div>');
		}
		else echo '<h1 class="news_header">Da biste koristili funkcije admin panela morate se prijaviti!</h1>';
		?>
        <div class="clearfooter"></div>
    </div>
    <div id="footer_div">
            <img id="footer_image" src="/servis/Resursi/Slike/footer_bg.png" alt="Slika nije ucitana">
            <p id="footer_text" class="djelatnost"></p>
    </div>
</body>
</html>