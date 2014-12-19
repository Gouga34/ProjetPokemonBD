<?php
	require_once("../Model/Utilisateur.class.php");

	$u = new Utilisateur($_SESSION['login']);
	
	$u->supprimerTerme($_POST['nomTerme']);

	include_once('../View/termeSupprime.php');
?>

