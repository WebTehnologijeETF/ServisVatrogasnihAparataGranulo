<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="/servis/Stilovi/stylerevised.css">
    <script type="text/javascript" src="/servis/Skripte/dropit.js"></script>
	<script type="text/javascript" src="/servis/Skripte/validate.js"></script>
    <script type="text/javascript" src="/servis/Skripte/SinglePageConversion.js"></script>
	<script type="text/javascript" src="/servis/Skripte/adminPanelOperations.js"></script>
	<script type="text/javascript" src="/servis/Skripte/popupOperations.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Granulo - RE d.o.o</title>
</head>
<body onload="addEventListenersToBody(); clearAdminTextAreas();">
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
			else if(isset($_POST["Izmjena_vijesti"]) && $_POST["Izmjena_vijesti"] == "izmjenavijesti")
			{
				$autorEdit = htmlspecialchars($_POST["Autor_edit"]);
				$naslovEdit = htmlspecialchars($_POST["Naslov_edit"]);
				$opisEdit = htmlspecialchars($_POST["Opis_edit"]);
				$detaljnijeEdit = htmlspecialchars($_POST["Detaljnije_edit"]);
				$idEdit = htmlspecialchars($_POST["Edit_news"]);
				$slikaEdit = htmlspecialchars($_POST["Slika_edit"]);
				updateNews($idEdit, $slikaEdit, $naslovEdit, $opisEdit, $detaljnijeEdit, $autorEdit);
			}
			else if(isset($_POST["Akcija_brisanje_komentara"]) && $_POST["Akcija_brisanje_komentara"] == "brisanjeKomentara")
			{
				$id = htmlspecialchars($_POST["Delete_comments"]);
				deleteComment($id);
			}
			else if(isset($_POST["Akcija_dodaj_korisnika"]) && $_POST["Akcija_dodaj_korisnika"] == "dodavanjekorisnika")
			{
				$user = htmlspecialchars($_POST["KorisnickoIme"]);
				$pass = htmlspecialchars($_POST["Lozinka"]);
				$mail = htmlspecialchars($_POST["Mail"]);
				addUser($user, $pass, $mail);
			}
			else if(isset($_POST["Izmjena_korisnika"]) && $_POST["Izmjena_korisnika"] == "izmjenakorisnika")
			{
				$user = $_POST["Username_edit"];
				$pw = $_POST["Pw_user_edit"];
				$mail = $_POST["Email_user_edit"];
				$id = $_POST["Edit_users"];
				updateUser($id, $user, $pw, $mail);
			}
			else if(isset($_POST["Akcija_brisanje_korisnika"]) && $_POST["Akcija_brisanje_korisnika"] == "brisanjekorisnika")
			{
				$id = htmlspecialchars($_POST["Delete_users"]);
				deleteUser($id);
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
						<input type="submit" class="individualFormElement" onclick="return validateNovostAdd()" id="addNews" name="addNews" value="Dodajte vijest">
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
						<input type="hidden" name="Izmjena_vijesti" value="izmjenavijesti">
						<input type="submit" class="individualFormElement" onclick="validateNovostEdit()" id="addNews" name="addNews" value="Izmijenite vijest">
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
					print('</form>');
				print('</div>
			<h1 class="admin_header_centered"> Brisanje komentara na novosti </h1>
				<div class="divColumnClass">
					<form class="adminFormElements" id="delete_comment" name="BrisanjeKomentara" method="post" action="admin_panel.php">
					<label id="izaberi_komentar_delete_label">Izaberite komentar</label><br>
					');
					$commentsToDelete = array();
					$commentsToDelete = json_decode(getAllComments(), true);
					echo "<select id='delete_comments_combo' name='Delete_comments'>";
					foreach($commentsToDelete as $commentToDelete)
					{
						echo '<option value="' . $commentToDelete["ID"] .'">' . $commentToDelete["Naslov"] . ' komentar ' . $commentToDelete["ID"] . '</option>';
					}
					echo "</select><br><br><input type='submit' class='individualFormElement' id='deleteComments' name='deleteComments' value='Obrišite komentar'><br><br><input type='hidden' name='Akcija_brisanje_komentara' value='brisanjeKomentara'/>";
					print('</form>
				</div>
			<h1 class="admin_header_centered"> Dodavanje, brisanje i promjena korisnika </h1>
				<div class="divColumnClass">
					<form class="adminFormElements" id="add_user" name="DodavanjeKorisnika" method="post" action="admin_panel.php">
						<label id="username_label">Korisničko ime:</label><br>
						<input type="text" class="individualFormElement" id="username_input" name="KorisnickoIme" value=""/><br>
						<label id="password_label">Lozinka:</label><br>
						<input type="password" class="individualFormElement" id="password_input" name="Lozinka" value="" required/><br>
						<label id="mail_label">Email korisnika:</label><br>
						<input type="text" class="individualFormElement" id="mail_input" name="Mail" value=""/><br>
						<input type="hidden" name="Akcija_dodaj_korisnika" value="dodavanjekorisnika">
						<input type="submit" class="individualFormElement" onclick="return (validateUsernameAdd() && validatePasswordAdd() && validateEmailAdd());" id="addUser" name="addUser" value="Dodajte korisnika">
					</form>
				</div>	
				<div class="divColumnClass">
					<form class="adminFormElements" id="edit_user" name="PromjenaKorisnika" method="post" action="admin_panel.php">
					<label id="izaberi_korisnika_edit_label">Izaberite korisnika</label><br>
					');
					$users = array();
					$users = json_decode(getAllUsers(), true);
					echo "<select id='edit_users_combo' name='Edit_users' onchange='fillEditUsers(" . getAllUsers() . ")'>";
					foreach($users as $user)
					{
						echo '<option value="' . $user["ID"] .'">' . $user["KorisnickoIme"] . '</option>';
					}
					echo "</select><br>";
				print('<label id="username_label">Korisničko ime:</label><br>
						<input type="text" class="individualFormElement" id="username_edit_input" name="Username_edit" value="" required/><br>
						<label id="pw_edit_label">Lozinka:</label><br>
						<input type="password" class="individualFormElement" id="pw_edit_input" name="Pw_user_edit" value=""/><br>
						<label id="email_edit_label">Email</label><br>
						<input type="text" class="individualFormElement" id="email_edit_input" name="Email_user_edit" value=""/><br>
						<input type="hidden" name="idKorisnika" value="">
						<input type="hidden" name="Izmjena_korisnika" value="izmjenakorisnika">
						<input type="submit" class="individualFormElement" onclick="return (validateUsernameEdit() && validatePasswordEdit() && validateEmailEdit());" id="editUser" name="editUser" value="Izmijenite korisnika">
				</form>
				</div>
				<div class="divColumnClass">
					<form class="adminFormElements" id="delete_user" name="BrisanjeKorisnika" method="post" action="admin_panel.php">
					<label id="izaberi_korisnika_delete">Izaberite korisnika</label><br>
					');
					$usersToDelete = array();
					$usersToDelete = json_decode(getAllUsers(), true);
					echo "<select id='delete_users_combo' name='Delete_users'>";
					foreach($usersToDelete as $userToDelete)
					{
						echo '<option value="' . $userToDelete["ID"] .'">' . $userToDelete["KorisnickoIme"] . '</option>';
					}
					echo "</select><br><br><input type='submit' class='individualFormElement' id='deleteUsers' name='deleteUsers' value='Obrišite korisnika'><br><br><input type='hidden' name='Akcija_brisanje_korisnika' value='brisanjekorisnika'/>";
				print('</form>
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