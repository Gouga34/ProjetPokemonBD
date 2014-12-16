<?php
	require_once("../Model/Utilisateur.class.php");
	
	// Header

	$u = new Utilisateur($_SESSION['login']);

	$u->creerTerme($_POST['nomTerme'], $_POST['description']);

	$nomConcept = $_POST['nomTerme'];		// Différent ?
	$descriptionConcept = $_POST['description'];

	$u->creerConcept($nomConcept, $descriptionConcept, $_POST['parent'], $_POST['nomTerme']);


	include_once('../View/vedetteAjoutee.php');
	
	// Footer
?>