<?php
	session_start();

	include("includes/conf.php");

	function film_exist($id, $BD) {
		$query = $BD->prepare(
		<<<SQL
			SELECT * FROM film where id_film=:id;
		SQL);

		$query->execute(array(':id' => $id));
		$row = $query->rowCount();

		if($row > 0) {
			return True;
		} else {
			return False;
		}
	}


	if(!isset($_SESSION['logged']) || !$_SESSION['logged'] == True){
		echo json_encode(array(
			"error" => True, 
			"message" => "you're not logged :("
		));
		die();
	}

	if(isset($_GET["id"]) && (int)$_GET['id'] != 0) {
		$query = $BD->prepare(
			<<<SQL
				SELECT * FROM emprunt where id_film=:id;
			SQL);

		$query->execute(array(':id' => (int) $_GET['id'] ));
		$row = $query->rowCount();
		if($row > 0 || !film_exist((int) $_GET['id'], $BD)) {
		echo json_encode(array(
			"error" => True, 
			"message" => "film not available"
		));
		die();
		}


		$query = $BD->prepare(
			<<<SQL
				INSERT INTO emprunt(id_film, id_users, date_emprunt, date_retour)
				VALUES(:id, :id_users, :date_emprunt, :date_retour);
			SQL);
		$query->execute(array(
			':id' => (int) $_GET['id'],
			':id_users' => $_SESSION['id_user'],
			':date_emprunt' => date("Y-m-d"),
			':date_retour' => date("Y-m-d", strtotime(date('Y-m-d'). ' + 10 days')) 
			// actual date + 10 days.
		));
		echo json_encode(array(
			"error" => False, 
			"message" => "film booked :)"
		));
		die();


	} else {
		echo json_encode(array(
			"error" => True, 
			"message" => "we don't have this film"
		));
		die();

	}

	/*
	idee :

	ajouter une colonne booleene pour savoir si le film est reservé ou non dans la tables film

	plutot que de tjr faire une requete vers la table emprunt

	ce serai plus simple pour savoir si un film est dispo ou non sur la page film.php
	*/

?>