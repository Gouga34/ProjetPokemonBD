<?php

	/**
	*
	* @author Chataigner manuel 
	*
	*/
	class Synonyme
	{
		private $idSynonyme;
		private $nomSynonyme;
/**
* Constructeur
* @param idSynonyme Identifiant dy synonyme à créer
*/
function __construct($idSynonyme)
{
	$pdo = ConnexionBD::getPDO();
// Récupération du synonyme dans le tableau
	$query = "SELECT deref(VALUE(listeSynonymes))
	FROM TermeVedette t, TABLE(t.synonymes) listeSynonymes
	WHERE deref(VALUE(listeSynonymes)).idSynonyme=$idSynonyme;";
	$res = $pdo->query($query);
	if ($row = $res->fetch())
	{
		$this->idSynonyme = $idSynonyme;
		$this->nomSynonyme = $row['nomSynonyme'];
	}
}
public function getId()
{
	return $this->idSynonyme;
}
public function getNom()
{
	return $this->nomSynonyme;
}
/**
* @action Change la vedette associée au synonyme
* @param vedette Nouvelle vedette associée
*/
public function modifierVedette($vedette)
{
	$pdo = ConnexionBD::getPDO();
// Suppression dans le tableau de la vedette actuelle (plusieurs vedettes possibles ??)
	$query = "DELETE FROM TABLE (SELECT synonymes FROM TermeVedette) synonyme
	WHERE VALUE(synonyme) = (SELECT ref(s) FROM Synonyme s WHERE s.idSynonyme = $synonyme->getId());";
	$pdo->query($query);
// Ajout du synonyme pour la nouvelle vedette
	$query = "UPDATE TermeVedette
	set synonymes = GroupeSynonyme_t((SELECT ref(s) FROM Synonyme s WHERE s.idSynonyme = $idSynonyme))
	where idTerme = $vedette->getId();";
	$query2 = "INSERT INTO TABLE (SELECT synonymes FROM TermeVedette WHERE idTerme = $vedette->getId())
	VALUES ((SELECT ref(s) FROM Synonyme s WHERE s.idSynonyme = $idSynonyme));";
	$pdo->query($query);
}
}
?>