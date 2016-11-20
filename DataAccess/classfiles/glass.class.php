<?php
class Glass extends DomainObject{
    private $GlassID;
    private $Title;
    private $Description;
    private $Price;

    protected static function getFieldNames(){
        return array("GlassID", "Title", "Description", "Price");
    }

    public function __construct($data){
        parent::__construct($data);
    }
}
    
?>
