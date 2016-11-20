<?php
class Review extends DomainObject{
    private $RatingID;
    private $PaintingID;
    private $ReviewDate;
    private $Rating;
    private $Comment;

    protected static function getFieldNames(){
        return array("RatingID", "PaintingID", "ReviewDate", "Rating", "Comment");
    }

    public function __construct($data){
        parent::__construct($data);
    }
}
?>
