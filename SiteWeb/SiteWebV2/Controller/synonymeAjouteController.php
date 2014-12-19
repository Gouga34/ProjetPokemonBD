<?php


	$u = new Utilisateur($_SESSION['login']);

	$u->creerSynonyme($_POST['nomSynonyme'], $_POST['terme']);


	include_once('./View/synonymeAjouteView.php');
?>

