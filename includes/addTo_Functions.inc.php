<?php 
include_once("functions.inc.php");
include_once("queries.inc.php");
session_start();

if(isset($_POST["addtocart"])){
    $id = $_POST["addtocart"];
    $painting = findPaintingByID($id);
    $quantity=1;
    if(isset($_POST['quantity'])){$quantity = $_POST['quantity'];}
    $frame='None';
    if(isset($_POST['frameid'])){$frame = $_POST['frameid'];}
    $glass='None';
    if(isset($_POST['glassid'])){$glass = $_POST['glassid'];}
    $matt='None';
    if(isset($_POST['mattid'])){$matt = $_POST['mattid'];}
    
    $order = array("id"=>$painting['PaintingID'], "quantity"=>$quantity, "frame"=>$frame, "glass"=>$glass, "matt"=>$matt);
    
    
    if(!empty($_SESSION['Painting'])){
         array_push($_SESSION['Painting'], $order); 
    }
    else{
        
        $_SESSION['Painting'] = array($order);
    }
   
    echo "<script>
        alert('Your order has been submitted');
        window.history.go(-1);
     </script>";
    //echo "<p>Painting ID: ".$order["paintingInfo"]["PaintingID"].", Quantity: ".$order["quantity"].", Frame: ".$order["frame"]."</p>";
}
?>