<?php

	$titre = "avoir le fils d'un terme";
	
	require_once("../Model/Terme.class.php");
	
	$t = new Terme($_SESSION['login']);
	
	$t->avoirFils();
	
	include_once('../View/avoirFils.php');
?>
