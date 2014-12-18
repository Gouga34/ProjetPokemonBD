<?php
/*========================================================================
Nom: listeTermesController.php           Auteur:Clément AGRET 
				Morgane Vidal 
				Manuel Chataigner
				
Maj:  18/12/2014         Creation: 18/12/2014
Projet de base de données avancées
--------------------------------------------------------------------------

=========================================================================*/

/*=== Récupere liste termes ===*/
$concept = new Concept($_GET['nomConcept']);
$vedette = new TermeVedette($concept->getTermeVedette());

$synonymes = $vedette->avoirListeSynonymes();

/*=== Affiche liste termes ===*/
include("../View/descriptionConceptView.php");

?>
