<?php
	require_once("../Model/Utilisateur.class.php");
	
	// Header

	$u = new Utilisateur($_SESSION['login']);

	$u->supprimerConcept($_POST['nomSynonyme']);

	include_once('../View/synonymeSupprime.php');
	
	// Footer
?>

