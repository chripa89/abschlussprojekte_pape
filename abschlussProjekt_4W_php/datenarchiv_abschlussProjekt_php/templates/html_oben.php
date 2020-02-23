<!DOCTYPE html>
<html>

<head>
	<title>Datei Übersicht</title>
	<link href="css/styles.css" rel="stylesheet" type="text/css" />
</head>

<body>
	<div class="main">
	<div class="kopf">
		<ul>
		<li>
		<a href='?seite=home' class="test">Home</a>
		</li>
		<li>
		<a href='?seite=datei_hochladen'>Datei hochladen</a>
		</li>
		<li>
		<a href='?seite=verwaltung'>Verwaltung</a>		
		</li>
		<?php 
		if(isset($_SESSION["erfolgreich_eingeloggt"]))
		{
		?>
		
				<li>
				<a href='?seite=logout'>Logout</a>
				</li>
		<?php
		} # ende von if
		?>	
		
			<?php 
		if(isset($_SESSION["Admin"]))
		{
		?>	
				<li>
				<a href='?seite=MemberVerwaltung'>Member Verwaltung</a>
				</li>
		<?php
		} # ende von if
		?>	
		
		
		
		</ul>
		
	</div>

	<div class="hauptteil">