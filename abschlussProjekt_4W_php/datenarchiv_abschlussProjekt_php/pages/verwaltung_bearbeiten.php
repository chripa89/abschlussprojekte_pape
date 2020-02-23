<?php
$connect = mysqli_connect("localhost","root","","datenarchiv_pape");
mysqli_query($connect, "SET NAMES utf8");

// Einen Auftrag abfragen
$antwort = mysqli_query($connect, "select * from datei where datei_index=".$_GET["auftragnr"]); 
$auftrag = mysqli_fetch_array($antwort);

echo "<a href='?seite=verwaltung'>Zurück</a>";

echo "<h3>Datei Index</h3>";
echo "<p>".$auftrag["datei_index"]."</p>";
echo "<h3>Kategorie</h3>";

if( $auftrag["KategorieNR"] ==1) echo "<p>Rechnung</p>";
else if( $auftrag["KategorieNR"] ==2) echo "<p>Mahnung</p>";
else if( $auftrag["KategorieNR"] ==3) echo "<p>Kostenvoranschlag</p>";
else echo "<p>Auftrag</p>";



echo "<h3>Auftragdatum</h3>";
echo "<p>".$auftrag["Eingang"]."</p>";
echo "<h3>Status</h3>";
if($auftrag["Status"] == 2) echo "<p>Erledigt</p>"; else echo "<p>Offen</p>";


?>
<br>
<form action="?seite=verwaltung" method="post">
<h3>Kurze Zusammenfassung:</h3><br />	
<input type="text" name="dateiname" value="<?= $auftrag["Dateiname"]; ?>" /><br />
<br>
	<br>
	<h3>Änderung:</h3>
<select name="status">	
<?php
	$antwort = mysqli_query($connect, "select * from status");

	while($datensatz = mysqli_fetch_array($antwort))
	{
		echo '<option value="'.$datensatz["Statusnr"].'">'.$datensatz["Status"].'</option>';
	}		
	?>
	
	</select>
	<br>
	<br>
	<h3>Kategorie:</h3>
	<select name="kategorie">	
<?php
	$antwort = mysqli_query($connect, "select * from kategorien");

	while($datensatz = mysqli_fetch_array($antwort))
	{
		echo '<option value="'.$datensatz["KategorieNR"].'">'.$datensatz["Kategorie"].'</option>';
	}		
	?>
	
	</select>
	<br />
	<br />
<!-- Für die Zuordnung -->
<input type="hidden" name="auftragnr" value="<?= $auftrag["datei_index"]; ?>" />

<input type="submit" value="Speichern" name="bearbeiten_speichern" />
<input type="reset" value="Zurücksetzen" />
</form>
<?php


echo "<br>";
echo  "<iframe src='uploads/" .$auftrag["Dateipfad"]. "' width='100%' height='500px'>";
echo "</iframe>";

?>





<?php
mysqli_close($connect);
?>