<?php
	//On démarre la session
	session_start();
	
	//session_destroy();
	//Appel du fichier permettant la connexion à la BD

	require_once('connexionBD.php');

	require_once('./Model/Utilisateur.class.php');
	require_once('./Model/Synonyme.class.php');
	require_once('./Model/Concept.class.php');
	require_once('./Model/TermeVedette.class.php');

	include_once('./View/headerTag.php');	 




	//Ajout du contrôleur s'il existe et s'il est spécifié
	if (!empty($_GET['page']) && is_file('./Controller/'.$_GET['page'].'Controller.php'))
	{

		if($_GET['page'] != 'connexion' && $_GET['page'] != 'inscription')
		{
			include './View/header.php';
		}
		else {
			include './View/headerHome.php';
		}

		include './Controller/'.$_GET['page'].'Controller.php';
	}
	else
	{
		include './View/headerHome.php';

		include_once './View/accueil.php';
	}
	 
	include_once './View/footer.php';
?>
