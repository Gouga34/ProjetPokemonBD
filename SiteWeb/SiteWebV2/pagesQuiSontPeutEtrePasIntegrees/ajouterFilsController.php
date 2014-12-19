<?php	
	require_once("../Model/TermeVedette.class.php");
	
	$termes = TermeVedette::getTermes();

	include_once('../View/ajouterFilsView.php');
?>