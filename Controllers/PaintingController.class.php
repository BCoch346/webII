<?php
include_once('DataAccess/classfiles/painting.class.php');
include_once('DataAccess/classfiles/artist.class.php');
include_once('DataAccess/classfiles/gallery.class.php');
include_once('DataAccess/classfiles/subject.class.php');
include_once('DataAccess/classfiles/genre.class.php');
include_once('DataAccess/classfiles/review.class.php');

include_once("instance.class.php");
class PaintingsController extends Instance{
	private $gateway;
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
		$orderByLimit = ' ORDER BY ? LIMIT '.$limit;
		$joinsql = $basesql . 'JOIN Artists ON Paintings.ArtistID = Artists.ArtistID ';	
		$paintings = $this->dbAdapter->fetchAsArray($basesql." ORDER BY YearOfWork LIMIT ".$this->BROWSE_PAINTING_LIMIT);
		if($this->isValid("artistid")){
			$joinsql .= 'WHERE Artists.ArtistID = ? '.$orderByLimit;
			$paintings = $this->dbAdapter->fetchAsArray($joinsql, array($_GET["artistid"], "LastName"));
			//findAllPaintingsByArtistIDLimit($_GET["artistid"], BROWSE_PAINTING_LIMIT, $orderBy);
		}
		else if($this->isValid("galleryid")){
			$joinsql .= 'WHERE GalleryID = ? '.$orderByLimit;
			$paintings = $this->dbAdapter->fetchAsArray($joinsql, array($_GET["galleryid"], "GalleryName"));
				
			//$paintings = findAllPaintingsByGalleryIDLimit($_GET["galleryid"], BROWSE_PAINTING_LIMIT, $orderBy);
		}
		else if($this->isValid("shapeid")){
			$joinsql .= 'WHERE ShapeID = ? '.$orderByLimit;
			$paintings = $this->dbAdapter->fetchAsArray($joinsql, array($_GET["shapeid"], "ShapeName"));
				
			//$paintings = findAllPaintingsByShapeIDLimit($_GET["shapeid"], BROWSE_PAINTING_LIMIT, $orderBy);
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
		//$image = createWorksSquareMediumImage("ui rounded image", $painting);
		//$artist = $this->gateway->findByField(array("ArtistID" => $painting->ArtistID));
	
		$item = "<div class='item'>";
		$item .= "<div class='ui image'>";
		$item .= "<a href='".$painting->getLink()."'>". $image."</a>";
		$item .= "</div><div class='middle aligned content'>";
		$item .= "<h3 class='ui header'>" . $painting->Title . "<em class='sub header'>". $painting->FirstName. " " . $painting->LastName."</em></h3>";
		$item .= "<br />" . $painting->Excerpt . "<br />";
		$item .= "<div class='ui divider'></div><strong>" . "$ ". number_format($painting->Cost , 2). "</strong><br />";
		$item .= '<button type="submit" name="addtocart" class="ui orange button" value='. $painting->PaintingID.'><i class="cart icon"></i></button>';
		$item .= '<button type="submit" name="addFavP" class="ui button" value='. $painting->PaintingID.'><i class="favorite icon"></i></button>';
		$item .="</div></div>";
	
		return $item;
	}
	
	
	public function createCurrentFilterString(){
		$string = "All Paintings [Top 20]";
	
		if($this->isValid("artistid")){
			$data = $this->gateway->findByField(array("ArtistID"=>$_GET["artistid"]));
			$artist = new Artist($data);
			$string = "Artist = " . $artist->getFullName();
		}
		else if($this->isValid("galleryid")){
			$sql = $this->gateway->getGenre($_GET["galleryid"]);
			$data = $this->dbAdapter->fetchRow($sql);
			$gallery = new Gallery($data);
			$string = "Museum = " . $gallery->GalleryName;
		}
		else if($this->isValid("shapeid")){
			$sql = $this->gateway->getShape($_GET["shapeid"]);
			$data = $this->dbAdapter->fetchRow($sql);
			$shape = new Shape($data);
			$string = "Shape = " . $shape->ShapeName;
		}
	
		return utf8_encode($string);
	}


	
	
}


?>