<?php
	class ConnexionBD{
		
		public static function getPDD(){
			try{
				$dbc = new PDO('oci:dbname=venus/orcl;charset=CL8MSWIN1251', 'mvidal02', 'louvetea');
			}
			catch(Exception $e){
				die('Erreur : '.$e->getMessage());
			}
			return $dbc;
		}
		
	}

?>