<?php
include_once('domainObject.class.php');

class Painting extends DomainObject{
    public $PaintingID;
    public $ArtistID;
    public $GalleryID;
    public $ImageFileName;
    public $Title;
    public $ShapeID;
    public $MuseumLink;
    public $AccessionNumber;
    public $CopyrightText;
    public $Description;
    public $Excerpt;
    public $YearOfWork;
    public $Width;
    public $Height;
    public $Medium;
    public $Cost;
    public $MSRP;
    public $GoogleLink;
    public $GoogleDescription;
    public $WikiLink;

    protected static function getFieldNames(){
        return array("PaintingID", "ArtistID", "GalleryID", "ImageFileName", "Title", "ShapeID", "MuseumLink", "AccessionNumber",
            "CopyrightText", "Description", "Excerpt", "YearOfWork", "Width", "Height", "Medium", "Cost", "MSRP", "GoogleLink", 
            "GoogleDescription", "WikiLink");
    }

    public function __construct(array $data){
        parent::__construct($data);
    }
    public function createThumbnail(){
    	return '<a href="single-painting.php?paintingid='.$this->PaintingID.'"><img src="'.$this->squareMediumImageFilePath().'" alt="'.$this->Title.'" title="'.$this->title.'"></a>';
    }
    
    public function mediumImageFilePath(){
    	return "images/art/works/medium/".$this->ImageFileName.".jpg";
    }
    public function squareMediumImageFilePath(){
    	return "images/art/works/square-medium/".$this->ImageFileName.".jpg";
    }
    public function createWorksLargeImage(){
    	return "images/art/works/large/".$this->ImageFileName.".jpg";
    }
    public function getLink(){
    	return 'single-painting.php?paintingid='.$this->ArtistID;
    }
    
}
?>
