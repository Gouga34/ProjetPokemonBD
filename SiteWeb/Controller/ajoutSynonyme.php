<?php
	require_once("../Model/Utilisateur.class.php");
	
	// Header

	$u = new Utilisateur($_SESSION['login']);

	$u->creerSynonyme($_POST['nomSynonyme'], $_POST['nomTerme']);

	include_once('../View/synonymeAjoute.php');
	
	// Footer
?>