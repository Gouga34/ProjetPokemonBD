<?php
	require_once("../Model/Utilisateur.class.php");
	
	// Header

	$u = new Utilisateur($_SESSION['login']);

	$u->supprimerCompte();

	include_once('../View/compteSupprime.php');
	
	// Footer
?>

