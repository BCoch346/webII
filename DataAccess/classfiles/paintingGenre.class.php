<?php
class PaintingGenre extends DomainObject{
    private $PaintingGenreID;
    private $PaintingID;
    private $GenreID;

    protected static function getFieldNames(){
        return array("PaintingGenreID", "PaintingID", "GenreID");
    }

    public function __construct(array $data){
        parent::__construct($data);
    }
}
?>
