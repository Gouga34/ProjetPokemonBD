<?php
	require_once("../Model/Utilisateur.class.php");
	
	// Header

	$u = new Utilisateur($_SESSION['login']);

	// Description du concept en + ?
	
	$u->creerTerme($_POST['nomTerme'], $_POST['description'], $_POST['nomParent']);


	include_once('../View/vedetteAjoutee.php');
	
	// Footer
?>

