<?php
	//On démarre la session
	session_start();
	
	//session_destroy();
	//Appel du fichier permettant la connexion à la BD
	require_once('connexionBD.php');
	require_once('./Model/utilisateur.php');
	require_once('./Model/synonyme.php');
	require_once('./Model/concept.php');
	require_once('./Model/termeVedette.php');
	
	//Header du site
	include_once('./controller/header.php');
	 
	//Ajout du contrôleur s'il existe et s'il est spécifié
	if (!empty($_GET['page']) && is_file('controller/'.$_GET['page'].'.php'))
	{
			include 'controller/'.$_GET['page'].'.php';
	}
	else
	{
			include 'controller/accueil.php';
	}
	 
	//Pied de page
	include 'view/footer.php';

?>
