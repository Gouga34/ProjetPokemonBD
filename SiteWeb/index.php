<?php

	/**
	*
	* @author Lopez jimmy
	* @author Vidal morgane
	*
	*/


	//On démarre la session
	session_start();
	
	//session_destroy();
	//Appel du fichier permettant la connexion à la BD
	require_once('./connexionBD.php');
	//require_once('./Model/synonyme.php');
	require_once('./Model/Concept.class.php');
	//require_once('./Model/termeVedette.php');
	
	require_once('./Model/Utilisateur.class.php');

	include_once('./View/headTag.php');

	$tryConnexion = false;

	//gestion de la connexion :
	if(isset($_POST['login']) && isset($_POST['password'])){
		$resultConnexion = Utilisateur::connexion();
		
		$tryConnexion = true;

		if($resultConnexion) {
			$_GET['page'] = 'board';
		}
		else {
			$_GET['page'] = 'index';
		}
	}
	else {
		$_GET['page'] = 'index';	
	}

	//Header du site
	include_once('./Controller/headerController.class.php');
	$controlleur = 'headerController';


	if (!empty($_GET['page']) && is_file('./Controller/'.$_GET['page'].'Controller.class.php') && $_GET['page'] != 'index')
	{
				//$functionHeader = 'headerAction';
		$controlleur::getAction();

		if($tryConnexion) {
			Utilisateur::connectionSuccess();
		}

		include './Controller/'.$_GET['page'].'Controller.class.php';
		$controlleur = $_GET['page'].'Controller';
		$controlleur::getAction();

	}
	else if(!empty($_GET['page']) && !is_file('./Controller/'.$_GET['page'].'Controller.class.php')) {
				// TODO faire la gestion des erreurs
		include './Controller/errorController.class.php';
	}
	else {
		$controlleur::getAction();

		if($tryConnexion) {
			Utilisateur::connectionFailed();
		}

		include './Controller/indexController.class.php';

		$controlleur = 'indexController';
		$controlleur::getAction();
	}


	//Pied de page
			//include 'view/footer.php';
	include_once('./Controller/footerController.class.php');
	$controlleur = 'footerController';
	$function = 'defautAction';
	$controlleur::$function();

	
	
	?>
