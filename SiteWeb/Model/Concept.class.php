<?php

	/**
	*
	* @author Morgane Vidal 
	*
	*/
	class Concept{
			private $nomConcept;
			private $description;
			private $termeVedette;

		/**
		* Constructeur
		* @param idSynonyme Identifiant dy synonyme à créer
		*/
		function __construct($nomConcept)
		{
			$pdo = ConnexionBD::getPDO();
			
			$query="SELECT c.nomConcept,c.description FROM Concept c WHERE c.nomConcept='".$nomConcept."'";
			//echo $query."<br/>";
			$res=$pdo->prepare($query);
			$res->execute();
			$row=$res->fetch(PDO::FETCH_ASSOC);
			$this->nomConcept=$row['NOMCONCEPT'];
			$this->description=$row['DESCRIPTION'];
			
			
			$query="SELECT DEREF(vedette).nomTerme FROM Concept WHERE nomConcept='".$nomConcept."'";
			//echo $query;
			$res=$pdo->prepare($query);
			$res->execute();
			while($row = $res->fetch()){
				$this->nomTerme=$row['DEREF(VEDETTE).NOMTERME'];
			}
		}

		//Accesseurs------------------------------------------------------------------------------------------------------
		function getNomConcept(){
			return $this->nomConcept;
		}

		function getDescription(){
			return $this->description;
		}

		function getTermeVedette(){
			return $this->termeVedette;
		}
		
		function setDescription($nvDescription){
			$pdo = ConnexionBD::getPDO();
			$this->description=$nvDescription;
			$req="UPDATE Concept SET description='".$nvDescription."' WHERE nomConcept='".$this->nomConcept."'";
			$res=$pdo->prepare($req);
			$res->execute();
		}
		
		function setTermeVedette($nvNomTerme){
			$pdo=ConnexionBD::getPDO();
			$this->termeVedette=$nvNomTerme;
			$req="UPDATE Concept SET vedette=(SELECT REF(T)FROM TermeVedette T WHERE nomTerme='".$nvNomTerme."')WHERE Concept.nomConcept='".$this->nomConcept."'";
			$res=$pdo->prepare($req);
			$res->execute();
		}
		
		//Requête ok, mais resultat à traiter mieux
		function getParents(){
			$pdo=ConnexionBD::getPDO();
			$req="select deref(value(listeParents)).nomConcept from concept c, table(c.parents) listeParents WHERE c.nomConcept='".$this->nomConcept."'";
			$res=$pdo->prepare($req);
			$res->execute();
	
			$row =$res->fetchAll(PDO::FETCH_ASSOC);
			return $row;
			
		}
		//Requête ok, mais resultat à traiter mieux
		function getFils(){
			$pdo=ConnexionBD::getPDO();
			$req="select deref(value(listeFils)).nomConcept from concept c, table(c.fils) listeFils WHERE c.nomConcept='".$this->nomConcept."'";
			$res=$pdo->prepare($req);
			$res->execute();
			$row =$res->fetchAll();
			return $row;
		}
		
		/**
		*@action ajoute un parent au concept this
		*/
		function ajouterParent($nomConceptParent){
			$pdo=ConnexionBD::getPDO();
			//var_dump($this->nomConcept);
			//echo $this->nomConcept;
			$req="INSERT INTO TABLE (SELECT parents FROM Concept WHERE nomConcept ='".$this->nomConcept."') VALUES ((SELECT ref(c) FROM Concept c WHERE nomConcept='".$nomConceptParent."'))";
			$concept=new Concept($nomConcept);
			$res=$pdo->prepare($req);
			$t=$res->execute();
		}
		
		/**
		*@action, ajoute un fils dans la liste des fils
		*/
		function ajouterFils($nomConceptFils){
			$pdo=ConnexionBD::getPDO();
			$req="INSERT INTO TABLE(SELECT fils FROM Concept WHERE nomConcept='".$this->nomConcept."')VALUES((SELECT ref(c) FROM Concept c WHERE c.nomConcept='".$nomConceptFils."'))";
			$res=$pdo->prepare($req);
			$res->execute();
		}
}
	
?>

