<?php

session_start();
$seite = $_GET["seite"] ?? "home";





if(isset($_POST["login"]))
{	
	$connect = mysqli_connect("localhost","root","","datenarchiv_pape");
	mysqli_query($connect, "SET NAMES utf8");
	
	$antwort = mysqli_query($connect, "select MitarbeiterNR from user 
	where Username='".$_POST["login"]."' 	AND 	Passwort=('".$_POST["password"]."') ");
	
	
	
	
	// Prüfung ob genau ein Datensatz passt
	if($antwort->num_rows == 1)
	{
		// den eingeloggten Status speichern
		$_SESSION["erfolgreich_eingeloggt"] = true;	
		
		$daten = mysqli_fetch_array($antwort); // Datensatz rausziehen
		
		$_SESSION["MitarbeiterNR"] = $daten["MitarbeiterNR"]; // speichern in der Session
		
		

	// Überprüfen ob es ein Admin ist
			if( $_SESSION["MitarbeiterNR"] == 1){
	$_SESSION["Admin"] = true;
		echo 
					"<script type='text/javascript'>
					   setTimeout('document.getElementById(\'aenderung\').style.display = \'none\';', 3000);
					</script>

					<span id='aenderung'>
						<h1 style='color:green'>Erfolgreich als Admin eingeloggt!</h1>
					</span>";
	}else echo 
					"<script type='text/javascript'>
					   setTimeout('document.getElementById(\'aenderung\').style.display = \'none\';', 3000);
					</script>

					<span id='aenderung'>
						<h1 style='color:green'>Erfolgreich eingeloggt!</h1>
					</span>";

	
	}
	else
	{
		echo 
					"<script type='text/javascript'>
					   setTimeout('document.getElementById(\'aenderung\').style.display = \'none\';', 3000);
					</script>

					<span id='aenderung'>
						<h1 style='color:red'>Fehler beim einloggen!</h1>
					</span>";
	}
	
	
	mysqli_close($connect);
}





// Logout durchführen
if(isset($_GET["seite"]) && $_GET["seite"] == "logout")
{

	unset($_SESSION["erfolgreich_eingeloggt"]);
	unset($_SESSION["mitarbeiternr"]);	
	unset($_SESSION["Admin"]);	
}



// Oberen HTML - Teil einfügen
include("templates/html_oben.php");

switch($seite)
{
	case "home":
		include("pages/login.php");
	break;
	case "registrierung":
		include("pages/registrierung.php"); 	
	break;
	case "logout":
		include("pages/logout.php");
		break;
		case "MemberVerwaltung":
		if(isset($_SESSION["Admin"]))
		{	
			// Formular zum Bearbeiten / speichern der User-Daten ## nur als Admin möglich/sichtbar ##
			if(isset($_POST["bearbeiten_speichern"]))
			{	
				$connect = mysqli_connect("localhost","root","", "datenarchiv_pape");
				mysqli_query($connect, "SET NAMES utf8");
				
				$sql = "UPDATE user 		
										SET Adresse = '".$_POST["adresse"]."',
											Passwort = '".$_POST["passwort"]."',
											Mail = '".$_POST["mail"]."'
										WHERE MitarbeiterNR = '".$_POST["auftragnr"]."'";
				
				mysqli_query($connect, $sql);	
				
				if($connect->affected_rows == 1)	// NUR, WENN EIN DATENSATZ VERÄNDERT WURDE (ANZAHL ZEILEN)
				{		
					echo 
					"<script type='text/javascript'>
					   setTimeout('document.getElementById(\'aenderung\').style.display = \'none\';', 3000);
					</script>

					<span id='aenderung'>
						<h1 style='color:green'>Änderungen erfolgreich gespeichert</h1>
					</span>";
}else
				{
										echo "<script type='text/javascript'>
											setTimeout('document.getElementById(\'aenderung\').style.display = \'none\';', 3000);
											</script>

											<span id='aenderung'>
												<h1 style='color:green'>Es gab keine Änderungen</h1>
											</span>";
					if($connect->error || $connect->affected_rows == -1) # bei Fehler!!!
					{
						echo "<script type='text/javascript'>
							 setTimeout('document.getElementById(\'aenderung\').style.display = \'none\';', 3000);
							</script>

							<span id='aenderung'>
							<h1 style='color:red'>Es ist ein Fehler aufgetreten. Bitte kontaktieren Sie den Admin!</h1>
							</span>";
						echo $connect->error."<br />";
						$_GET["auftragnr"] = $_POST["auftragnr"];
						$_GET["modus"] = "bearbeiten";
					}
				}
				mysqli_close($connect);
			}
			
			
			
					// Formular zum Löschen
			if(isset($_POST["loeschen_bestaetigen"]) && $_POST["loeschen_bestaetigen"] == "JA")
			{
				$connect = mysqli_connect("localhost","root","", "datenarchiv_pape");
				mysqli_query($connect, "SET NAMES utf8");
				
				$sql = "SELECT * FROM user WHERE MitarbeiterNR = '".$_POST["auftragnr"]."'";
				$antwort = mysqli_query($connect, $sql);
				$datensatz = mysqli_fetch_array($antwort);
				 
				
				
				
				
				
				$sql = "DELETE FROM user WHERE MitarbeiterNR = '".$_POST["auftragnr"]."'";
				
				#echo "<h1>$sql</h1>";
				mysqli_query($connect, $sql);
				
				if($connect->affected_rows == 1)	// NUR, WENN EIN DATENSATZ VERÄNDERT WURDE (ANZAHL ZEILEN)
				{			
					echo 
					"<script type='text/javascript'>
					   setTimeout('document.getElementById(\'aenderung\').style.display = \'none\';', 3000);
					</script>

					<span id='aenderung'>
						 <h1 style='color:green'>Der User wurde gelöscht</h1>
					</span>";
									
									}
									else
									{
										echo "<script type='text/javascript'>
											   setTimeout('document.getElementById(\'aenderung\').style.display = \'none\';', 3000);
											</script>

											<span id='aenderung'>
												<h1 style='color:green'>Der User konnte nicht gelöscht werden</h1>
											</span>";
										if($connect->error || $connect->affected_rows == -1) # bei Fehler!!!
										{
											echo 
											"<script type='text/javascript'>
											   setTimeout('document.getElementById(\'aenderung\').style.display = \'none\';', 3000);
											</script>

											<span id='aenderung'>
											   <h1 style='color:red'>Es ist ein Fehler aufgetreten. Bitte kontaktieren Sie den Admin!</h1>
											</span>";
						echo $connect->error."<br />";
					}
				}			
				
				
				mysqli_close($connect);
			}
			
			if(isset($_GET["auftragnr"]))
			{
			
				if(isset($_GET["modus"]))
				{
				
					switch($_GET["modus"])
					{
						case "bearbeiten":
							// Bearbeitungsseite
							include("pages/Member_bearbeiten.php");	
						break;
						
						case "loeschen":
							// Löschseite
							include("pages/Member_loeschen.php");				
						break;						
						
						
						
						case "status":
							// Detailseite
							include("pages/MemberVerwaltung_details.php");	
						break;
						default:							
							echo "Ein Fehler ist aufgetreten: falscher Modus";
					}
				}
				else
				{
					echo "Ein Fehler ist aufgetreten: Modus nicht ausgewählt";
				}			
			}
			else
			{
				// Hauptseite		
				include("pages/MemberVerwaltung.php"); # externe Datei einbinden 		
			}
		}
		else
		{
			include("pages/login.php");
			
		}		
		
		break;
		
		
	case "datei_hochladen":
	if(isset($_SESSION["erfolgreich_eingeloggt"]))
		{	
		include("pages/datei_hochladen.php"); # externe Datei einbinden		
		}	else
		{
			include("pages/login.php");
			
		}	
	break;
	case "verwaltung": 	
		// Prüfe ob Zugriff erlaubt ist
		if(isset($_SESSION["erfolgreich_eingeloggt"]))
		{	
			// Formular zum Bearbeiten / speichern der Daten
			if(isset($_POST["bearbeiten_speichern"]))
			{	
				$connect = mysqli_connect("localhost","root","", "datenarchiv_pape");
				mysqli_query($connect, "SET NAMES utf8");
				
				$sql = "UPDATE datei 		
										SET Dateiname = '".$_POST["dateiname"]."',
											Status = '".$_POST["status"]."',
											KategorieNR = '".$_POST["kategorie"]."'
										WHERE datei_index = '".$_POST["auftragnr"]."'";
				
				#echo "<h1>$sql</h1>";
				mysqli_query($connect, $sql);	
				
				if($connect->affected_rows == 1)	// NUR, WENN EIN DATENSATZ VERÄNDERT WURDE (ANZAHL ZEILEN)
				{		
					echo 
					"<script type='text/javascript'>
					   setTimeout('document.getElementById(\'aenderung\').style.display = \'none\';', 3000);
					</script>

					<span id='aenderung'>
						<h1 style='color:green'>Änderungen erfolgreich gespeichert</h1>
					</span>";
				}
				else
				{
					echo "<h1 style='color:green'>Es gab keine Änderungen</h1>";
					if($connect->error || $connect->affected_rows == -1) # bei Fehler!!!
					{
						echo
						"<script type='text/javascript'>
							setTimeout('document.getElementById(\'aenderung\').style.display = \'none\';', 3000);
						</script>

						<span id='aenderung'>
							<h1 style='color:red'>Es ist ein Fehler aufgetreten. Bitte kontaktieren Sie den Admin!</h1>
						</span>";
						echo $connect->error."<br />";
						$_GET["auftragnr"] = $_POST["auftragnr"];
						$_GET["modus"] = "bearbeiten";
					}
				}
				mysqli_close($connect);
			}
			
			
			
					// Formular zum Löschen
			if(isset($_POST["loeschen_bestaetigen"]) && $_POST["loeschen_bestaetigen"] == "JA")
			{
				$connect = mysqli_connect("localhost","root","", "datenarchiv_pape");
				mysqli_query($connect, "SET NAMES utf8");
				
				$sql = "SELECT * FROM datei WHERE datei_index = '".$_POST["auftragnr"]."'";
				$antwort = mysqli_query($connect, $sql);
				$datensatz = mysqli_fetch_array($antwort);
				 $dateiziel = $datensatz["Dateipfad"];
				
				
				
				
				
				$sql = "DELETE FROM datei WHERE datei_index = '".$_POST["auftragnr"]."'";
				
				#echo "<h1>$sql</h1>";
				mysqli_query($connect, $sql);
				
				if($connect->affected_rows == 1)	// NUR, WENN EIN DATENSATZ VERÄNDERT WURDE (ANZAHL ZEILEN)
				{			
					echo "<script type='text/javascript'>
					   setTimeout('document.getElementById(\'aenderung\').style.display = \'none\';', 3000);
					</script>

					<span id='aenderung'>
						<h1 style='color:green'>Die Datei wurde gelöscht</h1>
					</span>";
					if(file_exists("uploads/".$dateiziel))
					{
						// Datei entfernen
						unlink("uploads/".$dateiziel); # löschen	
							
					}
				}
				else
				{
					echo "<script type='text/javascript'>
					   setTimeout('document.getElementById(\'aenderung\').style.display = \'none\';', 3000);
					</script>

					<span id='aenderung'>
						<h1 style='color:green'>Die Datei konnte nicht gelöscht werden</h1>
					</span>";
					if($connect->error || $connect->affected_rows == -1) # bei Fehler!!!
					{
						echo "<script type='text/javascript'>
					   setTimeout('document.getElementById(\'aenderung\').style.display = \'none\';', 3000);
					</script>

					<span id='aenderung'>
						<h1 style='color:red'>Es ist ein Fehler aufgetreten. Bitte kontaktieren Sie den Admin!</h1>
					</span>";
						echo $connect->error."<br />";
					}
				}			
				
				
				mysqli_close($connect);
			}
			
			
			
		
		
			
				
		
		
			// Prüfe, ob die Auftragnr im Link steht
			if(isset($_GET["auftragnr"]))
			{
			
				if(isset($_GET["modus"]))
				{
				
					switch($_GET["modus"])
					{
						case "bearbeiten":
							// Bearbeitungsseite
							include("pages/verwaltung_bearbeiten.php");	
						break;
						
						case "loeschen":
							// Löschseite
							include("pages/verwaltung_loeschen.php");				
						break;						
						case "download":
					
						include("pages/download.php");
						break;
						
						case "status":
							// Detailseite
							include("pages/verwaltung_details.php");	
						break;
						default:							
							echo "Ein Fehler ist aufgetreten: falscher Modus";
					}
				}
				else
				{
					echo "Ein Fehler ist aufgetreten: Modus nicht ausgewählt";
				}			
			}
			else
			{
				// Hauptseite		
				include("pages/verwaltung.php"); # externe Datei einbinden 		
			}
		}
		else
		{
			include("pages/login.php");
			
		}		
	break;		
	break;
	default:
		include("pages/404.php"); # externe Datei einbinden	
}

include("templates/html_unten.php");
?>
