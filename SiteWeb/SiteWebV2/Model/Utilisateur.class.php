<?php
	
	//require("./connexionBD.php");
	
	/**
	*
	* @author Chataigner manuel 
	* @author Lopez jimmy
	*
	*/

	class Utilisateur
	{
		private $login;
		private $mail;
		private $admin;
		
		/**
		 * Constructeur
		 * @param $donnees
		 * @param $session
		*/

		function __construct($donnees, $session)
		{
			$this->login = $donnees['LOGIN'];
			$this->mail = $donnees['MAIL'];
			$this->admin = $donnees['ADMIN'];

			if($session){
				$_SESSION['login'] = $donnees['LOGIN'];
				$_SESSION['mail'] = $donnees['MAIL'];
				$_SESSION['admin'] = $donnees['ADMIN'];
			}
		}

		public function connexion() {
	
			$login = $_POST['login'];
			$mdp = $_POST['password'];

			$pdo = ConnexionBD::getPDO();

			$query = "SELECT login, mail, admin FROM Utilisateur WHERE login='".$login."' AND mdp = '".$mdp."'";

			$res = $pdo->prepare($query);
			$res->execute();
			$row = $res->fetch();
		
			if ($row)
			{
				$user = new Utilisateur($row, true);

				return $user;
			}
			else
			{

				return 0;
			}
		}

		public function connectionSuccess() {
			echo('<div class="bs-example">
					<div class="alert alert-success">
						<a href="#" class="close" data-dismiss="alert">&times;</a>
						<strong>Connexion réussi : </strong> Bienvenu sur le site Pokésaurus.
					</div>
				</div>'
				);
		}


		public function connectionFailed() {
			echo('<div class="bs-example">
					<div class="alert alert-danger">
						<a href="#" class="close" data-dismiss="alert">&times;</a>
						<strong>Échec connexion : </strong> L\'email et le mot de passe avec lequel vous êtes connecté n\'appartiennent à aucun compte de Pokésaurus.
					</div>
				</div>'
			);
		}

		public function inscription() {
echo("inscription");

			$login = $_POST['login'];
			$mdp = $_POST['password'];
			$mail = $_POST['email'];

			$pdo = ConnexionBD::getPDO();

			$query = "INSERT INTO Utilisateur (login, mdp, mail, admin, concepts, synonymes, termes) VALUES ('".$login."', '".$mdp."', '".$mail."', 0,
GroupeConcept_t(), GroupeSynonyme_t(), GroupeTerme_t());";

			$res = $pdo->prepare($query);
			$res->execute();
			$row = $res->fetch();

			$query = "SELECT login, mail, admin FROM Utilisateur WHERE login='".$login."' AND mdp = '".$mdp."'";

			$res = $pdo->prepare($query);
			$res->execute();
			$row = $res->fetch();

			if ($row)
			{
				$user = new Utilisateur($row, true);
				return $user;
			}
			else
			{
				return 0;
			}
		}

		public function inscriptionFailed() {
			echo('<div class="bs-example">
					<div class="alert alert-danger">
						<a href="#" class="close" data-dismiss="alert">&times;</a>
						<strong>Échec inscription : </strong> L\'email avec lequel vous êtes inscrit appartiennent à un compte existant de Pokésaurus.
					</div>
				</div>'
			);
		}

		public function inscriptionSuccess() {
			echo('<div class="bs-example">
					<div class="alert alert-success">
						<a href="#" class="close" data-dismiss="alert">&times;</a>
						<strong>Inscription réussi : </strong> Bienvenu sur le site Pokésaurus.
					</div>
				</div>'
				);
		}

		public function deconnection(){
			session_destroy();
		}

		public function getLogin()
		{
			return $this->login;
		}

		public function getMdp()
		{
			return $this->mdp;
		}

		public function getMail()
		{
			return $this->mail;
		}

		public function estAdmin()
		{
			return $this->admin;
		}


		/**
		 * @return liste des concepts de l'utilisateur
		*/
		public function getConcepts()
		{
			$pdo = ConnexionBD::getPDO();

			$query = "SELECT DEREF(VALUE(listeConcepts)).nomConcept
						FROM Utilisateur u, table(u.concepts) listeConcepts
						WHERE u.login = '".$this->login."'";

			$sth = $pdo->prepare($query);
			$sth->execute();

			$row=$sth->fetchAll();
			$tuples;
			$i;
			foreach($row as $c){
				$tuples[$i]=new Concept($c['NOMCONCEPT']);
				$i++;
			}
			return $tuples;
		}

		/**
		 * @return liste des termes de l'utilisateur
		*/
		public function getTermes()
		{
			$pdo = ConnexionBD::getPDO();

			$query = "SELECT DEREF(VALUE(listeTermes)).nomTerme
						FROM Utilisateur u, table(u.termes) listeTermes
						WHERE u.login = '".$this->login."'";

			$sth = $pdo->prepare($query);
			$sth->execute();

			$row=$sth->fetchAll();
			$tuples;
			$i=0;
			foreach($row as $t){
				$tuples[$i]=new TermeVedette($t['NOMTERME']);
				$i++;
			}
			return $tuples;
		}

		/**
		 * @return liste des synonymes de l'utilisateur
		*/
		public function getSynonymes()
		{
			$pdo = ConnexionBD::getPDO();

			$query = "SELECT DEREF(VALUE(listeSynonymes)).nomSynonyme
						FROM Utilisateur u, table(u.synonymes) listeSynonymes
						WHERE u.login = '".$this->login."'";

			$sth = $pdo->prepare($query);
			$sth->execute();

			$row=$sth->fetchAll();
			$tuples;
			$i=0;
			foreach($row as $s){
				$tuples[i]=new Synonyme($s['NOMSYNONYME']);
				$i++;
			}
			return $tuples;
		}

		/**
		 * @action Insère un concept dans la bd
		 * @param nomConcept Nom du concept
		 * @param description Description
		 * @param parent Parent du concept créé
		*/
		public function creerConcept($nomConcept, $description, $nomParent, $nomTerme)
		{
			$pdo = ConnexionBD::getPDO();
			
			if (empty($nomParent)){
				$query = "INSERT INTO Concept (nomConcept, description, vedette, parents, fils) VALUES ('".$nomConcept."', '".$description."',
						(select REF(t) from TermeVedette t where t.nomTerme = '".$nomTerme."'),
						GroupeConcept_t(),
						GroupeConcept_t())";
			}
			else{

				$query = "INSERT INTO Concept (nomConcept, description, vedette, parents, fils) VALUES ('".$nomConcept."', '".$description."',
						(select REF(t) from TermeVedette t where t.nomTerme = '".$nomTerme."'),
						GroupeConcept_t((SELECT ref(c) FROM Concept c WHERE c.nomConcept = '".$nomParent."')),
						GroupeConcept_t())";
			}

			$sth = $pdo->prepare($query);
			$res = $sth->execute();

			if (!$res)
				return false;

			if (!empty($nomParent))
			{
				// Insertion du concept dans les fils du parent

				$query = "INSERT INTO TABLE (SELECT fils FROM Concept WHERE nomConcept = '".$nomParent."')
							VALUES ((SELECT ref(c) FROM Concept c WHERE c.nomConcept = '".$nomConcept."'))";

				$sth = $pdo->prepare($query);
				$sth->execute();
			}

			// Insertion du concept dans la table Utilisateur

			$query = "INSERT INTO TABLE (SELECT concepts FROM Utilisateur WHERE login = '".$this->login."')
						VALUES ((SELECT ref(c) FROM Concept c WHERE c.nomConcept = '".$nomConcept."'))";
			
			$sth = $pdo->prepare($query);
			$sth->execute();

			return true;
		}

		/**
		 * @action Insère un terme vedette dans la bd
		 * @param nomTerme Nom du terme
		 * @param description Description
		 * @param concept Concept lié au terme vedette
		*/
		public function creerTerme($nomTerme, $descriptionTerme, $nomParent,$descriptionConcept)
		{
			$pdo = ConnexionBD::getPDO();

			$query = "INSERT INTO TermeVedette (nomTerme, description, synonymes)
						VALUES ('".$nomTerme."', '".$descriptionTerme."', GroupeSynonyme_t())";

			$sth = $pdo->prepare($query);
			$res = $sth->execute();

			if (!$res)
				return false;

			// Insertion du terme dans la table Utilisateur

			$query = "INSERT INTO TABLE (SELECT termes FROM Utilisateur WHERE login = '".$this->login."')
						VALUES ((SELECT ref(t) FROM TermeVedette t WHERE t.nomTerme = '".$nomTerme."'))";

			$sth = $pdo->prepare($query);
			$sth->execute();
			
			$nomConcept = "Concept".$nomTerme;
			
			if (!empty($nomParent)){
				$nomConceptParent = "Concept".$nomParent;
			}
			
			// On créé automatiquement le concept associé
			return $this->creerConcept($nomConcept, $descriptionConcept, $nomConceptParent, $nomTerme);
		}

		/**
		 * @action Insère dans la bd un synonyme lié à la vedette passé en paramètre
		 * @param nomSynonyme Nom du synonyme
		 * @param vedette Terme vedette lié au synonyme
		*/
		public function creerSynonyme($nomSynonyme, $nomTerme)
		{
			$pdo = ConnexionBD::getPDO();
			
			$query = "INSERT INTO Synonyme (nomSynonyme) VALUES ('".$nomSynonyme."')";
			
			$sth = $pdo->prepare($query);
			$res = $sth->execute();

			if (!$res)
				return false;

			// Insertion du synonyme dans la table Vedette

			$query = "INSERT INTO TABLE (SELECT synonymes FROM TermeVedette WHERE nomTerme = '".$nomTerme."')
						VALUES ((SELECT ref(s) FROM Synonyme s WHERE s.nomSynonyme = '".$nomSynonyme."'))";
			
			$sth = $pdo->prepare($query);
			$sth->execute();

			// Insertion du synonyme dans la table Utilisateur

			$query = "INSERT INTO TABLE (SELECT synonymes FROM Utilisateur WHERE login = '".$this->login."')
						VALUES ((SELECT ref(s) FROM Synonyme s WHERE s.nomSynonyme = '".$nomSynonyme."'))";

			$sth = $pdo->prepare($query);
			$sth->execute();

			return true;
		}

		/**
		 * @action Supprime le concept de la bd
		 * @param nomConcept Nom du concept à supprimer
		*/
		public function supprimerConcept($nomConcept)
		{
			$pdo = ConnexionBD::getPDO();
			
			// Suppression des références parent au concept supprimé dans les autres concepts
			$query = "DELETE FROM TABLE (SELECT parents FROM Concept) tabParents
						WHERE VALUE(tabParents) = (SELECT ref(c) FROM Concept c WHERE c.nomConcept = '".$nomConcept."')";
			
			$sth = $pdo->prepare($query);
			$sth->execute();

			// Suppression des références parent au concept supprimé dans les autres concepts
			$query = "DELETE FROM TABLE (SELECT fils FROM Concept) tabFils
						WHERE VALUE(tabFils) = (SELECT ref(c) FROM Concept c WHERE c.nomConcept = '".$nomConcept."')";
			
			$sth = $pdo->prepare($query);
			$sth->execute();
			
			// Suppression du conept dans la table utilisateur
			$query = "DELETE FROM TABLE (SELECT concepts FROM Utilisateur WHERE login = '".$this->login."') tabConcepts
						WHERE VALUE(tabConcepts) = (SELECT ref(c) FROM Concept c WHERE c.nomConcept = '".$nomConcept."')";
			
			$sth = $pdo->prepare($query);
			$sth->execute();
		
			// Suppression du concept
			$query = "DELETE FROM Concept WHERE nomConcept = '".$nomConcept."'";
			
			$sth = $pdo->prepare($query);
			$sth->execute();
		}

		/**
		 * @action Supprime le terme de la bd
		 * @param nomTerme Nom du terme à supprimer
		*/
		public function supprimerTerme($nomTerme)
		{
			$pdo = ConnexionBD::getPDO();
			
			// Suppression du conept dans la table utilisateur

			$query = "DELETE FROM TABLE (SELECT termes FROM Utilisateur WHERE login = '".$this->login."') tabTermes
						WHERE VALUE(tabTermes) = (SELECT ref(t) FROM TermeVedette t WHERE t.nomTerme = '".$nomTerme."')";

			$sth = $pdo->prepare($query);
			$sth->execute();
			
			// On sélectionne tous les synonymes associés

			$query = "SELECT DEREF(VALUE(listeSynonymes)).nomSynonyme
						FROM TermeVedette t, TABLE(t.synonymes) listeSynonymes
						WHERE t.nomTerme = '".$nomTerme."'";

			$sth = $pdo->prepare($query);
			$sth->execute();

			// On les supprime
			while ($row = $sth->fetch())
			{
				$this->supprimerSynonyme($row['DEREF(VALUE(LISTESYNONYMES)).NOMSYNONYME']);
			}
			
			
			// Suppression du concept associé
			$query = "SELECT c.nomConcept FROM Concept c WHERE c.vedette = (SELECT ref(t) FROM TermeVedette t WHERE t.nomTerme = '".$nomTerme."')";
			
			$sth = $pdo->prepare($query);
			$sth->execute();

			if ($row = $sth->fetch()) {
				$nomConcept = $row['NOMCONCEPT'];
				$this->supprimerConcept($nomConcept);
			}

			$query = "DELETE FROM TermeVedette WHERE nomTerme = '".$nomTerme."'";
			$sth = $pdo->prepare($query);
			$sth->execute();
		}

		/**
		 * @action Supprime le synonyme de la bd
		 * @param synonyme Synonyme à supprimer
		*/
		public function supprimerSynonyme($nomSynonyme)
		{
			$pdo = ConnexionBD::getPDO();

		 	// Suppression du synonyme dans la table utilisateur

			$query = "DELETE FROM TABLE (SELECT synonymes FROM Utilisateur WHERE login = '".$this->login."') tabSynonymes
						WHERE VALUE(tabSynonymes) = (SELECT ref(s) FROM Synonyme s WHERE s.nomSynonyme = '".$nomSynonyme."'";

			$sth = $pdo->prepare($query);
			$sth->execute();

			// Suppression du synonyme dans la table vedette

			$query = "DELETE FROM TABLE (SELECT synonymes FROM TermeVedette) tabSynonymes
						WHERE VALUE(tabSynonymes) = (SELECT ref(s) FROM Synonyme s WHERE s.nomSynonyme = '".$nomSynonyme."'";

			$sth = $pdo->prepare($query);
			$sth->execute();

			// Suppression du synonyme

			$query = "DELETE FROM Synonyme WHERE nomSynonyme = '".$nomSynonyme."'";
			$sth = $pdo->prepare($query);
			$sth->execute();
		}

		/**
		 * @action Supprime le compte courant de la bd
		*/
		public function supprimerCompte()
		{
			$pdo = ConnexionBD::getPDO();

			$query = "DELETE FROM Utilisateur WHERE login = '".$this->login."'";

			$sth = $pdo->prepare($query);
			$sth->execute();

			// Suppression des concepts, termes et synonymes créés ?
		}
	}
	

	
?>


