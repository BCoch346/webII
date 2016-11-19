<?php
include('DataAccess/gateways/gateways.class.php');
include('DataAccess/classfiles/gallery.class.php');
include("instance.class.php");
class GalleriesController extends Instance{
	private $gateway;
	private $galleries;
	public function __construct(){
		parent::__construct();
		$this->gateway = new GalleriesTableGateway($this->dbAdapter);
	}
	
	public function setBrowseGalleryData(){
		$statement = $this->dbAdapter->fetchAsArray($this->gateway->getSelectStatementForBrowseAll());
		foreach($statement as $data){
			$gallery = new Gallery($data);
			$this->galleries[] = $gallery;
		}
	}
	
	public function createBrowseGalleryColumnSegment(){

		$this->setBrowseGalleryData();
		$output = "";
		foreach ($this->galleries as $gallery){
			$output .= '<div class="ui column">';
			$output .= $gallery->getGallerySegment($gallery);
			$output .= '</div>';		
		}

		return utf8_encode($output);
	}
	
}


?>