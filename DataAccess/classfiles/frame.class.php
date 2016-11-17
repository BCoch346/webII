<?php
class Frame extends DomainObject{
    private $FrameID;
    private $Title;
    private $Price;
    private $Color;
    private $Syle;

    protected static function getFieldNames(){
        return array("FrameID", "Title", "Price", "Color", "Syle");
    }

    public function __construct(array $data){
        parent::__construct($data);
    }
}
?>
