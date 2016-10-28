<?php
class Era extends DomainObject{
    private $EraID;
    private $EraName;
    private $EraYears;

    protected static function getFieldNames(){
        return array("EraID", "EraName", "EraYears");
    }
    public function __construct(array $data){
        parent::__construct($data);
    }


}




?>