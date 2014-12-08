<?php


	require_once('./connexionBD.php');	

	$pdo = ConnexionBD::getPDO();



	$login = 'toto@gmail.com';

	$query = "SELECT login FROM Utilisateur";// WHERE mail='".$login;

	//echo($query);

	$res = $pdo->prepare($query);

	$res->execute();

	while($row = $res->fetch()){echo($row['LOGIN']);}

	

?>