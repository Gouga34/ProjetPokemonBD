<?php
	
	require("./connexionBD.php");
	
	/**
	*
	* @author Chataigner manuel 
	* @author Lopez jimmy
	*
	*/

	class Utilisateur
	{
		private $login;
		private $mdp;
		private $mail;
		private $admin;

		//TODO la liste des concepts et thermes
		
		/**
		 * Constructeur
		 * @param login de l'utilisateur à créer
		*/
		function __construct($login)
		{
			$pdo = ConnexionBD::getPDO();
			// TODO FAIRE VARIABLE DE SESSION
			// TODO TOUT A REFAIRE car incorect manu
			//$this->login = $login;
			/**/
			$query = "SELECT login, mdp, mail, admin FROM Utilisateur WHERE login='".$login."'";

			$ssh = $pdo->prepare($query);
			$ssh->execute();
			
			if ($row = $ssh->fetch())
			{
				$this->login = $login;
				$this->mdp = $row['MDP'];
				$this->mail = $row['MAIL'];
				$this->admin = $row['ADMIN'];
			}
			/*$this->nom = $donnees->nom;
			$this->prenom = $donnees->prenom;
			$this->admin = $donnees->admin;

			if($session){ // au cas ou on doit créer des utilisateurs : pour profil des membre par exemple
				$_SESSION['login'] = $donnees->login;
				$_SESSION['nom'] = $donnees->nom;
				$_SESSION['prenom'] = $donnees->prenom;
				$_SESSION['admin'] = $donnees->admin;

				//TODO idem list des concept etc ...
			}*/
		}

		public function connexion() {
			//TODO faire verif
			$login = $_POST['login'];
			//$mdp = md5($_POST['password']);


			// refaire la requete pour la connexion d'un user 
			echo("888");
		
			$pdo = ConnexionBD::getPDO();

			echo($pdo);

			$query = "SELECT * FROM Utilisateur WHERE login='".$login."'";
			$res = $pdo->prepare($query);
			$ssh = $res->execute();
			$row = $ssh->fetch();

			echo($row);


			if ($row)
			{
				echo($row);
				$user = new Utilisateur($row, false);
			}
			else
			{
				return 0;
			}

				//$pdo = ConnexionBD::getPDO();
				//$query = "SELECT * FROM Utilisateur WHERE login = '.$login.'" AND mdp = "'.$mdp.'";
				//$res = $pdo->query($query);
			/*
				if($login === 'zerocooldu30@gmail.com' && $mdp === md5('a')) { // TODO tester si la requete est vide pour le teste je verif juste si login c'est mon mail perso
					//$user = new Utilisateur($login, false);
					$user = new Utilisateur($login);
					// md5($mdp);
					return $user;
				}
				else {
					return 0;
				}*/
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
			$login = $_POST['login'];
			$mdp = md5($_POST['password']);

			

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

			return $sth->fetchAll();
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

			return $sth->fetchAll();
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

			return $sth->fetchAll();
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
			$sth->execute();

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
		}

		/**
		 * @action Insère un terme vedette dans la bd
		 * @param nomTerme Nom du terme
		 * @param description Description
		 * @param concept Concept lié au terme vedette
		*/
		public function creerTerme($nomTerme, $description, $nomParent)
		{
			$pdo = ConnexionBD::getPDO();

			$query = "INSERT INTO TermeVedette (nomTerme, description, synonymes)
						VALUES ('".$nomTerme."', '".$description."', GroupeSynonyme_t())";

			$sth = $pdo->prepare($query);
			$sth->execute();

			// Insertion du terme dans la table Utilisateur

			$query = "INSERT INTO TABLE (SELECT termes FROM Utilisateur WHERE login = '".$this->login."')
						VALUES ((SELECT ref(t) FROM TermeVedette t WHERE t.nomTerme = '".$nomTerme."'))";

			$sth = $pdo->prepare($query);
			$sth->execute();
			
			$nomConcept = "Concept".$nomTerme;
			$nomConceptParent = "Concept".$nomParent;
			
			// On créé automatiquement le concept associé
			//creerConcept($nomConcept, $description, $nomConceptParent, $nomTerme);
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
			$sth->execute();

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
			$query = "DELETE FROM TABLE (SELECT concepts FROM Utilisateur) tabConcepts
						WHERE VALUE(tabConcepts) = (SELECT ref(c) FROM Concept c WHERE c.nomConcept = '".$nomConcept."')";
			
			$sth = $pdo->prepare($query);
			$sth->execute();
		
			// Suppression du concept
			$query = "DELETE FROM Concept WHERE nomConcept = '".$concept->getNom()."'";
			
			$sth = $pdo->prepare($query);
			$sth->execute();
			
			// Suppression du terme vedette associé
			$sth = $pdo->prepare("SELECT DEREF(vedette).nomTerme FROM Concept WHERE nomConcept = '".$nomConcept."'");
			$sth->execute();

			if ($row = $sth->fetch()) {
				$nomTerme = $row['DEREF(VEDETTE).NOMTERME'];
				supprimerTerme($nomTerme);
			}
		}

		/**
		 * @action Supprime le terme de la bd
		 * @param nomTerme Nom du terme à supprimer
		*/
		public function supprimerTerme($nomTerme)
		{
			$pdo = ConnexionBD::getPDO();
			
			// Suppression du conept dans la table utilisateur

			$query = "DELETE FROM TABLE (SELECT termes FROM Utilisateur) tabTermes
						WHERE VALUE(tabTermes) = (SELECT ref(t) FROM TermeVedette t WHERE t.nomTerme = '".$nomTerme."'";

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
				supprimerSynonyme($row['DEREF(VALUE(LISTESYNONYMES)).NOMSYNONYME']);
			}


			$query = "DELETE FROM TermeVedette WHERE nomTerme = '".$nomTerme;"'";
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

			$query = "DELETE FROM TABLE (SELECT synonymes FROM Utilisateur) tabSynonymes
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
	
	$u = new Utilisateur('Falindir');
	
	//$u->creerTerme('Pokemon', 'creature pouvant evoluer', "");
	//$u->creerSynonyme('Poke', 'Pokemon');
	
	//$u->supprimerSynonyme('Poke');
	//$u->supprimerConcept('Concept poke');
	
	//$u->supprimerCompte();
	
?>


