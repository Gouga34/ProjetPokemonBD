<?php	
	require_once("../Model/Concept.class.php");
	
	$nomParent = $_POST['parent'];
	$nomFils = $_POST['fils'];
	
	if($nomParent != $nomFils)
	{
		
		$parent = new Concept($nomParent);
		$parent->ajouterFils($nomFils);
	
		$fils = new Concept($nomFils);
		$fils->ajouterParent($nomParent);


		include_once('../View/ajoutFilsView.php');
	}
	else
	{
		include_once('../View/lienParenteImpossibleView.php');
	}
?>
