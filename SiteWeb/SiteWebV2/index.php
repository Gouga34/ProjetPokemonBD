<?php
	session_start();

	require_once('connexionBD.php');

	require_once('./Model/Utilisateur.class.php');
	require_once('./Model/Synonyme.class.php');
	require_once('./Model/Concept.class.php');
	require_once('./Model/TermeVedette.class.php');

	include_once('./View/headerTag.php');	 

	if (!empty($_GET['page']) && is_file('./Controller/'.$_GET['page'].'Controller.php'))
	{
		if($_GET['page'] != 'connexion' && $_GET['page'] != 'inscription')
			include './View/header.php';
		else
			include './View/headerHome.php';

			if(!empty($_GET['alert']) && $_GET['alert'] == 'creationConceptReussi')
				echo ("Création du concept : ");

		include './Controller/'.$_GET['page'].'Controller.php';
	}
	else
	{
		include './View/headerHome.php';

		if(!empty($_GET['alert']) && $_GET['alert'] == 'connexionFailed')
			echo ("Connexion Failed");

		include_once './View/accueil.php';
	}
	 
	include_once './View/footer.php';
?>
