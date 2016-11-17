<?php
class Painting extends DomainObject{
    private $PaintingID;
    private $ArtistID;
    private $GalleryID;
    private $ImageFileName;
    private $Title;
    private $ShapeID;
    private $MuseumLink;
    private $AccessionNumber;
    private $CopyrightText;
    private $Description;
    private $Excerpt;
    private $YearOfWork;
    private $Width;
    private $Height;
    private $Medium;
    private $Cost;
    private $MSRP;
    private $GoogleLink;
    private $GoogleDescription;
    private $WikiLink;

    protected static function getFieldNames(){
        return array("PaintingID", "ArtistID", "GalleryID", "ImageFileName", "Title", "ShapeID", "MuseumLink", "AccessionNumber",
            "CopyrightText", "Description", "Excerpt", "YearOfWork", "Width", "Height", "Medium", "Cost", "MSRP", "GoogleLink", 
            "GoogleDescription", "WikiLink");
    }

    public function __construct(array $data){
        parent::__construct($data);
    }
}
?>
