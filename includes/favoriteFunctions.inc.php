<?php
class favoriteController{
	function removeFavoriteArtist($id){
		removeFromFavorites($id, "favorite_artists");
	}
	
	function removeFavoritePainting($id){
		removeFromFavorites($id, "favorite_paintings");
	}
	
	function removeFromFavorites($id, $sessionArray){
		if(isset($_SESSION([$sessionArray]))){
			$favorites = $_SESSION[$sessionArray];
			for($i = 0; $i < $favorites.length; $i++){
				if($favorites[$i].id == $id){
					unset($favorites[$i]);
					$_SESSION([$sessionArray]) = array_values($favorites);
				}
			}
		}
	}
	
	function emptyFavorites(){
	
	}
	function emptyFavoriteArtists(){
	
	}
	function emptyFavoritePaintings(){
	
	}
}

?>