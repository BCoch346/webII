<?php
class Shipper extends DomainObject{
    private $shipperID;
    private $shipperName;
    private $shipperDescription;
    private $shipperAvgTime;
    private $shipperClass;
    private $shipperBaseFee;
    private $shipperWeightFee;

    protected static function getFieldNames(){
        return array("shipperID", "shipperName", "shipperDescription", "shipperAvgTime", "shipperClass", "shipperBaseFee", "shipperWeightFee");
    }

    public function __construct(array $data){
        parent::__construct($data);
    }
}
?>
