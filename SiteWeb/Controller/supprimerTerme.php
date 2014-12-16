<?php
	require_once("../Model/Utilisateur.class.php");
	
	// Header

	$u = new Utilisateur($_SESSION['login']);

	// On supprime le concept associée qui va supprimer le synonyme
	$u->supprimerConcept($_POST['nomTerme']);

	include_once('../View/termeSupprime.php');
	
	// Footer
?>