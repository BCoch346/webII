<!--View Cart PHP-->
<?php session_start();
include('cart-logic.class.php');
include('cart-setup.class.php');
include_once("Controllers/PaintingController.class.php");
include_once("Controllers/DropdownController.class.php");
include_once('DataAccess/classfiles/Frame.class.php');
include_once('DataAccess/classfiles/Glass.class.php');
include_once('DataAccess/classfiles/Matt.class.php');
	$dropdown = new DropdownController();
	$controller = new PaintingsController;
	$cart = new cartLogic;
    $setup = new cartSetup;
    $cart->addToCart();
	$cart -> instantiateCartLogic();
    //$cart->addToCart();

?>

<!DOCTYPE html>
<html lang=en>

<head>
    <meta charset=utf-8 />
    <link href='http://fonts.googleapis.com/css?family=Merriweather' rel='stylesheet' type='text/css' />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="css/semantic.js"></script>
    <script src="js/misc.js"></script>

    <link href="css/semantic.css" rel="stylesheet" />
    <link href="css/icon.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />

</head>

<body>

    <header>
        <?php include('includes/header.inc.php'); ?>
    </header>

    <main>
        <h2 class="ui horizontal divider">
            <i class="tag icon"></i>Shopping Cart
        </h2>
        <div class="ui left dividing rail">
            <div class="ui segment">
                Left Rail Content
            </div>
        </div>
        <br />

        <div class="ui fluid stackable grid">
            <div class="one wide column"></div>
                <div class="eleven wide column">
                    <div class="row">
                        <h2 class="ui header">
                            Paintings
                            <div class="sub header">
                            </div>
                        </h2>
                    </div>
                    <div class="ui divider"></div>
                    
                        <?php

if(!empty($_SESSION['Painting'])){
    $painting = $_SESSION['Painting'];
    $totalSubTotal = 0;
	
    for($paintIndex = 0; $paintIndex < count($painting); $paintIndex++ ) { 
				
        $singlePainting = $painting[$paintIndex];
			
			$cartPainting = $controller->gateway->findById($singlePainting['id']);
        $singleFrame = $cart -> getFrameByID($singlePainting['frame']);
        $singleGlass = $cart -> getGlassByID($singlePainting['glass']);
			
        $singleMatte = $cart -> getMattByID($singlePainting['matt']);
			
        $standard = 0;
        $express = 0;
        $subtotal = 0;
        $frameCost = 0;
        $glassCost = 0;
        $matteCost = 0;
        $quantity = $painting[$paintIndex]['quantity'];
        $basePrice = round($cartPainting['MSRP'], 2) * $quantity;   
        $frameCost = $singlePainting['quantity'] * round($singleFrame['Price'], 2);
        $glassCost = $singlePainting['quantity'] * round($singleGlass['Price'],2);
        if($singleMatte['Title'] == 'None'){
            $matteCost = 0;
        }
        else{
        $matteCost = $singlePainting['quantity'] * 10;}
        $subTotal = $matteCost + $glassCost + $frameCost + $basePrice; 
        
        
        if(isset($_POST['cartOptions'])&& $_POST['cartOptions'] == 'Update' ){
            $totalSubTotal += $subTotal;
            $_SESSION['valueHolder']['totalSubtotal'] = $totalSubTotal;
        }
			
        elseif($_SESSION['stopVariable'] != count($painting)) {
            $_SESSION['stopVariable']++;
            $_SESSION['valueHolder']['totalSubtotal'] = $totalSubTotal;
        }
        elseif($_SESSION['valueHolder']['totalSubtotal'] != ''){
            $totalSubTotal = $_SESSION['valueHolder']['totalSubtotal'];
            $_SESSION['valueHolder']['totalSubtotal'] = $totalSubTotal;
        }
        
        
        
        $standard = 0;
        $express = 0;
        if($totalSubTotal <= 1500){
            $standard = $quantity * 25;}
                   
        if($totalSubTotal < 2500){
            $express = $quantity * 50;
        } 
        
            $_SESSION['totalValues']['standard'] = $standard;
            $_SESSION['totalValues']['express'] = $express;
            $_SESSION['totalValues']['totalSubTotal'] = $totalSubTotal;
			
?>
 <div class="ui items">
     
   

        
<!--/**********PAINTING INFO AND CHANGES SECTION****************************************************/    -->    
     
        
        
        <div class="header"><h3>
     <?php
            echo $cartPainting['Title']; 
        
        ?>
    </h3>
            </div>
    
       <div class="item">
            <div class="ui small image">
        <?php
                echo '<a href="single-painting.php?paintingid='. $singlePainting['id'].'"><img src="images/art/works/square-medium/'. $cartPainting['ImageFileName'] . '.jpg"></a>';
        ?>
            </div>
                <div class="middle aligned content">
     
                    
       <form class="ui form" method="POST" action="view-cart.php"> 
                    
                    
      <div class="ui secondary vertical menu">  
          <?php
         echo $setup -> itemDropDown($quantity, $singlePainting['id'], $singleFrame['Title'], $singleGlass['Title'], $singleMatte['Title'], $dropdown->framesDropdown(), $dropdown->glassDropdown(), $dropdown->mattDropdown());                    
       
                    
                    
/********PRICING TABLE************************************************************************************************************/                    echo $setup -> subtotalPricingTable($basePrice, $frameCost, $glassCost, $matteCost, $subTotal,$singlePainting['id'] );

        
        }
}
        else{
            
            echo '<h1>YOUR CART <br>IS EMPTY,<br>LETS GO <br>FILL IT UP <br><br><a href=browse-paintings.php><input class="ui massive left floated button" type="submit" value="Go Shopping"></a></h1>';         
        }                              
              
     
            if(!empty($_SESSION['Painting']) && isset($_POST['cartOptions']) && $_POST['cartOptions'] == 'Update'){   
               echo $setup -> totalPricingTable($_SESSION['totalValues']['standard'], $_SESSION['totalValues']['express'], $_SESSION['totalValues']['totalSubTotal']);

            
         $_SESSION['valueHolder']['standard'] = $standard;
         $_SESSION['valueHolder']['express'] = $express;
         $_SESSION['valueHolder']['totalSubtotal'] = $totalSubTotal ;

            
            }
    
        elseif(!empty($_SESSION['Painting']) && $_SESSION['valueHolder']['standard'] == '')
            {   
                echo $setup -> totalPricingTable($_SESSION['valueHolder']['standard'], $_SESSION['valueHolder']['express'], $_SESSION['valueHolder']['totalSubtotal']);

               $_SESSION['valueHolder']['standard'] == '';
     
     
     }
     
             elseif(!empty($_SESSION['Painting']))
            {   
             echo $setup -> totalPricingTable($standard, $express, $totalSubTotal);

     
    }
      

          if(!empty($_SESSION['Painting'])){
            echo $setup -> bottomButtons();

          } 
            ?> 
            
    </main>
    <footer>
        <br />
        <?php include('includes/footer.inc.php'); ?>
    </footer>
</body>
</html>