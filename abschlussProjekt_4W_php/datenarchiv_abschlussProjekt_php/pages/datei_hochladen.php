<?php
$connect = mysqli_connect("localhost","root","","datenarchiv_pape");
mysqli_query($connect, "SET NAMES utf8");	// Die Übertragung auf UTF-8 umstellen#
$dateipfad = isset($_POST["dateipfad"]) ? $_POST["dateipfad"] : "";
// Formular nur anzeigen, wenn es nicht verschickt wurde
if(!isset($_POST["datei_name"]))
{
?>	

<form action="" method="post" enctype="multipart/form-data">	
	Wird hochgeladen von User: <br>
		
	<?php
		$antwort = mysqli_query($connect, "select * from user");
		while($datensatz = mysqli_fetch_array($antwort))
		{if ( $_SESSION["MitarbeiterNR"] == $datensatz["MitarbeiterNR"]){
			echo $datensatz["Username"];}}
	?>
	<br>
	<br>
	Kurze Zusammenfassung: 
	<br>
	<input name="datei_name"  cols="10" ></input>	
	<br >
	<br>
	Dateityp :<br>
	<select name="dateityp">	
		<?php
			$antwort = mysqli_query($connect, "select * from dateityp");

			while($datensatz = mysqli_fetch_array($antwort))
			{
				echo '<option value="'.$datensatz["Dateityp_index"].'" >'.$datensatz["Dateityp"].'</option>';
			}		
		?>
		<br />
	</select>
	<br />
	<br>
	Kategorie :<br>
	<select name="kategorie">	
		<?php
			$antwort = mysqli_query($connect, "select * from kategorien");
			while($datensatz = mysqli_fetch_array($antwort))
			{echo '<option value="'.$datensatz["KategorieNR"].'">'.$datensatz["Kategorie"].'</option>';}		
		?>	
	</select>
	<br />
	<br />
	Datei:<br />
	<input type="file" name="dateipfad" />	
	<br />
	<br>
	Status :<br>
	<select name="status">	
	<?php
		$antwort = mysqli_query($connect, "select * from status");
		while($datensatz = mysqli_fetch_array($antwort))
		{echo '<option value="'.$datensatz["Statusnr"].'">'.$datensatz["Status"].'</option>';}		
	?>
	
	</select>
	<br />
	<br />

	<input type="submit" /> 	
	</form>
<?php
} # ende der if abfrage
?>		
	

<!-- ----------------------------------------------------------- -->
<?php


   
 function dateiErstellen($parameter,$check ) {
	 
	$filename = pathinfo($_FILES['dateipfad']['name'], PATHINFO_FILENAME);
$extension = strtolower(pathinfo($_FILES['dateipfad']['name'], PATHINFO_EXTENSION));

 
//Überprüfung der Dateiendung
$allowed_extensions = array( 'jpeg', 'pdf');
if(!in_array($extension, $allowed_extensions)) {
 die("<a href='?seite=datei_hochladen'>Versuch es erneut!</a> <br><br> Ungültige Dateiendung. Nur jpeg und pdf-Dateien sind erlaubt.");
}
	// Extrahieren des MiME Typs
	$zeichenkette = $_FILES['dateipfad']['type'];
	$datei_typ_test = substr($zeichenkette, strrpos($zeichenkette,"/")+1);
					
	
	$datei_original = $_FILES["dateipfad"]["name"];  
	$datei_tempname = $_FILES["dateipfad"]["tmp_name"];
	
	
	
	if ($parameter ==  $datei_typ_test && $check == 5 )
	{
		$neuer_dateiname = uniqid("datei_").".pdf";
		move_uploaded_file($datei_tempname, "uploads/".$neuer_dateiname);
	 
	 return $neuer_dateiname;
	echo "<pre>";
	print_r($_POST); // Textdaten 1. Teil
	print_r($_FILES); // Dateidaten 2. Teil
	echo "</pre>";		
	} else if( $parameter ==  $datei_typ_test && $check == 15 )
	{
	$neuer_dateiname = uniqid("datei_").".jpeg";
	move_uploaded_file($datei_tempname, "uploads/".$neuer_dateiname);
	 
	 return $neuer_dateiname;
	echo "<pre>";
	print_r($_POST); // Textdaten 1. Teil
	print_r($_FILES); // Dateidaten 2. Teil
	echo "</pre>";	
	}else die( "<script type='text/javascript'>
					   setTimeout('document.getElementById(\'aenderung\').style.display = \'none\';', 3000);
					</script>

					<span id='aenderung'>
						<h1 style='color:red'>Falscher Dateityp ausgewählt!</h1>
					
					</span> <br><br><a href='?seite=datei_hochladen'>Versuch es erneut!</a>	");
	
	
	
 }
 

// Programm ausführen, wenn das Formular verschickt wurde



if(isset($_POST["datei_name"]))
{
	if($_POST["dateityp"] == 1){
		
	$neuer_dateiname = dateiErstellen("pdf",5);
	
	}
	else if($_POST["dateityp"] == 2){
	$neuer_dateiname = dateiErstellen("jpeg",15);
	}
	
	$antwort = mysqli_query($connect, "select * from user");

	
		while($datensatz = mysqli_fetch_array($antwort))
	{
	if ( $_SESSION["MitarbeiterNR"] == $datensatz["MitarbeiterNR"]){
		$Verfasser =  $datensatz["Username"];
		
	}}
	$Dateityp_index 		= $_POST["dateityp"];
	$Datei_name 		= $_POST["datei_name"];	
	$KategorieNR 			= $_POST["kategorie"];
	$datum =  date("d-m-Y  H:i");
	$status = $_POST["status"];
	
	



	
	$sql = "insert into datei 
			( Verfasser, dateityp_index, Dateiname, KategorieNR, Eingang, Status, Dateipfad)
			values
			( '$Verfasser', '$Dateityp_index', '$Datei_name', '$KategorieNR', '$datum', '$status',
			'$neuer_dateiname')";	
	$antwort = mysqli_query($connect, $sql);	
	
	echo "<h1>Ihre Datei wurde erfolgreich hochgeladen!</h1>";
	echo "<br>";
	echo "<a href='?seite=datei_hochladen'>Noch eine Datei hochladen</a>";

}
?>
<?php
mysqli_close($connect);
?>