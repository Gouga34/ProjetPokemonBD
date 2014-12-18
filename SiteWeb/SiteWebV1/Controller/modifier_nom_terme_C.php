<?php

	$titre = "modifier le nom d'un terme";
	
	require_once("../Model/Terme.class.php");
	
	$t = new Terme($_SESSION['login']);
	
	$t->modifierNomTerme($_POST['nomTerme']);
	
	include_once('../View/modifierNomTerme.php');
	
?>
