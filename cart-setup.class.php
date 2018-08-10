
<?php
/*****Cart-Setup.Class***/
class cartSetup{
    
    
    
    
    function itemDropDown($quantity, $id, $frameTitle, $glassTitle, $matteTitle, $frameDropDown, $glassDropDown, $mattDropDown){
        $output ='';
        $output .= '<h3  data-tooltip="Click the checkbox to accept changes" >Change Options</h3>';        
        $output .= '<table class="ui compact celled definition blue table"><tr><td>Quantity </td><td>'. $quantity .'</td><td><input type="number" min="1" name="'.$id . 'Quantity" value="TEST"></td></tr>';
       $output .=  '<tr><td>Frame</td><td>'. $frameTitle .'</td><td>'; 
      $output .=  $frameDropDown .  '</td><td><input class="ui fitted checkbox" type="checkbox" name="'. $id .'changeFrame" value="yes"></td></tr><tr>';
      $output .=  '<tr><td>Glass</td><td>'. $glassTitle.'</td><td>';              
      $output .=  $glassDropDown . '</td><td><input class="ui toggle checkbox" type="checkbox" name="'. $id .'changeGlass" value="yes"></td></tr>';
      $output .=  '<tr><td>Matt</td><td>'. $matteTitle.'</td><td>';              
      $output .=  $mattDropDown .  '</td><td><input class="ui toggle checkbox" type="checkbox" name="'. $id .'changeMatt" value="yes"></td></tr>';   
       $output .= '</table></div></div>';
        return $output;
        
        
        
        
    }

    function subtotalPricingTable($basePrice, $frameCost, $glassCost, $matteCost, $subTotal, $id){
        $output = '';
        $output .= '<div>';             
        $output .= '<h3> Pricing </h3>';
        $output .= '<table class="ui orange table">';                 
        $output .= '<tr><td data-tooltip="Base Price = MSRP x Quantity"><b>Base Price: </b></td><td>$'. $basePrice . '</td></tr>';
        $output .= '<tr><td><b>Frame Cost: </b></td><td>$'. $frameCost . '</td></tr>';        
        $output .= '<tr><td><b>Glass Cost: </b></td><td>$'. $glassCost  .'</td></tr>'; 
        $output .= '<tr><td><b>Matte Cost: </b></td><td>$'. $matteCost . '</td></tr>';          
        $output .= '<tr><td><b>Subtotal: </b></td><td>$'. $subTotal . '</td></tr>';
        $output .= '</table>';
        $output .= '</div></div><div>';
        $output .= '<button class="ui right floated button" type="submit" name="'. $id .'remove" value="yes">Remove</button>';     
        $output .= '<input class="ui right floated button" type="submit" value="Update Item"></form>';                                      
        $output .= '</a>';                                   
        $output .= '</div>';          
        $output .='<br><br><div class="ui divider"></div>';
        
        return $output;
        
    }
    
    
    
    function totalPricingTable($standard, $express, $totalSubTotal){
        
        $output = '';
        $output .= '<table class="ui striped yellow table">';
        $output .= '<td class="ui align center" data-tooltip="Click update to see new totals"><h3> Total Pricing</h3></td> ';
        $output .= '<tr><td><b>Standard Shipping:</b></td><td> $' . $standard . '</td></tr>';
        $output .= '<tr><td><b>Express Shipping:</b></td><td> $' . $express . '</td></tr>';     
        $output .= '<tr><td><b>Total Cost with Standard Shipping:</b></td><td>$'. ($totalSubTotal + $standard) . '</td></tr>';
        $output .= '<tr><td><b>Total Cost with Express Shipping:</b></td><td>$'. ($totalSubTotal + $express) . '</td></tr>';
        $output .= '</table>';
        $output .= '</div><br>';
        
        return $output;

    }
    
    
    
    
    function bottomButtons(){
        $output = '';
        $output .= '<form class="ui form" method="POST" action="view-cart.php">';          
        $output .=  '<input class="ui right floated orange button" type="submit" name="cartOptions" value="Update">';
        $output .=  '<input class="ui right floated orange button" type="submit" name="cartOptions" value="Empty Cart">';
        $output .=  '</form><a href=index.php><input class="ui right floated orange button" type="submit" name="cartOptions" value="Continue Shopping"></a>';
        $output .=  '<input class="ui right floated orange button" type="submit" name="cartOptions" value="Order">';
         $output .= '<br><br>';
        
        return $output;
    }
    
    
}


?>