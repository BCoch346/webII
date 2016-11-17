<?php
class Shape extends DomainObject{
    private $ShapeID;
    private $ShapeName;

    protected static function getFieldNames(){
        return array("ShapeID", "ShapeName");
    }

    public function __construct(array $data){
        parent::__construct($data);
    }
}
?>
