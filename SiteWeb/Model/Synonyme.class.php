<?php

	/**
	*
	* @author Chataigner manuel 
	*
	*/
	class Synonyme
	{
		private $nomSynonyme;

		/**
		 * Constructeur
		 * @param nomSynonyme Nom du synonyme à créer
		*/
		function __construct($nomSynonyme)
		{
			$this->nomSynonyme = $nomSynonyme;
		}

		public function getNom()
		{
			return $this->nomSynonyme;
		}

		/**
		 * @return Nom de la vedette que le synonyme désigne
		*/
		public function getVedette()
		{
			$pdo = ConnexionBD::getPDO();

			$query = "SELECT t.nomTerme
						FROM TermeVedette t, table(t.synonymes) listeSynonymes
						WHERE VALUE(listeSynonymes) = (SELECT ref(s) FROM Synonyme s WHERE s.nomSynonyme = '".$this->nomSynonyme."')";

			$sth = $pdo->prepare($query);
			$sth->execute();

			if ($row = $sth->fetch())
			{
				return $row['NOMVEDETTE'];
			}

			return "";
		}

		/**
		 * @return login de l'utilisateur qui possède le synonyme
		*/
		public function getUtilisateur()
		{
			$pdo = ConnexionBD::getPDO();

			$query = "SELECT u.login
						FROM Utilisateur u, table(u.synonymes) listeSynonymes
						WHERE VALUE(listeSynonymes) = (SELECT ref(s) FROM Synonyme s WHERE s.nomSynonyme = '".$this->nomSynonyme."')";

			$sth = $pdo->prepare($query);
			$sth->execute();

			if ($row = $sth->fetch())
			{
				return $row['NOMVEDETTE'];
			}

			return "";
		}

		/**
		 * @action Change la vedette associée au synonyme
		 * @param nomVedette Nom de la vedette associée
		*/
		/*public function ajouterVedette($nomVedette)
		{
			$pdo = ConnexionBD::getPDO();

			// Suppression dans le tableau de la vedette actuelle (plusieurs vedettes possibles ??)
			$query = "DELETE FROM TABLE (SELECT synonymes FROM TermeVedette) synonyme
						WHERE VALUE(synonyme) = (SELECT ref(s) FROM Synonyme s WHERE s.idSynonyme = $synonyme->getId());";
			$pdo->query($query);

			// Ajout du synonyme pour la nouvelle vedette
			$query = "INSERT INTO TABLE (SELECT synonymes FROM TermeVedette WHERE nomTerme = '".$nomVedette."')
						VALUES ((SELECT ref(s) FROM Synonyme s WHERE s.nomSynonyme = '".$nomSynonyme."'));";
			
			$sth = $pdo->prepare($query);
			$sth->execute();
		}*/
	}
?>
