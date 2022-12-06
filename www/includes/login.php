<?php
	if(isset($_SESSION['logged']) && $_SESSION['logged'] == True){
		echo "<script>document.location = '/?page=films'</script>";
		die();
	}
?>

<?php
	if(isset($_POST["email"]) && isset($_POST["password"])) {
		$query = $BD->prepare(
			<<<SQL
				SELECT * FROM users where email=:email and password=:password;
			SQL);
		$query->execute(array(':email' => $_POST['email'],
                              ':password' => hash('sha512', $_POST['password'])));
		// echo hash('sha512', $_POST['password']);


		$row = $query->rowCount();
		$fetch = $query->fetch();
		if($row > 0) {
				$_SESSION['logged'] = True;
				$_SESSION['id_user'] = $fetch['id_users'];
				$_SESSION['nom'] = $fetch['nom'];
				$_SESSION['prenom'] = $fetch['prenom'];
				$_SESSION['email'] = $fetch['email'];
				$_SESSION['addresse'] = $fetch['addresse'];
				$_SESSION['tel'] = $fetch['tel'];
				$_SESSION['admin'] = $fetch['admin'] ? True : False;
				$message = "Bienvenue ".htmlentities($_SESSION['nom']);
				if ($_SESSION['admin']) {
					$message .= " you're an administrator !";
				}
				echo "<script>document.location = '/?page=home'</script>";
				// header("location: /?page=film");
		} else {
			// todo : banière rouge qui dit un truc du style : "we can't log you, be sure you're registred before."
			echo "<script>log_error('wrong login.')</script>";
		}
	}


?>

		<div class="w3-panel w3-padding">
			<center>
				<form action="/?page=login" method="post" style="margin-top: 8%;">
					<input class="w3-input w3-border w3-border-blue w3-round" style="width: auto;border-color: #2196F3;" type="email" name="email" placeholder="email">
					<br>
					<input class="w3-input w3-border w3-border-blue w3-round" style="width: auto;border-color: #2196F3;" type="password" name="password" placeholder="password">
					<br>
					<input type="submit" class="w3-input w3-blue w3-round-large w3-card-4" style="width: 15%;border-color: #2196F3;" value="login">
				</form>
			</center>
		</div>