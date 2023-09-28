<?php
function database_connect(){
	try
	{
		$db = new PDO("sqlite:micheldrucker.sqlite");
	}
	catch(Exception $e)
	{
		die('Error connecting to DB: ' . $e->getMessage());
	}
	return $db;
}
?>
