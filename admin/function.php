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


function getCatId($category, $con){

	

	$sql = "SELECT * FROM wb_category WHERE category = '$category' ";
	$run = mysqli_query($con, $sql);
	$data = mysqli_fetch_assoc($run);
	$id = $data['id'];

	return $id;
}

function getCatName($category_id, $con){

	

	$sql = "SELECT * FROM wb_category WHERE id = '$category_id' ";
	$run = mysqli_query($con, $sql);
	$data = mysqli_fetch_assoc($run);
	$category = $data['category'];

	return $category;
}


function getProId($product, $con){

	

	$sql = "SELECT * FROM wb_product_catalogs WHERE  `product_name`='$product' ";
	$run = mysqli_query($con, $sql);
	$data = mysqli_fetch_assoc($run);
	$id = $data['id'];

	return $id;
}

function getProName($product_id, $con){

	

	$sql = "SELECT * FROM wb_product_catalogs WHERE product_id = '$product_id' ";
	$run = mysqli_query($con, $sql);
	$data = mysqli_fetch_assoc($run);
	$product = $data['product_name'];

	return $product;
}

function getCategoryId($product_id, $con)
{
	$sql = "SELECT * FROM wb_product_catalogs WHERE product_id = '$product_id' ";
	$run = mysqli_query($con, $sql);
	$data = mysqli_fetch_assoc($run);
	$category_id = $data['category_id'];

	return $category_id;
}


function random_string($length) {
    $key = '';
    $keys = array_merge(range('A', 'Z'));

    for ($i = 0; $i < $length; $i++) {
        $key .= $keys[array_rand($keys)];
    }

    return $key;
}

function puic()
{

  $a=rand(9999,1000);
  $b=rand(1000,9999);
  $g=random_string(4);
  $c=$a.$g.$b;

  $item_uc=$c;

  
  return $item_uc;
  
}

function CrossSale($product_id, $con)
{
    $sql = "SELECT count(select_product_id) as total FROM wb_cross_upsale WHERE wb_product_id = '$product_id' AND `type`='Cross Sale'";
	$run = mysqli_query($con, $sql);
	$data = mysqli_fetch_assoc($run);
	$count = $data['total'];

	return $count;
}

function UpsaleSale($product_id, $con)
{
    $sql = "SELECT count(select_product_id) as total FROM wb_cross_upsale WHERE wb_product_id = '$product_id' AND `type`='Upsale'";
	$run = mysqli_query($con, $sql);
	$data = mysqli_fetch_assoc($run);
	$count = $data['total'];

	return $count;
}

function getOrderCount($orderid, $con){

	$sql = "SELECT count(order_id) as total FROM wb_order_table WHERE order_id = '$orderid' ";
	$run = mysqli_query($con, $sql);
	$data = mysqli_fetch_assoc($run);
	$count = $data['total'];

	return $count;
}


function invoiceNo($con){

    $session = Session();

	$sql = "SELECT * FROM wb_order_table WHERE session = '$session' AND `invoice_no`!='' ORDER BY invoice_no ASC limit 1";
	$run = mysqli_query($con, $sql);
	$row = mysqli_num_rows($run);
	if ($row > 0) 
	{
		$data = mysqli_fetch_assoc($run);
	    $InvoiceNo = $data['invoice_no']+1;
	}
	else
	{
		$InvoiceNo = 1;
	}
	

	return $InvoiceNo;
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

function wh_log($log_msg) {
    $log_filename = $_SERVER['DOCUMENT_ROOT']."/vegione/log";
    if (!file_exists($log_filename))
    {
        // create directory/folder uploads.
        mkdir($log_filename, 0777, true);
    }
    $log_file_data = $log_filename.'/log_' . date('d-M-Y') . '.log';
    file_put_contents($log_file_data, $log_msg . "\n", FILE_APPEND);
}
?>