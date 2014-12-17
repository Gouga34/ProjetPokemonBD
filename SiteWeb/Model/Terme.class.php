<?php


/*========================================================================
Nom: Terme.php           Auteur: Geoffrey Dumas
Maj:  01/12/2014         Creation: 01/12/2014
Projet: BDD
--------------------------------------------------------------------------
Specification:
Ce fichier contient l'implémentation des fonctions de la classe Terme.
=========================================================================*/

// modifier parent + verif requete

	class Terme{

		private $nomTerme;
		private $description;
		
		public function Terme ($nom , $desc){
			
			$this->nomTerme = $nom;
			$this->description = $desc;
		}
	
		public function getNomterme()
		{
			return $this->nomTerme;
		}
	
		public function getDescription()
		{
			return $this->description;
		}
	
		public function modifierDescription($desc){
		 
		$pdo = ConnexionBD::getPDO();
		
		$query = "UPDATE TermeVedette SET description='".$desc."' WHERE nomTerme='".$this->nom."';";
		
		$sth = $pdo->prepare($query);
		
		$sth->execute();
		
		}
		
		public function modifierNomTerme($nom){
		
		$pdo = ConnexionBD::getPDO();
		
		$query = "UPDATE TermeVedette SET nom='".$nom."' WHERE nomTerme='".$this->nom."';";
		
		$sth = $pdo->prepare($query);
		
		$sth->execute();
		
		}
		
		public function avoirFils(){
		
		$pdo = ConnexionBD::getPDO();
		
    	$query = "SELECT deref(VALUE(listeFils)) FROM terme t, TABLE(t.fils) listeFils WHERE t.nomTerme = '".$this->nom."';";
    	
    	$sth = $pdo->prepare($query);
		
		$sth->execute();
		
		}
	
	}


?>
