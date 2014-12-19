<?php


/*========================================================================
Nom: TermeVedette.class.php           Auteur:Geoffrey Dumas 
				Morgane Vidal 
				Manuel Chataigner
				
Maj:  17/12/2014         Creation: 01/12/2014
Projet de base de données avancées
--------------------------------------------------------------------------
Specification:
Ce fichier contient l'implémentation des fonctions 
permettant de traiter la table TermeVedette.
=========================================================================*/

	class TermeVedette{

		private $nomTerme;
		private $description;
		
		public function __construct($nomTerme){
			$pdo = ConnexionBD::getPDO();
			$this->nomTerme = $nomTerme;
		
			$req="SELECT nomTerme, description FROM TermeVedette WHERE nomTerme='".$nomTerme."'";
			$res=$pdo->prepare($req);
			$res->execute();
			$row=$res->fetch(PDO::FETCH_ASSOC);
			$this->description=$row['DESCRIPTION'];
		}
	
		public function getNomTerme()
		{
			return $this->nomTerme;
		}
	
		public function getDescription()
		{
			return $this->description;
		}
		
		/**
		*@action modifie la description de this dans la BD
		*/
		public function modifierDescription($desc){
		 
			$pdo = ConnexionBD::getPDO();
			$query = "UPDATE TermeVedette SET description='".$desc."' WHERE nomTerme='".$this->nomTerme."'";
			$sth = $pdo->prepare($query);
			$sth->execute();
			$this->description=$desc;
		
		}
		

		/**
		*@action récupère les fils du concept ayant pour terme vedette this
		*/
		public function avoirFils(){
		
			$pdo = ConnexionBD::getPDO();
			$query="SELECT c.nomConcept FROM Concept c Where c.vedette = (SELECT REF(t) FROM TermeVedette t WHERE t.nomTerme='".$this->nomTerme."')";
	    		$res = $pdo->prepare($query);
			$res->execute();
			$row=$res->fetch(PDO::FETCH_ASSOC);
			$concept=new Concept($row['NOMCONCEPT']);
			
			return($concept->getFils());
		}
		
		/**
		*@return la liste des synonymes du termeVedette this
		*/
		public function avoirListeSynonymes(){
			$pdo = ConnexionBD::getPDO();
			$query="SELECT deref(VALUE(listeSynonymes)).nomSynonyme FROM TermeVedette t, TABLE(t.synonymes) listeSynonymes WHERE t.nomTerme = '".$this->nomTerme."'";
			$res = $pdo->prepare($query);
			$res->execute();
			$row=$res->fetchAll(PDO::FETCH_ASSOC);
			return $row;
		}
		
		
	
		public static function getTermes(){
			$pdo=ConnexionBD::getPDO();
			
			$req="select nomTerme from TermeVedette";

			$res=$pdo->prepare($req);
			$res->execute();
			$row=$res->fetchAll();
			return $row;
		}
	}


?>
