<?php	
	/**
	*
	* @author Lopez jimmy
	*
	*/

	if($_SESSION['login']) {

		include ('./View/board.php');
	}
	else {
		header('Location: ./index.php?alert=connexionFailed'); 
	}
?>
