<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="/servis/Stilovi/stylerevised.css">
    <script type="text/javascript" src="/servis/Skripte/dropit.js"></script>
    <script type="text/javascript" src="/servis/Skripte/SinglePageConversion.js"></script>
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
         <div id="news_div" class="newsDivOneCenteredForm">
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
			session_start();
			if(!isset($_SESSION["Username"])){ 
				print('<br><br><form class="formElements" method="post" action="login.php">
						<label id="ime_label">  Username: </label>
						<input type="text" id="username_input" name="Username" value="" required/><br><br>
						<label id="email_label">Vaš password:</label>
						<input type="password" id="password_input" name="Password" value="" required/><br><br>
						<input type="submit" id="commentSubmit" name="commentSubmit" value="Prijavite se">
					</form>');
			}
			else{
				
				if(isset($_SESSION["Username"]) && $_SESSION["Username"] != "")
				{
					session_unset();
					header("Location: login.php");
				}
				else{
					
					print('<br><br><form class="formElements" method="post" action="login.php">
						<label id="ime_label">  Username: </label>
						<input type="text" id="username_input" name="Username" value="" required/><br><br>
						<label id="email_label">Vaš password:</label>
						<input type="password" id="password_input" name="Password" value="" required/><br><br>
						<input type="submit" id="commentSubmit" name="commentSubmit" value="Prijavite se">
					</form>');
				}
			}
		?>
         </div>
        </div>
        <div class="clearfooter"></div>
    </div>
    <div id="footer_div">
            <img id="footer_image" src="/servis/Resursi/Slike/footer_bg.png" alt="Slika nije ucitana">
            <p id="footer_text" class="djelatnost"></p>
    </div>
</body>
</html>