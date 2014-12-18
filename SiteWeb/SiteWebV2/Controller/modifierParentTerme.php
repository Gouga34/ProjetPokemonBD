<?php

	$titre = "modifier le parent d'un terme";
	
	require_once("../Model/Terme.class.php");
	
	$t = new Terme($_SESSION['login']);
	
	$t->modifierParent($_POST['nomTerme'], $_POST['description']);
	
	include_once('../View/modifierParent.php');
?>
