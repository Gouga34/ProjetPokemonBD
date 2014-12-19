<?php
	require_once('../Model/Concept.class.php');

	$concept = Concept::trouverDansArbo($_POST['concept']);


	if($concept == null){
		include_once('../View/conceptIntrouvableView.php');
	}
	else{
		include_once('../View/trouverConceptView.php');
	}
?>
