<?php
$connect = mysqli_connect("localhost","root","","datenarchiv_pape");
mysqli_query($connect, "SET NAMES utf8");

// Einen Auftrag abfragen
$antwort = mysqli_query($connect, "select * from datei where datei_index=".$_GET["auftragnr"]); 
$auftrag = mysqli_fetch_array($antwort);

echo "<a href='?seite=verwaltung'>Zurück</a>";

echo "<h1>Details</h1>";

echo "<h2>Datei_index</h2>";
echo $auftrag["datei_index"];

echo "<h2>Eingang</h2>";
echo $auftrag["Eingang"];

echo "<h2>Verfasser</h2>";
echo $auftrag["Verfasser"];

echo "<h2>Dateipfad</h2>";
echo $auftrag["Dateipfad"];


echo "<h2>Status</h2>";
#echo $auftrag["Status"]; // fremdschlüssel

											//		Primärschlüssel = Fremdschlüssel
$antwort = mysqli_query($connect, "select * from Status where Statusnr=".$auftrag["Status"]);
$statusinfo = mysqli_fetch_array($antwort); // Eine Zeile rausholen 
echo $statusinfo["Status"];
$ende = $statusinfo["Statusnr"]; // Das ist die Spalte mit 0 oder 1

if($ende == 2)
{
	echo "<div style='color:red'>Der Status kann nicht mehr geändert werden!</div>";
}
else
{
?>
	<form action="?seite=verwaltung" method="post">
		<select name="statusnr">
		<?php
		// Status abfragen die nach dem aktuellen Status folgen
		$antwort = mysqli_query($connect, "select statusnr, Status from Status
		"); 
		
		while($statuszeile = mysqli_fetch_array($antwort))
		{
			echo '<option value="'.$statuszeile["Statusnr"].'">'.$statuszeile["Status"].'</option>';
		}		
		?>
		</select>
		<!-- Auftragnr wird versteckt mitgeschickt -->
		<input type="hidden" name="auftragnr" value="<?php echo $auftrag["auftragnr"];?>">
		<input type="submit" value="Ändern" />
	</form>		
<?php
}








mysqli_close($connect);
?>