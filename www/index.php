<?php
	session_start();

	include("includes/conf.php");

	if(isset($_GET["page"]) && !empty($_GET["page"]))
	{
	    if(in_array($_GET["page"],$pages)) {
	    	$include_page = "includes/".$_GET["page"].".php";
	    } else {
	    	http_response_code(404);
	    	include("includes/404.php");
	    	die();
	    }
	} else {
		$include_page = "includes/home.php";
	}

	/*
	one page : all films
	?type=actions/romantic etc.
	?year=
	select * from film where categorie=

	$publisher_id = $pdo->lastInsertId();

	*/
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>panel</title>
	<link rel="stylesheet" type="text/css" href="/style/style.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="js/functions.js"></script>
</head>
<body>
<div id="success" class="w3-green w3-round-xlarge w3-card-4">
	<p>YOUR SUCCESS MESSAGE</p>
</div>

<div id="error" class="w3-red w3-round-xlarge w3-card-4">
	<p>YOUR ERROR MESSAGE</p>
</div>


<div class="w3-container w3-round-xlarge w3-margin w3-blue w3-card-4">
	<center>
		<h1>MEDIATHEQUE LISTENBOURGEOISE</h1>
	</center>
</div>

<div class="w3-row w3-padding">
	<div class="w3-container w3-quarter" >
		<div class="w3-container w3-padding w3-round-xlarge w3-card-4">
			<center>

				<?php
				if (!isset($_SESSION['logged']) || !$_SESSION['logged']) {
				?>
					<a href="/?page=login"><div class="menu w3-blue w3-container w3-round-large w3-card-2" style="padding:10%; margin-top: 8%;margin-bottom: 8%;">login</div></a>
					<a href="/?page=register"><div class="menu w3-blue w3-container w3-round-large w3-card-2" style="padding:10%; margin-top: 8%;margin-bottom: 8%;">register</div></a>
				<?php
				} else {
				?>
					<a href="/?page=my_films"><div class="menu w3-blue w3-container w3-round-large w3-card-2" style="padding:10%; margin-top: 8%;margin-bottom: 8%;">my films</div></a>
					<a href="/?page=add_films_and_realisators"><div class="menu w3-blue w3-container w3-round-large w3-card-2" style="padding:10%; margin-top: 8%;margin-bottom: 8%;">add films and realisators</div></a>
					<a href="/?page=films"><div class="menu w3-blue w3-container w3-round-large w3-card-2" style="padding:10%; margin-top: 8%;margin-bottom: 8%;">films</div></a>


				<?php
				}
				?>

					<a href="/?page=home"><div class="menu w3-blue w3-container w3-round-large w3-card-2" style="padding:10%; margin-top: 8%;margin-bottom: 8%;">home</div></a>


				<?php
				if (isset($_SESSION['logged']) && $_SESSION['logged']) {
				?> 
					<a href="/logout.php"><div class="menu w3-blue w3-container w3-round-large w3-card-2" style="padding:10%; margin-top: 8%;margin-bottom: 8%;">logout</div></a>
				<?php
				}
				?>
			</center>
		</div>
	</div>
	<div class="w3-container w3-threequarter w3-round-xlarge w3-card-4" style="padding-top: 2%; padding-bottom: 7%;">
		<div class="w3-container w3-round-xlarge w3-margin w3-blue w3-card-4">
			<center><h2> <?php if (isset($_GET["page"])) echo strtoupper(str_replace("_", " ",$_GET['page'])); else echo "HOME"; ?> </h2></center>
		</div>
		<?php include($include_page); ?>

	</div>
</div>

</body>
</html>