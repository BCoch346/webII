<?php
include_once("Controllers/ArtistController.class.php");

$controller = new ArtistsController();
?>
<!DOCTYPE html>
<html lang=en>

<head>
<meta charset=utf-8 />
<link href='http://fonts.googleapis.com/css?family=Merriweather'
	rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Open+Sans'
	rel='stylesheet' type='text/css' />

<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="css/semantic.js"></script>
<script src="js/misc.js"></script>

<link href="css/semantic.css" rel="stylesheet" />
<link href="css/icon.css" rel="stylesheet" />
<link href="css/styles.css" rel="stylesheet" />



</head>

<body>

	<header>
        <?php include('includes/header.inc.php'); ?>
    </header>
	<div class="hero-container browse-genre-container">
		<div class="ui container">
			<h1 class="ui huge header inverted">Artists</h1>
		</div>
	</div>

	<main>
	<h2 class="ui horizontal divider">
		<i class="tag icon"></i>Browse Artists
	</h2>

	<div class="ui container six cards stackable">
            <?php 
            $controller->setAllArtists();
            echo $controller->createBrowseArtistCards(); ?>
        </div>

	</main>
	<footer>
		<br />
        <?php include('includes/footer.inc.php'); ?>
    </footer>
</body>
</html>