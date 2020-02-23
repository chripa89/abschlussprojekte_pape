<?php
$connect = mysqli_connect("localhost","root","","datenarchiv_pape");
mysqli_query($connect, "SET NAMES utf8");
?>
<table>
<form action='?seite=verwaltung' method='post'>
<tr>
	<th>Suchzeile</th>
	<th><input type='text' name='suche_kategorie' value='<?= @$_POST["suche_kategorie"];?>' placeholder="   Kategorie Nummer" /></th>
	<th><input type='text' name='suche_dateiname' value='<?= @$_POST["suche_dateiname"]; ?>'  /></th>
	<th><input type='text' name='suche_dateityp' value='<?= @$_POST["suche_dateityp"]; ?>' placeholder="    Dateityp Nummer" /></th>
	<th><input type='text' name='suche_eingang' value='<?= @$_POST["suche_eingang"]; ?>' /></th>
	<th><input type='text' name='suche_verfasser' value='<?= @$_POST["suche_verfasser"]; ?>' /></th>
	
	<th><input type='submit' value='Suchen' /></th>
	<th><input type='reset' /></th>
	<th></th>
	
	
	<th><a href='?seite=verwaltung'>Suche beenden</a></th>
</tr>
</form>
<tr>
	<th>Datei Index</th>
	<th>Kategorie - Nummer</th>
	<th>Beschreibung</th>
	<th>Dateityp - Nummer</th>
	<th>Eingang</th>
	<th>Verfasser</th>
	<th>Dateipfad</th>
	<th>Status</th>
	<th>Bearbeiten</th>	
	<!--<th>Download</th> -->
	<th>Loeschen</th>
	
	
</tr>
<?php
$sql = 	"select * from datei LEFT JOIN status 
									ON datei.status = status.statusnr";

$array = array();
if(isset($_POST["suche_kategorie"]) && $_POST["suche_kategorie"] != "")
{
	$array[] = "KategorieNR LIKE '%".$_POST["suche_kategorie"]."%'";
}
if(isset($_POST["suche_dateiname"]) && $_POST["suche_dateiname"] != "")
{
	$array[] = "Dateiname LIKE '%".$_POST["suche_dateiname"]."%'";									
}
if(isset($_POST["suche_eingang"]) && $_POST["suche_eingang"] != "")
{
	$array[] = "Eingang LIKE '%".$_POST["suche_eingang"]."%'";									
}
if(isset($_POST["suche_verfasser"]) && $_POST["suche_verfasser"] != "")
{
	$array[] = "Verfasser LIKE '%".$_POST["suche_verfasser"]."%'";									
}
if(isset($_POST["suche_dateityp"]) && $_POST["suche_dateityp"] != "")
{
	$array[] = "Dateityp_index LIKE '%".$_POST["suche_dateityp"]."%'";
}
if(count($array) > 0)
{
	$string = implode(" AND ", $array);
	$sql .= " WHERE ".$string;
}


$antwort = mysqli_query($connect, $sql);
							
							
while($datensatz = mysqli_fetch_array($antwort))
{
	
	
	
	
	
	
	if( $datensatz["Dateityp_index"] ==1) $datensatz["Dateityp_index"] = "PDF - 1";
else $datensatz["Dateityp_index"] = "JPEG - 2";

	if( $datensatz["KategorieNR"] ==1) $datensatz["KategorieNR"] = "Rechnung - 1";
else if( $datensatz["KategorieNR"] ==2) $datensatz["KategorieNR"] = "Mahnung - 2";
else if( $datensatz["KategorieNR"] ==3) $datensatz["KategorieNR"] = "Kostenvoranschlag - 3";
else $datensatz["KategorieNR"] = "Auftrag - 4";
	
	
	$string = " <tr>
					<td>".$datensatz["datei_index"]."</td>
					<td>".$datensatz["KategorieNR"]."</td>
					<td>".$datensatz["Dateiname"]."</td>
					<td>".$datensatz["Dateityp_index"]."</td>
					<td>".$datensatz["Eingang"]."</td>
					<td>".$datensatz["Verfasser"]."</td>
					
					<td> <a href='uploads/".$datensatz["Dateipfad"]."' target='_blank'>" .$datensatz["Dateipfad"]."</a></td>
					<td>".$datensatz["Status"]."</td>
					<td><a href='?seite=verwaltung&auftragnr=".$datensatz["datei_index"]."&modus=bearbeiten'>Bearbeiten</a></td>
			
					<td><a href='?seite=verwaltung&auftragnr=".$datensatz["datei_index"]."&modus=loeschen'>Löschen</a></td>
					
									
					
					
				</tr>";
	echo $string;		
	
	
}
?>
</table>


<?php

/*		<td><a href='?seite=verwaltung&auftragnr=".$datensatz["datei_index"]."&modus=download'>Download</a></td>*/





mysqli_close($connect);
?>