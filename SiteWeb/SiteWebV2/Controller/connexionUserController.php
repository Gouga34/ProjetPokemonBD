<?php

	/**
	*
	* @author Lopez jimmy
	*
	*/

	$resultConnexion = Utilisateur::connexion();

	if($resultConnexion == 0) {
		header('Location: ./index.php?alert=connexionFailed'); 
	}
	else {
		header('Location: ./index.php?page=board'); 
	}
?>
