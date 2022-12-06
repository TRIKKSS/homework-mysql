<?php

	if(!isset($_SESSION['logged']) || !$_SESSION['logged'] == True){
		echo "<center>you're not logged :(</center>";
		die();
	}

	if(!isset($_SESSION['admin']) || !$_SESSION['admin'] == True) {
		echo "you must be administrator to uploads new films.";
		die();
	}
	/* insert table film :

	INSERT INTO film(nom_film, annee_film, description, id_realisateur, id_categorie)
	VALUES("cars 3", 2017, "Cars 3 is a 2017 American computer-animated sports comedy-adventure film produced by Pixar Animation Studios and released by Walt Disney Pictures.", id, (select id_categorie from categorie where nom_categorie=:nom_categorie) );
	
	
	-- GET THE NEXT AUTO INCREMENT VALUE --
	-- SAVE IMAGE AS NEXT AUTO_INCREMENT VALUE -- 
	SELECT `auto_increment` FROM INFORMATION_SCHEMA.TABLES
	WHERE table_name = 'tablename'

	https://stackoverflow.com/questions/6761403/how-to-get-the-next-auto-increment-id-in-mysql

	$BD->lastInsertId();


	créer 2 pages php :
		- une page qui traite les données pour l'upload d'un film
		- une page qui traite les données pour l'uplaoad d'un realisateur
	*/
?>

<div class="w3-half">
	<div class="w3-container w3-round-xlarge w3-margin w3-blue w3-card-4">
			<center><h3> new film </h3></center>
	</div>

	<center>
	<form action="/upload_films.php" method="post" enctype="multipart/form-data">
		<input class="w3-input w3-border w3-margin" style="width: 90%;" type="text" name="nom_film" placeholder="film name">
		<input class="w3-input w3-border w3-margin" style="width: 90%;" type="text" name="annee_film" placeholder="film year">
		<textarea class="w3-border" placeholder="description" name="description"></textarea>
		<select class="w3-select w3-border w3-margin-top" style="width: 90%;" name="realisateur">
		<!--<select class="w3-input w3-margin-right" name="categorie" style="width: 30%;display: inline-block;">-->
			<option name="">all categories</option>
		<?php
			$sql_request = "SELECT * FROM realisateur";
			$query = $BD->query($sql_request);
			// echo "<h3> categorie disponible : <h3>";
			while ($resultat = $query->fetch()) {
				echo "<option value=\"".$resultat["id_realisateur"]."\">".htmlentities($resultat["nom_realisateur"])." ".htmlentities($resultat["prenom_realisateur"])."</option>";
			}
		?>
		</select>
		<select class="w3-select w3-border w3-margin" name="categorie" style="width: 90%">
			<option name="">all categories</option>
		<?php
			$sql_request = "SELECT * FROM categorie";
			$query = $BD->query($sql_request);
			// echo "<h3> categorie disponible : <h3>";
			while ($resultat = $query->fetch()) {
				echo "<option name=\"".$resultat["nom_categorie"]."\">".$resultat["nom_categorie"]."</option>";
			}

		?>
		</select>
		</center>
		<label class="w3-btn w3-gray w3-round" style="margin-left: 5%;" for="upload_input">upload a film poster</label>
		<input type="file" class="w3-margin" id="upload_input" name="image_film"> 
		<center>
		<input type="submit" class="w3-input w3-blue w3-round-large w3-card-4 w3-margin" style="width: 40%;border-color: #2196F3;" value="upload this film">
	</form>
	</center>
</div>

<div class="w3-half">
	<div class="w3-container w3-round-xlarge w3-margin w3-blue w3-card-4">
			<center><h3> new realisator </h3></center>
	</div>

	<center>
	<form action="/upload_realisators.php" method="post">
		<input class="w3-input w3-border w3-margin" style="width: 90%;" type="text" name="prenom" placeholder="surname">
		<input class="w3-input w3-border w3-margin" style="width: 90%;" type="text" name="nom" placeholder="name">
		<input class="w3-input w3-border w3-margin" style="width: 90%;" type="text" name="nationalite" placeholder="nationality">
		<input class="w3-input w3-border w3-margin" style="width: 90%;" type="int" name="annee_birth" placeholder="birth year">
		<input type="submit" class="w3-input w3-blue w3-round-large w3-card-4" style="width: 40%;border-color: #2196F3;" value="add new realisator">

	</form>
	</center>
</div>