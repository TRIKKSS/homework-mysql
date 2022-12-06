<?php
	include("includes/conf.php");

	if (
		isset($_POST['nom_film']) && !empty($_POST['nom_film']) &&
		isset($_POST['annee_film']) && !empty($_POST['annee_film']) &&
		isset($_POST['realisateur']) && !empty($_POST['realisateur']) &&
		isset($_POST['categorie']) && !empty($_POST['categorie']) &&
		isset($_FILES['image_film']) && !empty($_FILES['image_film']) &&
		isset($_POST['description']) && !empty($_POST['description'])
	) {
		// first check if the file is an image

		// if not : die()
		
		$check = getimagesize($_FILES["image_film"]["tmp_name"]);

		if($check !== false) {
			$query = $BD->prepare(<<<SQL
				INSERT INTO film(nom_film, annee_film, description, id_realisateur, id_categorie)
				VALUES(:nom, :annee, :description, :id_realisateur, (select id_categorie from categorie where nom_categorie=:categorie));
			SQL);
			$query->execute(
				array(
					':nom' => $_POST['nom_film'],
					':annee' => (int) $_POST['annee_film'],
					':description' => $_POST['description'],
					':id_realisateur' => $_POST['realisateur'],
					':categorie' => $_POST['categorie']
				)
			);

			$file_name = $BD->lastInsertId();

			move_uploaded_file($_FILES["image_film"]["tmp_name"], "images/poster_film/".$file_name);
		}

	}

	header('Location: /?page=add_films_and_realisators');
?>