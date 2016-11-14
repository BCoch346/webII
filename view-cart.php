<!--View Cart PHP-->
<?php session_start();?>
<?php include("includes/functions.inc.php"); ?>            


<?php 
include("cart-logic.class.php");
$cart = new cartLogic;
$cart -> instantiateCartLogic();
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
                <div class="ten wide column">
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
        
        $singlePainting = findPaintingByID($painting[$paintIndex]['id']);
        $singleFrame = findSingleFromTableByID('TypesFrames', 'FrameID', $painting[$paintIndex]['frame']);
        $singleGlass = findSingleFromTableByID('TypesGlass', 'GlassID', $painting[$paintIndex]['glass']);
        $singleMatte = findSingleFromTableByID('TypesMatt', 'MattID', $painting[$paintIndex]['matt']);

        $subtotal = 0;
        $frameCost = 0;
        $glassCost = 0;
        $matteCost = 0;
        $quantity = $painting[$paintIndex]['quantity'];
        $basePrice = round($singlePainting['Cost']/*CHANGE TO MSRP*/, 2) * $quantity;   

        $frameCost = $painting[$paintIndex]['quantity'] * round($singleFrame['Price'], 2);
        $glassCost = $painting[$paintIndex]['quantity'] * round($singleGlass['Price'],2);           
        $matteCost = $painting[$paintIndex]['quantity'] * 10;
        $subTotal = $matteCost + $glassCost + $frameCost + $basePrice;            
        $totalSubTotal += $subTotal;
        
         
        $standard = 0;
        $express = 0;
        if($totalSubTotal <= 1500){
            $standard = $quantity * 25;}
                   
        if($totalSubTotal < 2500){
            $express = $quantity * 50;} 
        
?>
 <div class="ui items">
     
   

     <?php   
/**********PAINTING INFO AND CHANGES SECTION****************************************************/        
     
        
        
        echo '<div class="header"><h3>';
            echo $singlePainting['Title']; 
        
        
    echo '</h3></div>';
    
       echo '<div class="item">'; 
            echo '<div class="ui small image">';
                echo createAnchorTag('single-painting.php?paintingid='. $singlePainting['PaintingID'], '<img src=images/art/works/square-medium/'. $singlePainting['ImageFileName'] . '.jpg>');
            echo '</div>';
                echo '<div class="middle aligned content">';
                    
       echo '<form class="ui form" method="POST" action="view-cart.php">'; 
                    
                    
      echo '<div class="ui secondary vertical menu">';   
                                   
      echo '<h3  data-tooltip="Click the checkbox to accept changes" >Change Options</h3>';        
        echo '<table class="ui compact celled definition blue table"><tr><td>Quantity </td><td><input type="number" min="1" name="'.$singlePainting['PaintingID'] . 'Quantity" value="TEST"></td></tr>';
       echo '<tr><td>Frame</td><td>'; 
      echo createFrameDropdownSelectList() .  '</td><td><input class="ui fitted checkbox" type="checkbox" name="'. $singlePainting['PaintingID'] .'changeFrame" value="yes"></td></tr><tr>';
      echo '<tr><td>Glass</td><td>';              
      echo createGlassDropdownSelectList() . '</td><td><input class="ui toggle checkbox" type="checkbox" name="'. $singlePainting['PaintingID'] .'changeGlass" value="yes"></td></tr>';
      echo '<tr><td>Matt</td><td>';              
      echo createMattDropdownSelectList() .  '</td><td><input class="ui toggle checkbox" type="checkbox" name="'. $singlePainting['PaintingID'] .'changeMatt" value="yes"></td></tr>';   
       echo '</table></div></div>'; 
       
                    
                    
/********PRICING TABLE************************************************************************************************************/                    
                    
        echo '<div>';             
        echo '<h3> Pricing </h3>';
        echo '<table class="ui orange table">';                 
        echo '<tr><td data-tooltip="Base Price = MSRP x Quantity"><b>Base Price: </b></td><td>$'. $basePrice . '</td></tr>';
        echo '<tr><td><b>Frame Cost: </b></td><td>$'. $frameCost . '</td></tr>';        
        echo '<tr><td><b>Glass Cost: </b></td><td>$'. $glassCost  .'</td></tr>'; 
        echo '<tr><td><b>Matte Cost: </b></td><td>$'. $matteCost . '</td></tr>';          
        echo '<tr><td><b>Subtotal: </b></td><td>$'. $subTotal . '</td></tr>';
        echo '</table>';
        echo '</div></div><div>';
    
        echo '<input class="ui right floated button" type="submit" name="'. $singlePainting['PaintingID']. 'remove" value="Remove">';
                    
        echo '<input class="ui right floated button" type="submit" value="Update Item">';       
                                   
        echo'</a>';                   
                    
        echo '</div>';          
        echo   '</form>';
        
        
        
        echo '<br><br><div class="ui divider"></div>';
        
        } }
        else{
            
            echo '<h1>YOUR CART <br>IS EMPTY,<br>LETS GO <br>FILL IT UP <br><br><a href=browse-paintings.php><input class="ui massive left floated button" type="submit" value="Go Shopping"></a></h1>';
        }            
                    
                    
                    ?>
          
        
          
            
            <?php 
            if(!empty($_SESSION['Painting'])){

                      
                echo '<table class="ui striped yellow table">';
                echo '<tr><td><b>Standard Shipping:</b></td><td> $' . $standard . '</td></tr>';
                echo '<tr><td><b>Express Shipping:</b></td><td> $' . $express . '</td></tr>';     
                echo '<tr><td><b>Total Cost with Standard Shipping:</b></td><td>$'. ($totalSubTotal + $standard) . '</td></tr>';
                echo '<tr><td><b>Total Cost with Express Shipping:</b></td><td>$'. ($totalSubTotal + $express) . '</td></tr>';
                echo '</table>';
                echo '</div><br>';}
     ?>
            
            
                    
     <?php               
          if(!empty($_SESSION['Painting'])){  
                echo '<form class="ui form" method="POST" action="view-cart.php">';          
                echo '<input class="ui right floated button" type="submit" name="cartOptions" value="Update">';
                echo '<input class="ui right floated button" type="submit" name="cartOptions" value="Empty Cart">';
                echo '</form><a href=index.php><input class="ui right floated button" type="submit" name="cartOptions" value="Continue Shopping"></a>';
                echo '<input class="ui right floated button" type="submit" name="cartOptions" value="Order">';
                echo '<br><br>';
          }  
            ?> 
            
    </main>
    <footer>
        <br />
        <?php include('includes/footer.inc.php'); ?>
    </footer>
</body>
</html>