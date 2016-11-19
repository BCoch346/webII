<?php

	function removeFavoriteArtist($id){
		removeFromFavorites($id, "favorite_artists");
	}
	
	function removeFavoritePainting($id){
		removeFromFavorites($id, "favorite_paintings");
	}
	
	function removeFromFavorites($id, $sessionArray){
		if(null != ($_SESSION([$sessionArray]))){
			$favorites = $_SESSION[$sessionArray];
			for($i = 0; $i < $favorites.length; $i++){
				if($favorites[$i].id == $id){
					unset($favorites[$i]);
					$_SESSION[$sessionArray] = array_values($favorites);
				}
			}
		}
	}
	
	function emptyFavorites(){
		emptyFavoriteArtists();
		emptyFavoriteArtists();
		print_r($_SESSION['favorite_paintings']);
	}
	function emptyFavoriteArtists(){
		unset($_SESSION['favorite_artists']);
		$_SESSION['favorite_artists'] = array();
	}
	function emptyFavoritePaintings(){
		unset($_SESSION['favorite_paintings']);
		$_SESSION['favorite_paintings'] = array();
	}
	
	function addFavoriteArtist($id){
		$success = false;
		$dbAdapter = getPDOConnection();
		$gateway = new ArtistTableGateway($dbAdapter);
		if(!exists($id, $_SESSION['favorite_artists'])){
			$artist = $connection->getRow($gateway->findById($id));			
			if($artist != null){
				$favoriteArtist = new favorite(
							$artist->ArtistId, 
							$artist->squareMediumImage(), 
							$artist->getFullName(false), 
							"single-artist.php?".$gateway->getPrimaryKeyName()."=".$artist->ArtistId
						);
				array_push($_SESSION['favorite_artists'], $favoriteArtist);
				$sucess = true;
			}
		}

		$dbAdapter->closeConnection();
		return $sucess;			
	}
	
	function addFavoritePainting($id){
		$success = false;
		$dbAdapter = getPDOConnection();
		$gateway = new PaintingsTableGateway($dbAdapter);
		if(!exists($id, $_SESSION['favorite_paintings'])){
			$artist = $connection->getRow($gateway->findById($id));
			if($artist != null){
				$favoriteArtist = new favorite(
							$artist->ArtistId, 
							$artist->squareMediumImage(), 
							$artist->getFullName(false),
							"single-painting.php?".$gateway->getPrimaryKeyName()."=".$artist->ArtistId
						);
				array_push($_SESSION['favorite_paintings'], $favoriteArtist);
				$sucess = true;
			}
		}
		
		$dbAdapter->closeConnection();
		return $sucess;
	}

	function exists($id, $list=array()){
		for($i = 0; $i<$list.length; $i++){
			if($list[i]->id == $id){
				return true;
			}
		}
		return false;
	}
?>