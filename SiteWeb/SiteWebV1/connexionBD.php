<?php
class ConnexionBD{
	public static function getPDO(){
		echo("ConnexionBD");

		try{
			$tns = "(DESCRIPTION =
				(ADDRESS_LIST =
					(ADDRESS = (PROTOCOL = TCP)(HOST = venus)(PORT = 1521))
					)
(CONNECT_DATA =
	(SERVICE_NAME = master)
	)
)";
$db_username = "login";
$db_password = "mdp";
$conn = new PDO("oci:dbname=".$tns,$db_username,$db_password);

}
catch(Exception $e){
	echo ($e->getMessage());
}

return $conn;
}
}
?>