<?php

	$BD_HOST = "database";
	$BD_BASE = "mediatheque";
	$BD_USER = "root";
	$BD_PASSWORD = "root";


	// white list are more secure than black list ;)
	$pages = ["login", "register", "films", "add_films_and_realisators", "home", "my_films"];
	
	try 
	{
		$BD = new PDO("mysql:host=".$BD_HOST.";dbname=".$BD_BASE.";charset=UTF8", $BD_USER, $BD_PASSWORD);		//connection à MySQL
	} 
	catch(Exception $e)		//pb de connection à la base
	{
		echo "<center style='color:red'> Problème de connexion à la base de données. </center>";
		exit();
	}
?>