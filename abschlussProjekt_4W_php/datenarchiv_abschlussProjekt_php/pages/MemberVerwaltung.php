<?php
$connect = mysqli_connect("localhost","root","","datenarchiv_pape");
mysqli_query($connect, "SET NAMES utf8");
?>
<table>
<form action='?seite=MemberVerwaltung' method='post'>
<tr>
	<th>Suchzeile</th>
	<th><input type='text' name='suche_mitarbeiter' value='<?= @$_POST["suche_mitarbeiter"];?>' placeholder="Username" /></th>
	<th><input type='submit' value='Suchen' /></th>
	<th><input type='reset' /></th>
	<th></th>
	<th><a href='?seite=MemberVerwaltung'>Suche beenden</a></th>
</tr>
</form>
<tr>
	<th>MitarbeiterNR</th>
	<th>Username</th>
	<th>Vorname</th>
	<th>Nachname</th>
	<th>Adresse</th>
	<th>Passwort</th>
	<th>Mail</th>
	
	<th>Bearbeiten</th>	
	<th>Loeschen</th>
	
	
</tr>
<?php
$sql = 	"select * from user ";

$array = array();
if(isset($_POST["suche_mitarbeiter"]) && $_POST["suche_mitarbeiter"] != "")
{
	$array[] = "Username LIKE '%".$_POST["suche_mitarbeiter"]."%'";
}

if(count($array) > 0)
{
	$string = implode(" AND ", $array);
	$sql .= " WHERE ".$string;
}


$antwort = mysqli_query($connect, $sql);
#echo "<h1>".$sql."</h1>";

#$antwort = mysqli_query($connect, "select * from datei LEFT JOIN status 
#									ON datei.status = status.statusnr"); // alle Aufträge inkl. Status									
							
while($datensatz = mysqli_fetch_array($antwort))
{
	
	
	
	
	
	
	$string = " <tr>
					<td>".$datensatz["MitarbeiterNR"]."</td>
					<td>".$datensatz["Username"]."</td>
					<td>".$datensatz["Vorname"]."</td>
					<td>".$datensatz["Nachname"]."</td>
					<td>".$datensatz["Adresse"]."</td>
					<td>".$datensatz["Passwort"]."</td>
					<td>".$datensatz["Mail"]."</td>
					<td><a href='?seite=MemberVerwaltung&auftragnr=".$datensatz["MitarbeiterNR"]."&modus=bearbeiten'>Bearbeiten</a></td>	
					<td><a href='?seite=MemberVerwaltung&auftragnr=".$datensatz["MitarbeiterNR"]."&modus=loeschen'>Löschen</a></td>
				
									
					
					
				</tr>";
	echo $string;		
	
	
}
?>
</table>


<?php

/*

#echo "<pre>";
	#print_r($_POST); // Textdaten 1. Teil
	#print_r($_FILES); // Dateidaten 2. Teil
	#echo "</pre>";	
	
					//	box02.png
	$datei_original = $_FILES["dateipfad"]["name"]; // So heißt die Datei in echt		
					// c:\xampp\tmp\php4847.tmp
	$datei_tempname = $_FILES["dateipfad"]["tmp_name"]; // Wie heißt die Datei auf dem Server?	
	
	$neuer_dateiname = uniqid("datei_").".docx"; // bild_5df8a56697fc8.png
	
	
	move_uploaded_file($datei_tempname, "uploads/".$neuer_dateiname);
	
*/


mysqli_close($connect);
?>