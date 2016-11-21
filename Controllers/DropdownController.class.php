<?php
include_once('DataAccess/classfiles/frame.class.php');
include_once('DataAccess/classfiles/glass.class.php');
include_once('DataAccess/classfiles/matt.class.php');
include_once('DataAccess/classfiles/gallery.class.php');
include_once('DataAccess/classfiles/artist.class.php');
include_once('DataAccess/classfiles/shapes.class.php');

include_once("instance.class.php");

class DropdownController extends Instance{
	public $frames;
	public $glass;
	public $matts;
	public $artists;
	public $museums;
	public $shapes;
	
	public function __construct(){
		parent::__construct();
		//$this->frames = $this->setFrames();
		//$this->glass = $this->setGlass();
		//$this->matts = $this->setMatt();
		//$this->artists = $this->getArtists();
		//$this->museums = $this->getMuseums();
		//$this->shapes = $this->getShapes();
	}
	
	public function createListItem($class, $content){
		return utf8_encode("<li class='".$class."'>".$content."</li>");
	}
	public function createSelectList(){
		$list = '<select name="FrameID" id="frame" class="ui search dropdown">';
			foreach($this->frames as $item){
				$list .= $item;
				//$list .= $this->createOption($item->FrameID, $item->Title);
			}

		$list .= '</select>';
		return $list;
	}
	public function createSelectListWithPlaceholder($id, $itemID, $class, $listItems, $searchString){
		$list = "<select name='".strtolower($itemID)."' id='".$id."' class='".$class."'>";
		$list .= "<option value=''>".$id."</option>";
	
		foreach($listItems as $item){
			$list .= $this->createOption($item->$itemID, $item->$searchString);
		}
		$list .= "</select>";
		return $list;
	}
	public function createArtistSelectList($id, $class, $listItems){
		$list = "<select name='artistid' id='".$id."' class='".$class."'>";
		$list .= "<option value=''>".$id."</option>";
		foreach($listItems as $item){

			//$list .= $this->createOptionWithName($item->ArtistID,$item->FirstName, $item->LastName);
		}
		$list .= "</select>";
		return $list;
	}
	public function createOptionWithName($id, $first, $last){
		$option =  "<option value='".$id."'>".$first. " " . $last. "</option>";
		return $option;
	}
	public function createOption($id, $text){
		$option =  "<option value='".$id."'>".$text."</option>";
		if(!strcmp($text, "[None]")){
			$option = "<option selected='true'>None</option>";
		}
		return $option;
	}
	

	//-------------
	//-DROPDOWN----
	//-------------
	public function framesDropdown(){
		$sql = "SELECT FrameID, Title FROM typesframes";
		
		$frames = $this->dbAdapter->fetchAsArray($sql);
		$list = '<select name="FrameID" id="frame" class="ui search dropdown">';
		foreach($frames as $data){
			$list .= $this->createOption($data[0],$data[1]);
		}
		$list .= '</select>';
		return $list;
	}
	public function glassDropdown(){
		$sql = "SELECT GlassID, Title FROM typesglass";
		
		$statement = $this->dbAdapter->fetchAsArray($sql);
		$list = '<select name="GlassID" id="glass" class="ui search dropdown">';
		foreach($statement as $data){
			$list .= $this->createOption($data[0],$data[1]);
		}
		$list .= '</select>';
		return $list;
	}	
	public function mattDropdown(){
		$sql = "SELECT MattID, Title FROM typesmatt";
	
		$statement = $this->dbAdapter->fetchAsArray($sql);
		$list = '<select name="MattID" id="matt" class="ui search dropdown">';
		foreach($statement as $data){
			$list .= $this->createOption($data[0],$data[1]);
		}
		$list .= '</select>';
		return $list;
	}

	public function getArtists(){
		$gateway = new ArtistTableGateway($this->dbAdapter);
		$statement = $gateway->findAll();
		foreach($statement as $data){
			$this->artists[] = new Artist($data);
		}
	}
	public function getMuseums(){
		$gateway = new GalleriesTableGateway($this->dbAdapter);
		$statement = $gateway->findAll();
		foreach($statement as $data){
			$this->museums[] = new Gallery($data);
		}
	}
	public function getShapes(){
		$gateway = new ShapesTableGateway($this->dbAdapter);
		$statement = $gateway->findAll();
		foreach($statement as $data){
			$this->shapes[] = new Shape($data);
		}
	}
	public function createFrameDropdownSelectList(){
		return utf8_encode($this->createSelectList("frame", "FrameID", "ui search dropdown", $this->frames, "Title"));
	}
	public function createGlassDropdownSelectList(){
		return utf8_encode($this->createSelectList("glass", "GlassID", "ui search dropdown", $this->glass, "Title"));
	}
	public function createMattDropdownSelectList(){
		return utf8_encode($this->createSelectList("matt", "MattID", "ui search dropdown", $this->matts, "Title"));
	}
	public function createArtistDropdownSelectList(){
		return utf8_encode($this->createArtistSelectList("Artist", "ui fluid search dropdown", $this->artists));
	}
	public function createMuseumDropdownSelectList(){
		return utf8_encode($this->createSelectListWithPlaceHolder("Museum", "GalleryID", "ui fluid search dropdown", $this->museums, "GalleryName"));
	}
	public function createShapeDropdownSelectList(){
		return utf8_encode($this->createSelectListWithPlaceHolder("Shape", "ShapeID", "ui fluid search dropdown", $this->shapes, "ShapeName"));
	}
	
}

?>