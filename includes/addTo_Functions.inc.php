<?php 
include_once("functions.inc.php");
include_once("queries.inc.php");
session_start();

if(isset($_POST["addtocart"])){
    $id = $_POST["addtocart"];
    $painting = findPaintingByID($id);
    $quantity='';
    if(isset($_POST['quantity'])){$quantity = $_POST['quantity'];}
    $frame='';
    if(isset($_POST['frameid'])){$frame = $_POST['frameid'];}
    $glass='';
    if(isset($_POST['glassid'])){$glass = $_POST['glassid'];}
    $matt='';
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
}

if(isset($_POST["addtofav"])){
    $id = $_POST["addtofav"];
    $painting = findPaintingByID($id);
    $quantity='';
    if(isset($_POST['quantity'])){$quantity = $_POST['quantity'];}
    $frame='';
    if(isset($_POST['frameid'])){$frame = $_POST['frameid'];}
    $glass='';
    if(isset($_POST['glassid'])){$glass = $_POST['glassid'];}
    $matt='';
    if(isset($_POST['mattid'])){$matt = $_POST['mattid'];}
    $order = array("id"=>$painting['PaintingID'], "quantity"=>$quantity, "frame"=>$frame, "glass"=>$glass, "matt"=>$matt);
   
        if(!empty($_SESSION['favourites'])){
         array_push($_SESSION['favourites'], $order); 
    }
    else{
        
        $_SESSION['favourites'] = array($order);
    }
    echo "<script>
             window.history.go(-1);
     </script>";
}
?>