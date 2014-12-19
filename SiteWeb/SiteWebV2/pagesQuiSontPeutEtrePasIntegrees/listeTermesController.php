<?php
/*========================================================================
Nom: listeTermesController.php           Auteur:Clément AGRET 

				
Maj:  18/12/2014         Creation: 18/12/2014
Projet de base de données avancées
--------------------------------------------------------------------------

=========================================================================*/



/*=== Récupere liste termes ===*/
$termesV = TermeVedette::getTermes();


/*=== Affiche liste termes ===*/
include("../View/listeTermesView.php");

?>
