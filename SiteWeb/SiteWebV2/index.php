<?php
	//On démarre la session
	//session_start();
	
	//session_destroy();
	//Appel du fichier permettant la connexion à la BD
	require_once('connexionBD.php');

	//require_once('./Model/Utilisateur.class.php');
	//require_once('./Model/Synonyme.class.php');
	require_once('Model/Concept.class.php');
	require_once('Model/TermeVedette.class.php');
	//echo "?";
	//Header du site
	//include_once('./controller/header.php');
	 
	//Ajout du contrôleur s'il existe et s'il est spécifié
	if (!empty($_GET['page']) && is_file('controller/'.$_GET['page'].'.php'))
	{
			include 'Controller/'.$_GET['page'].'.php';
	}
	else
	{
			include 'Controller/accueil.php';
	}
	 
	//Pied de page
	//include 'view/footer.php';
?>
