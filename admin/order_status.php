<?php 
include('dbcon.php');
include('function.php');
date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d');

if (isset($_GET['accept']) && !empty($_GET['accept'])) {

	$orderid = mysqli_real_escape_string($con, $_GET['accept']);
	$invoice_no = invoiceNo($con);
	date_default_timezone_set('Asia/Kolkata');
	$date  = date('Y-m-d');

	$sql= "UPDATE `wb_order_table` SET `invoice_no`='$invoice_no',`invoice_date`='$date', `status`='Accepted',`accept_reject_on`='$date' WHERE `order_id`='$orderid'";
	$run = mysqli_query($con, $sql);

	if ($run) {

        ?>
        <script type="text/javascript">
        	alert('Order has been Accepted Successfully!')
        	window.location = "new_orders.php";
        </script>
        <?php
	}
}


if (isset($_GET['reject']) && !empty($_GET['reject'])) {

	$orderid = mysqli_real_escape_string($con, $_GET['reject']);
	date_default_timezone_set('Asia/Kolkata');
	$date  = date('Y-m-d');

	$sql= "UPDATE `wb_order_table` SET `status`='Rejected',`accept_reject_on`='$date' WHERE `order_id`='$orderid'";
	$run = mysqli_query($con, $sql);

	if ($run) {

		$action="Add";
      	stock_update($con, $product_id, $action, $quantity);
      	
      	$action="Less";
      	Unit_sold($con, $product_id, $action, $quantity);
		
		?>
        <script type="text/javascript">
        	alert('Order has been Rejected Successfully!')
        	window.location = "new_orders.php";
        </script>
        <?php
	}
}

if (isset($_GET['deliver']) && !empty($_GET['deliver'])) {

	$orderid = mysqli_real_escape_string($con, $_GET['deliver']);
	date_default_timezone_set('Asia/Kolkata');
	$date  = date('Y-m-d');

	$sql= "UPDATE `wb_order_table` SET `status`='Delivered',`delivered_on`='$date' WHERE `order_id`='$orderid'";
	$run = mysqli_query($con, $sql);

	if ($run) {
		
		?>
        <script type="text/javascript">
        	alert('Order has been Delivered Successfully!')
        	window.location = "shipped_orders.php";
        </script>
        <?php
	}
}
?>