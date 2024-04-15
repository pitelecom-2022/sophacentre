<?php

session_start();

?>

<!DOCTYPE html>
<head>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css" type="text/css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-indigo.css" type="text/css">
<link rel="stylesheet" href="./style.css">
<link rel="stylesheet" type="text/css" href="https:///cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/all.min.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="./app.js"></script>

</head>


<?php
	if ($_SESSION["loggedin"]==true) { 
?>

<body>
<div class="w3-bar w3-light-grey">
	<a class="w3-bar-item w3-button" href="./dashboard.php">Dashboard</a>
	<a class="w3-bar-item w3-button w3-right" href="logout.php">Déconnexion</a>
	<a class="w3-bar-item w3-button" href="./calls.php">Journal d'appels</a>
<?php
	if(in_array($_SESSION["profile"],Array("superviseur","admin"))) {
#		echo "<a class=\"w3-bar-item w3-right w3-button\" href=\"./recordings.php\">Enregistrements</a>";
	}
?>
		
	<a class="w3-bar-item w3-button w3-border w3-border-red w3-center" href="./live.php">Live Monitoring</a>
<!--	<button class="w3-button w3-bar-item w3-right">Bonjour <?php echo $_SESSION["username"]; ?></button>-->
</div>

<?php
	}
	else {
		echo "<div class=\"w3-container\"><p>Vous n'êtes pas connecté. Merci de vous <a href=\"index.php\">identifier</a>.";
		die();
	}
?>

