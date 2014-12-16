<?php
include("connexionBD.php");


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
			
			
			$sth = $pdo->prepare("SELECT c.nomConcept from Concept c where nomConcept='Pokemon'");
		var_dump($sth->execute());
		$sth->fetchAll(PDO::FETCH_ASSOC);
		var_dump($result);
			
			/*$query="SELECT c.nomConcept,c.description FROM Concept c WHERE c.nomConcept='Pokemon'";
			echo $query."<br/>";
			$res=$pdo->prepare($query);
			$res->execute();
			$row=$res->fetch(PDO::FETCH_ASSOC);
			var_dump($row);
			/*while($row = $res->fetch()){
			var_dump($row);
				$this->nomConcept=$row['NOMCONCEPT'];
				$this->description=$row['DESCRIPTION'];
			}

			*/
			/*$query="SELECT DEREF(vedette).nomTerme FROM Concept WHERE nomConcept='".$nomConcept."'";
			//echo $query;
			$res=$pdo->prepare($query);
			$res->execute();
			while($row = $res->fetch()){
				$this->nomTerme=$row['DEREF(VEDETTE).NOMTERME'];
			}*/
		}


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
			//echo $req."<br/>";
			$res=$pdo->prepare($req);
			$res->execute();
	
			$row =$res->fetchAll();
			return $row;
			
		}
		//Requête ok, mais resultat à traiter mieux
		function getFils(){
			$pdo=ConnexionBD::getPDO();
			$req="select deref(value(listeFils)).nomConcept from concept c, table(c.fils) listeFils WHERE c.nomConcept='".$this->nomConcept."'";
			//echo $req."<br/>";
			$res=$pdo->prepare($req);
			$res->execute();
			$row =$res->fetchAll();
			//var_dump($row);
			return $row;
		}
		
		/**
		*@action ajoute un parent au concept this
		*/
		function ajouterParent($nomConceptParent){
			$pdo=ConnexionBD::getPDO();
			var_dump($this->nomConcept);
			echo $this->nomConcept;
			$req="INSERT INTO TABLE (SELECT parents FROM Concept WHERE nomConcept ='".$nomConceptParent."') VALUES ((SELECT ref(c) FROM Concept c WHERE nomConcept='".$this->nomConcept."'))";
			
			//echo $req;
			echo $nomConcept;
			$concept=new Concept($nomConcept);
			//$concept->ajouterFils($this->nomConcept);
			$res=$pdo->prepare($req);
			//var_dump($res->execute());
		}
		
		/**
		*@action, ajoute un fils dans la liste des fils
		*/
		function ajouterFils($nomConceptFils){
			$pdo=ConnexionBD::getPDO();
			$req="INSERT INTO TABLE(SELECT fils FROM Concept WHERE nomConcept='".$nomConceptFils."')VALUES((SELECT ref(c) FROM Concept c WHERE c.nomConcept='".$this->nomConcept."'))";
			$res=$pdo->prepare($req);
			$res->execute();
		}
}


	
	//echo "toto";
	$c=new Concept("Pokemon2");
	var_dump($c->getNomConcept());
	$c->ajouterParent("Test");
	
	/*echo "<br/>nomConcept : ".$c->getNomConcept();
	echo "<br/>description : ".$c->getDescription();
	echo "<br/>vedette : ".$c->getTermeVedette();
	$c->setDescription("nvDescription");
	echo "<br/>nvDescription : ".$c->getDescription();
	$c->setTermeVedette("Dresseurs");
	echo"<br/>nvTerme : ".$c->getTermeVedette();
	
	*/
	//$tuples=$c->getParents();
	//$c->getFils();
	//$c->ajouterParent("Pokemon");
	//$tuples=$c->getFils();
	/*var_dump($tuples);
	foreach($tuples as $fils){	
		echo "Fils : <br/>".$fils;
	}*/
	
	/*$pdo = ConnexionBD::getPDO();
	
	
	$query="SELECT nomConcept,description FROM Concept WHERE nomConcept='Pokemon'";
	$sth=$pdo->prepare($query);
	$sth->execute();
		while ($row = $sth->fetch())
		{
			echo "nomConcept : ".$row['NOMCONCEPT'];
			echo "descripiton : ".$row['DESCRIPTION'];
		}
	
      /*
        $query = "SELECT login FROM utilisateur";
        
        $sth = $pdo->prepare($query);
		$sth->execute();

		while ($row = $sth->fetch())
		{
			echo $row['LOGIN'];
		}
	*/
	
	
	
		
		
?>

