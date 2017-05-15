<?php
function database_connect(){
	try
	{
		// On se connecte à MySQL
		$bdd = new PDO('mysql:host=localhost;port=3306;dbname=micheldrucker', 'localmysqluser', 'foufoune');
		$bdd->exec("SET CHARACTER SET utf8");
	}
	catch(Exception $e)
	{
		// En cas d'erreur, on affiche un message et on arrête tout
		die('Erreur : '.$e->getMessage());
	}
	return $bdd;
}
// Si tout va bien, on peut continuer
?>
