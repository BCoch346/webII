<?php
class Genre extends DomainObject{
    private $GenreID;
    private $GenreName;
    private $EraID;
    private $Description;
    private $Link;

    protected static function getFieldNames(){
        return array("GenreID", "GenreName", "EraID", "Description", "Link");
    }

    public function __construct(array $data){
        parent::__construct($data);
    }

?>