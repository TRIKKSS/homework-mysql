<?php
	if(!isset($_SESSION['logged']) || !$_SESSION['logged'] == True){
		echo "<center>you're not logged :(</center>";
		die();
	}
?>

<div class="w3-panel w3-padding">

	<form class="w3-panel" method="post" action="/?page=films">
		<div class="w3-container w3-threequarter">
		<input type="text" class="w3-input w3-border w3-border-blue w3-round w3-margin-bottom" name="search" placeholder="film name" >
		<select class="w3-select w3-border w3-margin-right" name="categorie" style="width: 30%;display: inline-block;">
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
  		<input type="checkbox" class="w3-check" id="available_films" name="available">
		<label for="available_films">only availables films</label>

		</div>
	    <div class="w3-container w3-quarter">
    		<input class="w3-btn w3-blue" style="width: 100%; height: 100%;" type="submit" value="search">
    	</div>
	</form>
	<?php
		if(isset($_POST['search'])) {
			
			if (isset($_POST['available'])) {

				$sql_request = <<<SQL
				SELECT film.id_film as id_film, nom_film, annee_film, description, id_realisateur, id_categorie FROM film LEFT JOIN emprunt ON film.id_film = emprunt.id_film
				WHERE emprunt.id_film IS NULL and nom_film LIKE :search
				SQL;
			
			} else {
			
				$sql_request = "SELECT * FROM film WHERE nom_film LIKE :search";
			
			}

			if (isset($_POST['categorie']) && $_POST['categorie'] != "all categories") {
				$sql_request .= ' and id_categorie=(select id_categorie from categorie where nom_categorie=:categorie);';
				$query = $BD->prepare($sql_request);
				$query->execute(array(
					':search' => '%'.$_POST['search'].'%',
					':categorie' => $_POST['categorie']
				));
				// echo $query->fetch()['id_film'];
			
			} else {
				$query = $BD->prepare($sql_request);
				$query->execute(array(':search' => '%'.$_POST['search'].'%'));
			}
			
			// decommenter la ligne en dessous pour afficher la requete sql de faite.
			// echo $sql_request;
		
		} else {
			$sql_request = "SELECT * FROM film";
			$query = $BD->query($sql_request);
		}
		while ($resultat = $query->fetch()) {
			echo <<<HTML
				<div class="w3-panel w3-padding w3-blue w3-round-xlarge w3-card-4">

			HTML;
			echo "<div class='w3-panel'>";
			
			echo "<div class='w3-container w3-threequarter'>";
			echo "<h3>".htmlentities($resultat["nom_film"])."</h3>";
			echo "</div>";
			
			echo "<div class='w3-container w3-quarter'>";

			echo "<div class='w3-quarter'><input type='button' class='w3-btn w3-white w3-margin-top w3-round-xlarge' id='".$resultat["id_film"]."' value='book the film' onclick='book_a_film(id)'></div>";
			echo "</div>";

			echo "</div>";
			echo "<div class=\"w3-container w3-quarter\" style=\"padding-bottom:4%;\"><img src=\"/images/poster_film/".$resultat["id_film"]."\"  height=\"145\" style='max-width:90%; max-height:100%'></div>";
			echo "<div class=\"w3-container w3-threequarter\"><p>".htmlentities($resultat["description"])."</p></div>";
			echo "</div>";

		}
	?>
</div>
