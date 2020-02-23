<h1>Herzlich Willkommen</h1>

<?php
if(isset($_SESSION["erfolgreich_eingeloggt"])){
	echo  "<br><h3>NewsFeed der Firma XYZ</h3><br>
	<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>";
	echo "<br> Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.";
}else{
?>
<form action="" method="post">

<input type="text" name="login" placeholder="Login" /><br />

<input type="password" name="password" placeholder="Passwort"/><br />

<input type="submit" value="Login" />
</form>
<br>
<hr>

Sie Brauchen einen Account? <a href='?seite=registrierung' > Hier Klicken! </a>

<?php
}
?>
