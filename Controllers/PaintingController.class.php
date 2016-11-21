<?php
include_once('DataAccess/classfiles/painting.class.php');
include_once('DataAccess/classfiles/artist.class.php');
include_once('DataAccess/classfiles/gallery.class.php');
include_once('DataAccess/classfiles/subject.class.php');
include_once('DataAccess/classfiles/genre.class.php');
include_once('DataAccess/classfiles/review.class.php');

include_once("instance.class.php");
class PaintingsController extends Instance{
	public $gateway;
	private $paintings;
	public function __construct(){
		parent::__construct();
		$this->gateway = new PaintingsTableGateway($this->dbAdapter);
	}

	public function setBrowsePaintingData(){
		$statement = $this->getPaintingByFilter();
		foreach($statement as $data){
			$painting = new Painting($data);
			$this->paintings[] = $painting;
		}
	}

	public function getPaintings(){
		if($this->paintings == null){
			$id = $this->DEFAULT_PAINTING_ID;
			if($this->isValid("paintingid")){
				$id = $_GET["paintingid"];
			}
			$data = $this->gateway->findById($id);
			if($data == null){
				$data = $this->gateway->findById($this->DEFAULT_PAINTING_ID);
			}
				
			$this->paintings = new Painting($data);
		}
	
		return $this->paintings;
	}
	private function getPaintingByFilter(){
		$limit = $this->BROWSE_PAINTING_LIMIT;
		$basesql = $this->gateway->getSelectStatement();
		$paintings = $this->dbAdapter->fetchAsArray($basesql." ORDER BY YearOfWork LIMIT ".$this->BROWSE_PAINTING_LIMIT);
		if($this->isValid("artistid")){
			$sql = $basesql .' WHERE ArtistID = '.$_GET['artistid'] .' ORDER BY YearOfWork LIMIT '.$this->BROWSE_PAINTING_LIMIT;
			$paintings = $this->dbAdapter->fetchAsArray($sql);
		}
		else if($this->isValid("galleryid")){
			$sql = $basesql .' WHERE GalleryID = '.$_GET['galleryid'] .' LIMIT '.$this->BROWSE_PAINTING_LIMIT;
				$paintings = $this->dbAdapter->fetchAsArray($sql);
				
		}
		else if($this->isValid("shapeid")){
			$sql = $basesql .' WHERE ShapeID = '.$_GET['shapeid'] .' ORDER BY ShapeID LIMIT '.$this->BROWSE_PAINTING_LIMIT;
				$paintings = $this->dbAdapter->fetchAsArray($sql);
				
		}
		else if(isset($_GET['title'])){
			$searchValue = " '%".$_GET['title']."%'";
			$sql = $basesql .' WHERE Title LIKE '.$searchValue.' LIMIT '.$this->BROWSE_PAINTING_LIMIT;
			$paintings = $this->dbAdapter->fetchAsArray($sql);
		}
		
		return $paintings;
	}
	
	
	public function createBrowsePaintingItems(){
		$items = "<div class='ui divided items'>";
		if(is_array($this->paintings) && $this->paintings != null){
			foreach($this->paintings as $painting){
				if($painting != null){
					$items .= $this->createBrowsePaintingItem($painting);
				}
			}
		}

		$items .= "</div>";
	
		return utf8_encode($items);
	}
	public function setPaintingData($painting){
		$this->setArtist($painting);
		$this->setGallery($painting);
		$this->setGenres($painting);
		$this->setSubjects($painting);
		$this->setReviews($painting);
	}
	private function setReviews($painting){
		$sql = $this->gateway->getReviewSqlStatement($painting->PaintingID);
		$statement = $this->dbAdapter->fetchAsArray($sql);
		foreach($statement as $data){
			$painting->reviews[] = new Review($data);
				
		}
	}	
	
	private function setGenres($painting){
		$sql = $this->gateway->getGenreSqlStatement($painting->PaintingID);
		$genres = $this->dbAdapter->fetchAsArray($sql);
		foreach($genres as $data){
			$painting->genres[] = new Genre($data);
	
		}
	}
	private function setSubjects($painting){
		$sql = $this->gateway->getSubjectSqlStatement($painting->PaintingID);
		$subjects = $this->dbAdapter->fetchAsArray($sql);
		foreach($subjects as $data){
			$painting->subjects[] = new Subject($data);
		}		
	}
	private function setGallery($painting){
		$sql = $this->gateway->getGallerySqlStatement($painting->GalleryID);
		$data = $this->dbAdapter->fetchRow($sql);
		$painting->gallery = new Gallery($data);
	}
	private function setArtist($painting){
		$sql = $this->gateway->getArtistSqlStatement($painting->ArtistID);
		$data = $this->dbAdapter->fetchRow($sql);
		$painting->artist = new Artist($data);
	}
	private function createBrowsePaintingItem($painting){
		$image = $this->createImage($painting->squareMediumImageFilePath(), $painting->Title, $painting->title, "ui rounded image", "");
		$this->setArtist($painting);
	
		$item = "<div class='item'>";
		$item .= "<div class='ui image'>";
		$item .= "<a href='".$painting->getLink()."'>". $image."</a>";
		$item .= "</div><div class='middle aligned content'>";
		$item .= "<h3 class='ui header'>" . $painting->Title . "<em class='sub header'>". $painting->artist->FirstName. " " . $painting->artist->LastName."</em></h3>";
		$item .= "<br />" . $painting->Excerpt . "<br />";
		$item .= "<div class='ui divider'></div><strong>" . "$ ". number_format($painting->Cost , 2). "</strong><br />";
		$item .= '<button type="submit" name="addtocart" class="ui orange button" value='. $painting->PaintingID.'><i class="cart icon"></i></button>';
		$item .= '<form method="get" action="view-favorites.php">
				<button type="submit" name="addfavp" class="ui button" value='. $painting->PaintingID.'><i class="favorite icon"></i></button>
						</form>';
		$item .="</div></div>";
	
		return $item;
	}
	
	
	public function createCurrentFilterString(){
		$string = "All Paintings [Top 20]";
	
		if($this->isValid("artistid")){
			$data = $this->dbAdapter->fetchRow("SELECT FirstName, LastName FROM artists WHERE ArtistID = ".$_GET['artistid']);
			$string = "Artist = " . $data[0]." ".$data[1];
		}
		else if($this->isValid("galleryid")){
			$data = $this->dbAdapter->fetchRow("SELECT GalleryName FROM galleries WHERE GalleryID = ".$_GET['galleryid']);

			$string = "Museum = " . $data[0];
		}
		else if($this->isValid("shapeid")){
			$data = $this->dbAdapter->fetchRow("SELECT ShapeName FROM shapes WHERE ShapeID = ".$_GET['shapeid']);
			
			$string = "Shape = " . $data[0];
		}
		else if(isset($_GET['title'])){
			$string = "Search = " . $_GET['title'];
				
		}
	
		return utf8_encode($string);
	}


	
	
}


?>