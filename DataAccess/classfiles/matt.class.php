<?php
class Matt extends DomainObject{
    private $MattID;
    private $Title;
    private $ColorCode;

    protected static function getFieldNames(){
        return array("MattID", "Title", "ColorCode");
    }

    public function __construct(array $data){
        parent::__construct($data);
    }

?>
