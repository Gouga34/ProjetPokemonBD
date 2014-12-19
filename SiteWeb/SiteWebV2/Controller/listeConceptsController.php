<?php
	//$termes = TermeVedette::getTermes();

	$concepts = Concept::getConcepts();

	include_once('./View/listeConcepts.php');
?>
