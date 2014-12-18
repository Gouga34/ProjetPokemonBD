<?php
	
	$c=new Concept("Pokemon");
	echo "Concept : ".$c->getNomConcept()."<br/>";
	//include("../View/accueil.php");
	
	$terme=new TermeVedette("Gobou");
	echo "Terme : ".$terme->getNomTerme()."<br/>";
	
	echo "description terme: ".$terme->getDescription()."<br/>";
	
	$terme->modifierDescription("Boubou <3");
	echo "nouvelle description : ".$terme->getDescription()."<br/>";

	$terme->avoirFils();
	echo "Synoymes : ";
	var_dump($terme->avoirListeSynonymes());
	echo "<br/>";
	
	
?>

