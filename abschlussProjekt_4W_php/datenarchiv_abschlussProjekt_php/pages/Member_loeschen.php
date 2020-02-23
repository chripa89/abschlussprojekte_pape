<?php
$connect = mysqli_connect("localhost","root","","datenarchiv_pape");
mysqli_query($connect, "SET NAMES utf8");

// Einen Auftrag abfragen
$antwort = mysqli_query($connect, "select * from user where MitarbeiterNR=".$_GET["auftragnr"]); 
$auftrag = mysqli_fetch_array($antwort);

echo "<a href='?seite=verwaltung'>Zurück</a>";

echo "<h1>Löschen</h1>";

?>

<form action='?seite=MemberVerwaltung' method='post'>
<h1>Wollen Sie wirklich diesen User "<?php echo $auftrag["Username"] ?>"  löschen?</h1>
<input type='submit' value='JA'		name='loeschen_bestaetigen' />
<input type='submit' value='NEIN' 	name='loeschen_bestaetigen' />
<input type='hidden' name='auftragnr' value='<?= $auftrag["MitarbeiterNR"];?>' />
</form>
<?php
mysqli_close($connect);
?>