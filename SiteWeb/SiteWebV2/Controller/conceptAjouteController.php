<?php

	$u = new Utilisateur($_SESSION['login']);

	// Description du concept en + ?
	
	$u->creerTerme($_POST['nomTerme'], $_POST['description'], $_POST['parents']);

	include_once('./View/conceptAjoute.php');
?>

