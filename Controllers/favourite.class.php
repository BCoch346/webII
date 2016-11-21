<?php
include ("DataAccess/classfiles/domainObject.class.php");
include ("instance.class.php");

class favorite extends DomainObject {
	private $image;
	private $name;
	private $id;
	private $destination;
	public function __construct($id, $imagePath, $name, $destination) {
		$this->id = $id;
		$this->name = $name;
		$this->image = $imagePath;
		$this->destination = $destination;
	}
	public static function getFieldNames() {
		return array (
				"image, name, id, destination" 
		);
	}
	public function createFavoriteCard() {
		$output = "<div class='ui card'>
		<div class='image'>
		<img src='" . $this->image . "'>
		</div>
		<div class='content'>
		<a class='text' href='" . $this->destination . "'>" . $this->name . "</a>
		</div>
		<div class='extra content'>
		<button id='" . $this->id . "' class='ui right floated mini button'>
		<i class='trash icon'></i>remove
		</button>
		</div></div>";
		
		return $output;
	}
}
class FavoriteHelpers extends Instance{
	public function __construct(){
		parent::__construct();
		if(isset($_POST['addfava'])){
			$this->addArtist($_POST['newartistid']);
		}
		if(isset($_POST['addfavp'])){
			$this->addPainting($_POST['newpaintingid']);
		}
		if(isset($_POST['remallfav'])){
			$this->emptyFavorites();
		}
		if(isset($_POST['remfava'])){
			$this->emptyFavoriteArtists();
		}		
		if(isset($_POST['remfavp'])){
			$this->emptyFavoritePaintings();
		}
	}
	public function emptyFavorites() {
		emptyFavoriteArtists ();
		emptyFavoriteArtists ();
	}
	public function emptyFavoriteArtists() {
		unset ( $_SESSION ['favorite_artists'] );
		$_SESSION ['favorite_artists'] = array ();
	}
	public function emptyFavoritePaintings() {
		unset ( $_SESSION ['favorite_paintings'] );
		$_SESSION ['favorite_paintings'] = array ();
	}
	public static function removeFavoriteArtist($id) {
		removeFromFavorites ( $id, "favorite_artists" );
	}
	public static function removeFavoritePainting($id) {
		removeFromFavorites ( $id, "favorite_paintings" );
	}
	private function removeFromFavorites($id, $sessionArray) {
		if (null != ($_SESSION ( [ 
				$sessionArray 
		] ))) {
			for($i = 0; $i < count ( $_SESSION [$sessionArray] ); $i ++) {
				if ($_SESSION [$sessionArray] [$i]->id == $id) {
					unset ( $_SESSION [$sessionArray] [$i] );
				}
			}
		}
	}
	

	public function exists($id, $list = array()) {
		for($i = 0; $i < $list . length; $i ++) {
			if ($list [i]->id == $id) {
				return true;
			}
		}
		return false;
	}
	
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