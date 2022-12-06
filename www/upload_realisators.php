<?php
	include("includes/conf.php");

	if (
		isset($_POST['prenom']) && !empty($_POST['prenom']) &&
		isset($_POST['nom']) && !empty($_POST['nom']) &&
		isset($_POST['nationalite']) && !empty($_POST['nationalite']) &&
		isset($_POST['annee_birth']) && !empty($_POST['annee_birth'])
	) {
		$query = $BD->prepare(<<<SQL
			INSERT INTO realisateur(nom_realisateur, prenom_realisateur, nationalite_realisateur, annee_naissance)
			VALUES(:nom, :prenom, :nationalite, :annee_birth);
		SQL);
		$query->execute(
			array(
				':nom' => $_POST['nom'],
				':prenom' => $_POST['prenom'],
				':nationalite' => $_POST['nationalite'],
				':annee_birth' => $_POST['annee_birth']
			)
		);
	}
	header('Location: /?page=add_films_and_realisators')
?>