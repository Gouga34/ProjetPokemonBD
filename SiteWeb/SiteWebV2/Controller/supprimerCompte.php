<?php

	$u = new Utilisateur($_SESSION['login']);

	$u->supprimerCompte();

	include_once('../View/compteSupprime.php');
?>

