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
		
		private $idTerme
		private $nomTerme
		private $description
		
		public function_construct($nom, $desc){
			
			$this->nomTerme = $nom;
			$this->description = $descrip;
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
		
		$query = "UPDATE TermeVedette SET description='".$desc."' WHERE idTerme='".$this->idTerme."';";
		
		$sth = $pdo->prepare($query);
		
		$sth->execute();
		
		}
		
		public function modifierParent($nom, $desc){
		
		
		
		}
		
		public function modifierNomTerme($nom){
		
		$pdo = ConnexionBD::getPDO();
		
		$query = "UPDATE TermeVedette SET nom='".$nom."' WHERE idTerme='".$this->idTerme."';";
		
		$sth = $pdo->prepare($query);
		
		$sth->execute();
		
		}
		
		public function avoirFils(){
		
		$pdo = ConnexionBD::getPDO();
		
    	$query = "SELECT deref(VALUE(listeFils)) FROM terme t, TABLE(t.fils) listeFils WHERE t.idTerme = '".$this->idTerme."';";
    	
    	$sth = $pdo->prepare($query);
		
		$sth->execute();
		
		}
	
	}


<?
