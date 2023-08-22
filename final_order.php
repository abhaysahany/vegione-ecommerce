<?php  
include('admin/dbcon.php');
include('insert_cart.php');


?>
<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
    <title>Order Status - Vegione</title>
    
<?php include('header.php') ?>
<?php 
     if (isset($_GET['mismatched']) && $_GET['mismatched']=='failed') 
     {
     	   ?>
     	   <div class="mt-5 mb-5" >
			      <div class="container">
			        <div class="row no-gutters   justify-content-center">

			          <div class="col-md-9 ftco-animate text-center">
			          	<h1><span class="icon-error_outline text-success"></span></h1>
			            <h1 class="mb-0  text-success">Sorry !</h1>
			            <h3 class="mb-0  text-success"><b>Order could not be Placed</b></h3>
			            <p class="text-dark mt-4 mb-0">Estimated Delivery Date</p>
			            <p class="text-dark mt-0">No Order Placed</p>

			            <p class="text-dark mt-4 mb-0">Payment Method</p>
			            <p class="text-dark mt-0">Online Payment</p>
			          </div>
			        </div>
			      </div>
			    </div>


					<section class="ftco-section ftco-no-pt ftco-no-pb py-5 bg-light">
			      <div class="container py-4">
			        <div class="row d-flex justify-content-center py-5">
			          <a href="index" class="btn btn-primary px-5 py-2">Create Order Again</a>
			        </div>
			      </div>
			    </section>
     	 <?php 
     }else
     {
     	 ?>
     	   <div class="mt-5 mb-5" >
			      <div class="container">
			        <div class="row no-gutters   justify-content-center">

			          <div class="col-md-9 ftco-animate text-center">
			          	<h1><span class="icon-check_circle text-success"></span></h1>
			            <h1 class="mb-0  text-success">Thank You !</h1>
			            <h3 class="mb-0  text-success"><b>Order Successfully Placed</b></h3>
			            <p class="text-dark mt-4 mb-0">Estimated Delivery Date</p>
			            <p class="text-dark mt-0"><?php
			                 echo date('D', strtotime('+ 5days'));
			                 echo " , ";
			                 echo date('M d', strtotime('+ 5days'));
			                 echo " , ";
			                 echo date('Y', strtotime('+ 5days'));
			             ?></p>

			            <p class="text-dark mt-4 mb-0">Payment Method</p>
			            <p class="text-dark mt-0"><?php
			                 echo $_GET['paymehtod'];
			             ?></p>
			          </div>
			        </div>
			      </div>
			    </div>


					<section class="ftco-section ftco-no-pt ftco-no-pb py-5 bg-light">
			      <div class="container py-4">
			        <div class="row d-flex justify-content-center py-5">
			          <a href="index" class="btn btn-primary px-5 py-2">Create Another Order</a>
			        </div>
			      </div>
			    </section>
     	 <?php
     }
?>
    

<?php include('footer.php') ?>    
</body>
</html>