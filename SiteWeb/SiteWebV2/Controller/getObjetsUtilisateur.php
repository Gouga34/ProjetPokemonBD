<?php
	require_once("../Model/Utilisateur.class.php");
	
	// Header

	$u = new Utilisateur($_SESSION['login']);

	$concepts = $u->getConcepts();
	$termes = $u->getTermes();
	$synonymes = $u->getSynonymes();

	include_once('../View/objetsUtilisateurs.php');
	
	// Footer
?>

