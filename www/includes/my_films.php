
<div class="w3-panel w3-padding">
<?php
	include("includes/conf.php");

	$query = $BD->prepare("SELECT film.id_film, nom_film, description, emprunt.date_retour, emprunt.id_emprunt from mediatheque.film INNER JOIN mediatheque.emprunt ON film.id_film = emprunt.id_film WHERE id_users=:id;");

	$query->execute(array(
			':id' => $_SESSION['id_user']
		));
	while ($resultat = $query->fetch()) {
			echo <<<HTML
				<div class="w3-panel w3-padding w3-blue w3-round-xlarge w3-card-4">

			HTML;
			echo "<div class='w3-panel'>";
			
			echo "<div class='w3-container w3-half'>";
			echo "<h3>".htmlentities($resultat["nom_film"])."</h3>";
			echo "</div>";

			echo "<div class='w3-quarter'><p>return date : ".$resultat['date_retour']. "</p></div>";
			echo "<div class='w3-quarter'><input type='button' class='w3-btn w3-white w3-margin-top w3-round-xlarge' id='".$resultat["id_emprunt"]."' value='return a film' onclick='return_a_film(id)'></div>";
			
			echo "<div class='w3-container w3-quarter'>";

			echo "</div>";

			echo "</div>";
			echo "<div class=\"w3-container w3-quarter\" style=\"padding-bottom:4%;\"><img src=\"/images/poster_film/".$resultat["id_film"]."\"  height=\"145\" style='max-width:90%; max-height:100%'></div>";
			echo "<div class=\"w3-container w3-threequarter\"><p>".htmlentities($resultat["description"])."</p></div>";
			echo "</div>";

	}
?>
</div>
