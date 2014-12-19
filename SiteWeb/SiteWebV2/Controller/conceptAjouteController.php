<?php

	$u = new Utilisateur($_SESSION['login']);

	// Description du concept en + ?
	


	$u->creerTerme($_POST['nomTerme'], $_POST['descriptionTerme'], $_POST['parents'],$_POST['descriptionConcept']);
	
	

	header('Location: ./index.php?page=arbre&alert=creationConceptReussi'); 

	//include_once('./View/conceptAjoute.php');
?>


