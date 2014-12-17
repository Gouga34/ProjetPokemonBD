<?php
	require_once("../Model/Utilisateur.class.php");
	
	// Header

	$u = new Utilisateur($_SESSION['login']);

	// On supprime le terme qui va supprimer le concept associé et les synonymes
	$u->supprimerTerme($_POST['nomTerme']);

	include_once('../View/termeSupprime.php');
	
	// Footer
?>

