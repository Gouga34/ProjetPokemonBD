<?php

	$concept = Concept::trouverDansArbo($_POST['concept']);


	if($concept == null){
		include_once('./View/conceptIntrouvable.php');
	}
	else{
		include_once('./View/trouverConcept.php');
	}
?>
