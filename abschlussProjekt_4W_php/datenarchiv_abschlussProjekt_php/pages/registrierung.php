<?php
$connect = mysqli_connect("localhost","root","","datenarchiv_pape");
mysqli_query($connect, "SET NAMES utf8");	// Die Übertragung auf UTF-8 umstellen#

 $passwordEingabe = isset($_POST["password"]) ? $_POST["password"] : "";
 $passwordConfirmed = isset($_POST["confirm_password"]) ? $_POST["confirm_password"] : "";

// Formular nur anzeigen, wenn es nicht verschickt wurde
if(!isset($_POST["submit"]))
{
?>	
<div class="ueberschrift">
<h2>Herzlich Willkommen</h2>
<h4> Bitte registrieren Sie sich als neuer Nutzer!</h4>
</div>
<div class="startseite">

<form id="kontakt_formular" 
name="kontakt_form"
method="post"
onSubmit="return kontakt()">


 Vorname*<br><input type="text" name="vorname"><br>
Nachname*<br><input type="text" name="nachname"> <br>
 E-Mail*<br><input type="text" name="email"><br>
Login*<br><input type="text" name="login"/><br>
Passwort*<br><input type="password" name="password"/>
<br>Passwort wiederholen* <br /><input type="password" name="confirm_password"   />
 <br />
 <input type="submit" name="submit" value="Registrierung abschließen" />
 <br>
  <br>
 Du hast bereits einen Account? <a href='?seite=verwaltung'> zum Login </a>


<div id="n1_name">Bitte Ihren Vornamen angeben!</div>
<div id="n2_name">Bitte Ihren Nachnamen angeben!</div>
<div id="n3_mail">Bitte Ihre Email angeben!</div>
<div id="n3_mail2">Das ist keine gültige Emailadresse!</div>
<div id="n1_login">Bitte geben Sie einen Login an!</div>
<div id="n1_password">Das ist kein gültiges Passwort!</div>
<div id="n2_password">Passwörter stimmen nicht überein!</div>
<div id="n3_password">Bitte das Passwort wiederholen!</div>
</form>


<?php
} # ende der if abfrage
?>
<?php
/*
*/
if ($passwordEingabe === $passwordConfirmed) {
 
  // Programm ausführen, wenn das Formular verschickt wurde
  

	if(isset($_POST["submit"]))
{
	

	$vorname 				= $_POST["vorname"];
	$nachname 		= $_POST["nachname"];
	$email 			= $_POST["email"];	
	$password 			= $_POST["password"];
	$user 					= $_POST["login"];
	

	
	$sql = "insert into user
			( Username, Vorname, Nachname, Passwort, Mail)
			values
			( '$user', '$vorname', '$nachname', '$password', '$email')";	
	$antwort = mysqli_query($connect, $sql);
	
	echo "Vielen Dank für Ihre Regestrierung!";
    echo "Sie können sich jetzt einloggen! <br> <br><a href='?seite=home'> Login</a>";
} 
	
  
}
else {
	echo "<br> Passwörter stimmen nicht überein!";
	echo "<br>";
	echo "<br><a href='?seite=home'>Zurück zur Regestrierung</a>";
   // failed :(
};




?>

		
	

<?php

?>
<?php
mysqli_close($connect);
?>