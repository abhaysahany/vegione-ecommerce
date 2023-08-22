<?php 

if (isset($_GET['delete'])) 
{
	$name = 'cart_'.$_GET['delete'];
    setcookie($name,"", time() - 3600,"/");
    header('location:cart.php');
}

function cart_count($con){
   
   $i=0;
   foreach ($_COOKIE as $key => $value) 
   {  
       if (substr($key,0,5) == 'cart_') 
       {
       	  $i++;
       }   
   }

   return $i;
}

#######################Cart Load Function ####################

function load_cart($con)
{  
   $grand_total=0;
   $total_quantity=0; 
	foreach ($_COOKIE as $key => $value) 
	{  
       if (substr($key,0,5) == 'cart_') 
       {
       	 $i=1;
      	 $size = substr($value, 0,1);
      	 if ($size==1) { $o_size="Small"; }
      	 elseif($size==2){$o_size="Medium";}
      	 elseif($size==3){$o_size="Large";}
      	 else{$o_size="Extra Large";}		
      	 $quantity = substr($value, 1, (strlen($value)-1));
      	 $product_id = substr($key, 5, (strlen($key)-5));

      	 $sql = "SELECT * FROM wb_product_catalogs WHERE product_id = '$product_id'";
      	 $run = mysqli_query($con,$sql);
      	 $row = mysqli_num_rows($run);

      	 while ($data = mysqli_fetch_assoc($run)) 
      	 {
      	 	$total_value = $quantity * $data['min_price'];
      	 	$total_shipping = $quantity * $data['ship_unit_rate'];
      	 	?>
      	 	<tr class="text-center">
		        <td class="product-remove"><a href="insert_cart.php?delete=<?php echo $data['product_id'] ?>"><span class="ion-ios-close"></span></a></td>
		        
		        <td class="image-prod"><div class="img" style="background-image:url(images/products/<?=$data['product_image']?>);"></div></td>
		        
		        <td class="product-name">
		        	<h3><?=$data['product_name']?> (<?=$o_size?>)</h3>
		        	<p><?=$data['short_description']?></p>
		        </td>
		        
		        <td class="price">₹ <?=$data['max_price']?></td>
		        <td class="price">₹ <?=$data['min_price']?></td>
		        
		        <td class="">
		        	<div class="input-group mb-3">
	             	<input type="text" name="quantity" class=" form-control input-number" value="<?=$quantity?>" size="5">
	          	</div>
	          </td>
		        
		        <td class="total">₹ <?=$total_value?></td>
		        <td class="total">₹ <?=$total_shipping?></td>
		    </tr><!-- END TR-->
      	 	<?php
      	 }

      	 $grand_total +=$total_value;
      	 $total_quantity +=$quantity;
       }
       
	   
    }
	
}


$grand_max_total=0;
$grand_min_total=0;
$total_quantity=0;
$grand_total_ship=0; 
foreach ($_COOKIE as $key => $value) 
{  
    if (substr($key,0,5) == 'cart_') 
    {
    	 $i=1;
   	 $size = substr($value, 0,1);
   	 if ($size==1) { $o_size="Small"; }
   	 elseif($size==2){$o_size="Medium";}
   	 elseif($size==3){$o_size="Large";}
   	 else{$o_size="Extra Large";}		
   	 $quantity = substr($value, 1, (strlen($value)-1));
   	 $product_id = substr($key, 5, (strlen($key)-5));

   	 $sql = "SELECT * FROM wb_product_catalogs WHERE product_id = '$product_id'";
   	 $run = mysqli_query($con,$sql);
   	 $row = mysqli_num_rows($run);

   	 while ($data = mysqli_fetch_assoc($run)) 
   	 {
   	 	$total_max_value = $quantity * $data['max_price'];
   	 	$total_min_value = $quantity * $data['min_price'];
   	 	$total_shipping = $quantity * $data['ship_unit_rate'];
   	 	
   	 }

   	 $grand_max_total +=$total_max_value;
   	 $grand_min_total +=$total_min_value;
   	 $grand_total_ship +=$total_shipping;
   	 $total_quantity +=$quantity;
    }
    
   
 }

 $grand_total=$grand_max_total;
 $discount = $grand_max_total-$grand_min_total;
 $total_net_pay=$grand_total+$grand_total_ship-$discount;
?>