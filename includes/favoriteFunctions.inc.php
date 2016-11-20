<?php
include_once("Controllers/instance.class.php");
function emptyFavorites(){
	emptyFavoriteArtists();
	emptyFavoriteArtists();
}
function emptyFavoriteArtists(){
	unset($_SESSION['favorite_artists']);
	$_SESSION['favorite_artists'] = array();
}
function emptyFavoritePaintings(){
	unset($_SESSION['favorite_paintings']);
	$_SESSION['favorite_paintings'] = array();
}
class FavoriteFunctions{
	public static function removeFavoriteArtist($id){
		removeFromFavorites($id, "favorite_artists");
	}
	
	public static function removeFavoritePainting($id){
		removeFromFavorites($id, "favorite_paintings");
	}
	
	private function removeFromFavorites($id, $sessionArray){
		if(null != ($_SESSION([$sessionArray]))){
			for($i = 0; $i < count($_SESSION[$sessionArray]); $i++){
				if($_SESSION[$sessionArray][$i]->id == $id){
					unset($_SESSION[$sessionArray][$i]);
				}
			}
		}
	}
	
	public static function emptyFavorites(){
		emptyFavoriteArtists();
		emptyFavoriteArtists();
	}
	public static function emptyFavoriteArtists(){
		unset($_SESSION['favorite_artists']);
		$_SESSION['favorite_artists'] = array();
	}
	public static function emptyFavoritePaintings(){
		unset($_SESSION['favorite_paintings']);
		$_SESSION['favorite_paintings'] = array();
	}
	
	public static function addFavoriteArtist($id){
		$helper = new favoriteHelpers;
		$isSuccess = $helper->addArtist($id);
		
		return $isSuccess;
	}
	
	public static function addFavoritePainting($id){
		$helper = new favoriteHelpers;
		$isSuccess = $helper->addPainting($id);
		
		return $isSuccess;
	}

	
	public function exists($id, $list=array()){
		for($i = 0; $i<$list.length; $i++){
			if($list[i]->id == $id){
				return true;
			}
		}
		return false;
	}
}

class favoriteHelpers extends Instance{
	public function addPainting($id){
		$success = false;
		$this->gateway = new PaintingsTableGateway;
		if(!FavoriteFunctions::exists($id, $_SESSION['favorite_paintings'])){
			$artist = $this->gateway->findByID($id);
			if($artist != null){
				$favoriteArtist = new favorite(
						$artist->ArtistId,
						$artist->squareMediumImage(),
						$artist->getFullName(false),
						"single-painting.php?".$this->gateway->getPrimaryKeyName()."=".$artist->ArtistId
						);
				array_push($_SESSION['favorite_paintings'], $favoriteArtist);
				$sucess = true;
			}
		}
	
		$this->closeConnection();
		return $sucess;
	}
	public function addArtist($id){
		$success = false;
		$this->gateway = new ArtistTableGateway;
		if(!FavoriteFunctions::exists($id, $_SESSION['favorite_artists'])){
			$artist = $this->gateway->findByID($id);
				if($artist != null){
				$favoriteArtist = new favorite(
						$artist->ArtistId,
						$artist->squareMediumImage(),
						$artist->getFullName(false),
						"single-artist.php?".$this->gateway->getPrimaryKeyName()."=".$artist->ArtistId
						);
				array_push($_SESSION['favorite_artists'], $favoriteArtist);
				$sucess = true;
			}
		}
		
		$this->closeConnection();
		return $sucess;
	}
}
	
?>