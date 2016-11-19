<?php

include ("includes/functions.inc.php");
include ("controllers/favourite.class.php");
session_start ();
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

	<h2 class="ui horizontal divider">
		<i class="heart icon"></i> Favorites
	</h2>

	<main> <br />
	<div class="ui container">
		<div class="ui content"></div>

		<div class="ui top attached tabular menu">
			<a class="active item" id="paintings">Paintings</a> <a class="item"
				id="artists">Artist</a> <a class="right item"> <a
				class="ui compact negative button"> <i class="trash icon"></i>Empty
					Favorites
			</a> <a class="ui compact button"> <i class="trash icon"></i>Empty
					Paintings
			</a>
			</a>


		</div>
		
		<?php
		$p1 = new favorite ( 1, "images/art/artists/square-medium/1.jpg", "pablo picasso", "single-artist.php?artistid=1" );
		$p2 = new favorite ( 1, "images/art/artists/square-medium/1.jpg", "pablo picasso", "single-artist.php?artistid=1" );
		$p3 = new favorite ( 1, "images/art/artists/square-medium/1.jpg", "pablo picasso", "single-artist.php?artistid=1" );
		$p4 = new favorite ( 1, "images/art/artists/square-medium/1.jpg", "pablo picasso", "single-artist.php?artistid=1" );
		
		$_SESSION ['FavoritePaintings'] = array (
				$p1,
				$p2,
				$p3,
				$p4 
		);
		$_SESSION ['FavoriteArtists'] = array (
				$p1,
				$p2,
				$p3,
				$p4 
		);
		?>
		<div class="ui bottom attached segment">
			<div class="ui six column grid">
			<?php
			if (! empty ( $_SESSION ['FavoritePaintings'] )) {
				$paintings = $_SESSION ['FavoritePaintings'];
				
				for($i = 0; $i < count ( $paintings ); $i ++) {
					echo "<div class='ui column painting'>";
					echo $paintings [$i]->createFavoriteCard ();
					echo "</div>";
				}
			}
			if (! empty ( $_SESSION ['FavoriteArtists'] )) {
				$paintings = $_SESSION ['FavoriteArtists'];
				
				for($i = 0; $i < count ( $paintings ); $i ++) {
					echo "<div class='ui column artist'>";
					echo $paintings [$i]->createFavoriteCard ();
					echo "</div>";
				}
			}
			?>

			</div>
		</div>
	</div>

	<br />

	</main>
	<footer>
		<br />
        <?php include('includes/footer.inc.php'); ?>
    </footer>
</body>

</html>