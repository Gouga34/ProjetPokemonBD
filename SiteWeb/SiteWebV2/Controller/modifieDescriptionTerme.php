<?php

	$titre = "modifier la description d'un terme";
	
	require_once("../Model/Terme.class.php");
	
	$t = new Terme($_SESSION['login']);
	
	$t->modifierDescription($_POST['description']);
	
	include_once('../View/modifierDescription.php');
?>
