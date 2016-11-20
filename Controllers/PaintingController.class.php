<?php
include('DataAccess/classfiles/painting.class.php');
include("instance.class.php");
class PaintingsController extends Instance{
	private $gateway;
	private $paintings;
	public function __construct(){
		parent::__construct();
		$this->gateway = new PaintingsTableGateway($this->dbAdapter);
		$this->setBrowsePaintingData();
	}

	public function setBrowsePaintingData(){
		$statement = $this->getPaintingByFilter();
		foreach($statement as $data){
			$painting = new Painting($data);
			$this->paintings[] = $painting;
		}
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
	
	private function createBrowsePaintingItem($painting){
		$image = $this->createImage($painting->squareMediumImageFilePath(), $painting->Title, $painting->title, "ui rounded image", "");
		//$image = createWorksSquareMediumImage("ui rounded image", $painting);
		//$artist = $this->gateway->findByField(array("ArtistID" => $painting->ArtistID));
	
		$item = "<div class='item'>";
		$item .= "<div class='ui image'>";
		$item .= createAnchorTag($painting->getLink(), $image);
		$item .= "</div><div class='middle aligned content'>";
		$item .= "<h3 class='ui header'>" . $painting->Title . "<em class='sub header'>". $painting->FirstName. " " . $painting->LastName."</em></h3>";
		$item .= "<br />" . $painting->Excerpt . "<br />";
		$item .= "<div class='ui divider'></div><strong>" . "$ ". number_format($painting->Cost , 2). "</strong><br />";
		$item .= '<button type="submit" name="addtocart" class="ui orange button" value='. $this->createButtonValue().'><i class="cart icon"></i></button>';
		$item .= '<button type="submit" name="addFavP" class="ui button" value='. $painting->PaintingID.'><i class="favorite icon"></i></button>';
		$item .="</div></div>";
	
		return $item;
	}
	
	
	public function createCurrentFilterString(){
		$string = "All Paintings [Top 20]";
	
		if(isValid("artistid")){
			$data = $this->gateway->findByField(array("ArtistID"=>$_GET["artistid"]));
			$artist = new Artist($data);
			$string = "Artist = " . $artist->getFullName();
		}
		else if(isValid("galleryid")){
			$sql = $this->gateway->getGenre($_GET["galleryid"]);
			$data = $this->dbAdapter->fetchRow($sql);
			$gallery = new Gallery($data);
			$string = "Museum = " . $gallery->GalleryName;
		}
		else if(isValid("shapeid")){
			$sql = $this->gateway->getShape($_GET["shapeid"]);
			$data = $this->dbAdapter->fetchRow($sql);
			$shape = new Shape($data);
			$string = "Shape = " . $shape->ShapeName;
		}
	
		return utf8_encode($string);
	}
	
	public function createSinglePaintingRating(){
		$paintingID = $this->DEFAULT_PAINTING_ID;
		$stars='';
		if(isValid('paintingid')){
			$paintingID = $_GET['paintingid'];
		}
		$aveRating = findAverageRating($paintingID);
		if($aveRating==null){
			$stars .= "Not Rated";
		}
		else{
			foreach($aveRating as $rating){
				$rating = ceil($rating);
				for($i = 0; $i < $rating; $i++){
					$stars .= '<i class="orange star icon"></i>';
				}
				if($rating<5){
					$greyNo = 5-$rating;
					for($i = 0; $i < $greyNo; $i++){
						$stars .= '<i class="empty star icon"></i>';
					}
				}
				break;
			}
		}
		return utf8_encode($stars);
	}
	
	public function createWorksMediumImage(){
		
	}
	private function createButtonValue(){
		$value = $this->DEFAULT_PAINTING_ID;
		if(isValid("paintingid")){
			$value = $_GET["paintingid"];
		}
		$output= '"'.$value.'"';
		return $value;
	}
}


?>