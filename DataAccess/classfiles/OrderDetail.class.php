<?php
class OrderDetail extends DomainObject{
    private $OrderDetailID;
    private $OrderID;
    private $PaintingID;
    private $FrameID;
    private $GlassID;
    private $MattID;

    protected static function getFieldNames(){
        return array("OrderDetailID", "OrderID", "PaintingID", "FrameID", "GlassID", "MattID");
    }

    public function __construct($data){
        parent::__construct($data);
    }
}
?>
