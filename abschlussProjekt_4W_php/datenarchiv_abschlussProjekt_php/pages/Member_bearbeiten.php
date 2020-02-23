<?php
$connect = mysqli_connect("localhost","root","","datenarchiv_pape");
mysqli_query($connect, "SET NAMES utf8");

// Einen Auftrag abfragen
$antwort = mysqli_query($connect, "select * from user where MitarbeiterNR=".$_GET["auftragnr"]); 
$auftrag = mysqli_fetch_array($antwort);

echo "<a href='?seite=MemberVerwaltung'>Zurück</a>";

echo "<h2>Username</h2>";
echo $auftrag["Username"];

echo "<h2>Vorname</h2>";
echo $auftrag["Vorname"];

echo "<h2>Nachname</h2>";
echo $auftrag["Nachname"];

echo "<h2>Adresse</h2>";
echo $auftrag["Adresse"];

echo "<h2>Passwort</h2>";
echo $auftrag["Passwort"];

echo "<h2>Mail</h2>";
echo $auftrag["Mail"];



?>
<br>
<br>
<form action="?seite=MemberVerwaltung" method="post">
Adresse:<br />	
<input type="text" name="adresse" value="<?= $auftrag["Adresse"]; ?>" /><br />
<br>
	<br>
Passwort:<br />	
<input type="text" name="passwort" value="<?= $auftrag["Passwort"]; ?>" /><br />
<br>
Mail:<br />	
<input type="text" name="mail" value="<?= $auftrag["Mail"]; ?>" /><br />
<br>

	<br />
	<br />
<!-- Für die Zuordnung -->
<input type="hidden" name="auftragnr" value="<?= $auftrag["MitarbeiterNR"]; ?>" />

<input type="submit" value="Speichern" name="bearbeiten_speichern" />
<input type="reset" value="Zurücksetzen" />
</form>






<?php
mysqli_close($connect);
?>