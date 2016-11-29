<?php 
class servicePaintingItem{
	public $painting;
	
	public function __construct($painting){
		$this->painting = $painting;
	}
	
	public function toJSON(){
		
	}
	
	public function toItem(){
		$item  = '<div class="ui item">';
		$item .= '<div class="content"><a href="single-painting?paintingid='.$this->id.'">';
		$item .= '<div class="header">'.$painting->title.'</div>';
		$item .= '<div class="description">'.$artist->getFullName(false).'</div>';
		$item .= '</a></div></div>';
	}
}


class PaintingService extends Instance{
	private $gateway;
	public $paintings;
	
	public function __construct(){
		parent::__construct();
		$this->gateway = new PaintingsTableGateway($this->dbAdapter);
	}
	public function search($searchString){
	
	}
	
	public function filter($filter){
		
	}
	private function setPainting($painting){
		$painting->creator = $this->setArtist($painting);
		$this->paintings[] = new servicePaintingItem($painting);
	}
	private function setArtist($painting){
		$sql = $this->gateway->getArtistSqlStatement($painting->ArtistID);
		$data = $this->dbAdapter->fetchRow($sql);
		$painting->creator = new Artist($data);
	}
	public function getPaintings(){
		$output = "";
		foreach($paintings as $painting){
			$output .= $painting->toItem();
		}
		return $output;
	}
}
?>