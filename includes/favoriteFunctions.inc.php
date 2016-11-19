<?php
class favoriteController{
	public function removeFavoriteArtist($id){
		removeFromFavorites($id, "favorite_artists");
	}
	
	public function removeFavoritePainting($id){
		removeFromFavorites($id, "favorite_paintings");
	}
	
	public function removeFromFavorites($id, $sessionArray){
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
	
	public function emptyFavorites(){
		emptyFavoriteArtists();
		emptyFavoriteArtists();
	}
	public function emptyFavoriteArtists(){
	
	}
	public function emptyFavoritePaintings(){
	
	}
}

?>