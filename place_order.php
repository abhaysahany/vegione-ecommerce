<?php 
include('admin/dbcon.php');
include('function.php');

if (isset($_POST['cod_order'])) 
{
	$userid = $_SESSION['s_user_id'];
	$total_order_value = $_POST['total_order_value'];
	$address_id = getAddressId($con, $userid);
	$orderid = $_POST['orderid'];
	$session = session();
	date_default_timezone_set('Asia/Kolkata');
	$date = date('Y-m-d');

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
      	echo  $product_id = substr($key, 5, (strlen($key)-5));
         
      	 $sql = "SELECT * FROM wb_product_catalogs WHERE product_id = '$product_id'";
      	 $runcod = mysqli_query($con,$sql);
      	 $row = mysqli_num_rows($runcod);
        
      	 while ($data = mysqli_fetch_assoc($runcod)) 
      	 {
	      	 	$total_value = $quantity * $data['min_price'];
	      	 	$total_shipping = $quantity * $data['ship_unit_rate'];

	      	 	$order = "INSERT INTO `wb_order_table`(`order_id`, `order_date`, `session`, `order_type`, `user_id`, `puic`,`product_type`, `order_value`, `quantity`, `shipping`, `total_order_value`, `address_id`, `status`) VALUES ('$orderid','$date','$session','COD','$userid','$product_id','$o_size','$total_value','$quantity','$total_shipping','$total_order_value','$address_id','New')";
	      	 	$run = mysqli_query($con, $order);
	            
	          $action="Less";
	      	 	stock_update($con, $product_id, $action, $quantity);

	      	 	$action="Add";
      	    Unit_sold($con, $product_id, $action, $quantity);

	      	 	$name = $key;
            setcookie($name,"", time() - 3600,"/");
      	 	
      	 }

       }
       
	   
    }

    header('location:final_order?orderid='.$orderid.'&paymehtod=Cash On Delivery');
}

if (isset($_GET['ORDERID']) && isset($_GET['TXNAMOUNT'])) {

	  $mix_orderid=mysqli_real_escape_string($con, $_GET['ORDERID'] ); 
	  $txnid=mysqli_real_escape_string($con,$_GET['TXNID']);
	  $txnamount=mysqli_real_escape_string($con,$_GET['TXNAMOUNT']);
	  $mode=mysqli_real_escape_string($con, $_GET['PAYMENTMODE']);
	  $txndate=mysqli_real_escape_string($con, $_GET['TXNDATE']);
	  $gateway=mysqli_real_escape_string($con, $_GET['GATEWAYNAME']);
	  $banktxnid=mysqli_real_escape_string($con, $_GET['BANKTXNID']);
	  $bankname=mysqli_real_escape_string($con, $_GET['BANKNAME']);

	  $userid = substr($mix_orderid, 16, (strlen($mix_orderid)-16));
	  $orderid= substr($mix_orderid, 0, 16);
    $total_order_value = $txnamount;
	  $address_id = getAddressId($con, $userid);
	  $session = session();
	  date_default_timezone_set('Asia/Kolkata');
	  $date = date('Y-m-d');

	  foreach ($_COOKIE as $key => $value) 
	  {  
       
        if (substr($key,0,5) == 'cart_') 
        {
       	  $key;
       	  $i=1;
      	  $size = substr($value, 0,1);
      	  if ($size==1) { $o_size="Small"; }
      	  elseif($size==2){$o_size="Medium";}
      	  elseif($size==3){$o_size="Large";}
      	  else{$o_size="Extra Large";}

      	  $quantity = substr($value, 1, (strlen($value)-1));
      	  $product_id = substr($key, 5, (strlen($key)-5));

      	  $sql = "SELECT * FROM wb_product_catalogs WHERE product_id = '$product_id'";
      	  $runon = mysqli_query($con,$sql);
      	  $row = mysqli_num_rows($runon);

      	  while ($data = mysqli_fetch_assoc($runon)) 
      	  {
      	 	  $total_value = $quantity * $data['min_price'];
      	 	  $total_shipping = $quantity * $data['ship_unit_rate'];

      	 	  $order = "INSERT INTO `wb_order_table`(`order_id`, `order_date`, `session`, `order_type`, `user_id`, `puic`, `product_type`, `order_value`, `quantity`, `shipping`, `total_order_value`, `address_id`, `txn_id`, `txn_amount`, `payment_method`, `txn_date`, `gateway`, `bank_txnid`, `bank_name`, `status`) VALUES ('$orderid','$date','$session','ONLINE','$userid','$product_id','$o_size','$total_value','$quantity','$total_shipping','$total_order_value','$address_id','$txnid','$txnamount','$mode','$txndate','$gateway','$banktxnid','$bankname','New')";
      	 	  $run = mysqli_query($con, $order);
            
            $action="Less";
      	 	  stock_update($con, $product_id, $action, $quantity);

      	 	  $action="Add";
      	    Unit_sold($con, $product_id, $action, $quantity);

      	 	  $name = $key;
              setcookie($name,"", time() - 3600,"/");
      	 	
      	   }

        }
       
	    
     }
    
    $username = getUsername($con, $userid);
    $_SESSION['s_user_name']=$username;
    $_SESSION['s_user_id']=$userid;
    header('location:final_order?orderid='.$orderid.'&paymehtod=Online Payment');
}
?>