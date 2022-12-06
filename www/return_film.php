<?php
	session_start();

	include("includes/conf.php");

	if(!isset($_SESSION['logged']) || !$_SESSION['logged'] == True){
		echo json_encode(array(
			"error" => True, 
			"message" => "you're not logged :("
		));
		die();
	}

	if (isset($_GET['id'])) {
		$query = $BD->prepare("delete from emprunt where id_emprunt=:id_emprunt and  id_users=:id_user;");
		$query->execute(
			array(
				':id_emprunt' => (int) $_GET['id'],
				':id_user' => (int) $_SESSION['id_user']
			)
		);
		echo json_encode(array());
	}

?>