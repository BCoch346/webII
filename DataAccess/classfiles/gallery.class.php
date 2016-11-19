<?php
include ('domainObject.class.php');
class Gallery extends DomainObject {
	public $GalleryID;
	public $GalleryName;
	public $GalleryNativeName;
	public $GalleryCity;
	public $GalleryCountry;
	public $Latitude;
	public $Longitude;
	public $GalleryWebSite;
	protected static function getFieldNames() {
		return array (
				"GalleryID",
				"GalleryName",
				"GalleryNativeName",
				"GalleryCity",
				"GalleryCountry",
				"Latitude",
				"Longitude",
				"GalleryWebSite" 
		);
	}
	public function __construct(array $data) {
		parent::__construct ( $data );
	}
	public function getGallerySegment() {
		$output = '<a href="single-gallery?galleryid=' . $this->GalleryID . '">' . 
		'<div class="ui segment gallery">' . '
				<h3 class="ui header">' . $this->GalleryName . '</h3>' . 
		'<div class="ui divider"></div>' . 
		'<p>' . $this->GalleryCity . ', ' . $this->GalleryCountry . '</p></div></a>';
		return $output;
	}
}

?>