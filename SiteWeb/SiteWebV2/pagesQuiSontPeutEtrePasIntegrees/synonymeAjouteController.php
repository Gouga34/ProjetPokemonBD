<?php
	require_once("../Model/Utilisateur.class.php");

	$u = new Utilisateur($_SESSION['login']);
	
	$u->creerSynonyme($_POST['nomSynonyme'], $_POST['terme']);

	include_once('../View/synonymeAjouteView.php');
?>

