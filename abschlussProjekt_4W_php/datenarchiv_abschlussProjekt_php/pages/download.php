<?php
	
	$antwort = mysqli_query($connect, "select dateipfad from datei");
	
	$datei_name = $antwort["dateipfad"];
	
	$path = $_FILES["datei"]["dateipfad"];

       header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename='.$datei_name. '');
header('Content-Transfer-Encoding: binary');
header('Expires: 0');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Pragma: public');
header('Content-Length: ' . filesize($path));
ob_clean();
flush();
readfile($path); 	
exit();
    

?>