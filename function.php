<?php 
function Session()
{
     date_default_timezone_set('Asia/Kolkata');
     $currentdate = date('Y-m-d');
     $year=date('Y');
     $time="03-31";
     $mydate=$year.'-'.$time;

     if ($currentdate > $mydate) 
     {
         
          $year = date('Y');
          $next=date('y', strtotime('+1 year'));
          $session=$year.'-'.$next;
     }
     else
     {

          $year = date('y');
          $lastyear=date('Y', strtotime('-1 year'));
          $session=$lastyear.'-'.$year;
     }

     return $session;
}


function getAddressId($con, $userid){

	$sql = "SELECT * FROM wb_user_address WHERE user_id = '$userid' ";
	$run = mysqli_query($con, $sql);
	$data = mysqli_fetch_assoc($run);
	$id = $data['id'];

	return $id;
}

function getUsername($con, $userid){

     $sql = "SELECT * FROM wb_user_details WHERE id = '$userid' ";
     $run = mysqli_query($con, $sql);
     $data = mysqli_fetch_assoc($run);
     $username = $data['username'];

     return $username;

}

function orderid($con)
{
   $a=rand(1000000,9999999);
   $b=rand(1000000,9999999);
   $c="OD".$a.$b;

   return $c;
}


function stock_update($con, $product_id, $action, $quantity){

    $sql = "SELECT * FROM wb_product_catalogs WHERE product_id = '$product_id' ";
	$run = mysqli_query($con, $sql);
	$data = mysqli_fetch_assoc($run);
	$old_stock = $data['stock_quantity'];

	if ($action == "Less") {

		$stock = $old_stock - $quantity;

	}elseif ($action == "Add") {

		$stock = $old_stock + $quantity;
	}

	$sql = "UPDATE `wb_product_catalogs` SET `stock_quantity`='$stock' WHERE `product_id`='$product_id'";
	$run = mysqli_query($con, $sql);
}

function Unit_sold($con, $product_id, $action, $quantity)
{
     $sql = "SELECT * FROM wb_product_catalogs WHERE product_id = '$product_id' ";
     $run = mysqli_query($con, $sql);
     $data = mysqli_fetch_assoc($run);
     $old_sale = $data['total_sales'];

     if ($action == "Less") {

          $sale = $old_sale - $quantity;

     }elseif ($action == "Add") {

          $sale = $old_sale + $quantity;
     }

     $sql = "UPDATE `wb_product_catalogs` SET `total_sales`='$sale' WHERE `product_id`='$product_id'";
     $run = mysqli_query($con, $sql);  
}
?>