<?php

class Gallery extends DomainObject{
    private $GalleryID;
    private $GalleryName;
    private $GalleryNativeName;
    private $GalleryCity;
    private $GalleryCountry;
    private $Latitude;
    private $Longitude;
    private $GalleryWebSite;


    protected static function getFieldNames(){
        return array("GalleryID", "GalleryName", "GalleryNativeName", "GalleryCity", "GalleryCountry", "Latitude", "Longitude", "GalleryWebSite");
    }
    public function __construct(array $data){
        parent::__construct($data);
    }
}


?>