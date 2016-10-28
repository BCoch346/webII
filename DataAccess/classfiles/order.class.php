<?php
class Order extends DomainObject{
    private $OrderID;
    private $ShipperID;
    private $CustomerID;
    private $DateStarted;
    private $Quantity;

    protected static function getFieldNames(){
        return array("OrderID", "ShipperID", "CustomerID", "DateStarted", "Quantity");
    }

    public function __construct(array $data){
        parent::__construct($data);
    }

?>
