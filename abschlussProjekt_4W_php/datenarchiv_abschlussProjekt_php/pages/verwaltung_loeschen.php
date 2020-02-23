<?php
$connect = mysqli_connect("localhost","root","","datenarchiv_pape");
mysqli_query($connect, "SET NAMES utf8");

// Einen Auftrag abfragen
$antwort = mysqli_query($connect, "select * from datei where datei_index=".$_GET["auftragnr"]); 
$auftrag = mysqli_fetch_array($antwort);

echo "<a href='?seite=verwaltung'>Zurück</a>";

echo "<h1>Löschen</h1>";

?>

<form action='?seite=verwaltung' method='post'>
<h1>Wollen Sie wirklich diese Datei löschen?</h1>
<?php

echo  "<iframe src='uploads/" .$auftrag["Dateipfad"]. "' width='100%' height='500px'>";
echo "</iframe>";

?>
<input type='submit' value='JA'		name='loeschen_bestaetigen' />
<input type='submit' value='NEIN' 	name='loeschen_bestaetigen' />
<input type='hidden' name='auftragnr' value='<?= $auftrag["datei_index"];?>' />
</form>
<?php
mysqli_close($connect);
?>