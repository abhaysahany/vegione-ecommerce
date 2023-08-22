<?php  
include('admin/dbcon.php');
include('insert_cart.php');
include('function.php');

$sql = "SELECT * FROM `wb_state_name`";
$run = mysqli_query($con, $sql);
$row =mysqli_num_rows($run);
if ($row > 0) {

    $option="<option>Select State</option>";
    while ($data=mysqli_fetch_assoc($run)) {

        $option .="<option >".$data['name']."</option>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
  
<meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
    <title>Checkout - Vegione</title>
<?php include('header.php') ?>    
   
    <div class="hero-wrap hero-bread" style="background-image: url('images/bg_1.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Checkout</span></p>
            <h1 class="mb-0 bread">Checkout</h1>
          </div>
        </div>
      </div>
    </div>
<?php
if (!isset($_SESSION['s_user_id'])) {

	?>
	<section class="ftco-section">
      <div class="container">
        <div class="row justify-content-center ">
          <div class="col-xl-7" >
          	<div class="row mt-5 pt-3">
	          	<div class="col-md-12 d-flex mb-5">
	          		<div class="cart-detail cart-total p-3 p-md-4">
	          			<h3 class="text-center mt-5">User Details</h3>
	          			<a href="user_signin?checkout=1 " class="btn btn-primary mt-5">Login / Signup</a>
								</div>
	          	</div>
	          </div>
					</div>
					<div class="col-xl-5">
	          <div class="row mt-5 pt-3">
	          	<div class="col-md-12 d-flex mb-5">
	          		<div class="cart-detail cart-total p-3 p-md-4">
	          			<h3 class="billing-heading mb-4">Cart Total</h3>
	          			<p class="d-flex">
										<span>Subtotal</span>
										<span>₹ <?=$grand_total?></span>
									</p>
									<p class="d-flex">
										<span>Delivery</span>
										<span>₹ <?=$grand_total_ship?></span>
									</p>
									<p class="d-flex">
										<span>Discount</span>
										<span>₹ <?=$discount?></span>
									</p>
									<hr>
									<p class="d-flex total-price">
										<span>Total</span>
										<span>₹ <?=$total_net_pay?></span>
									</p>
								</div>
	          	</div>
	          </div>
          </div> <!-- .col-md-8 -->
        </div>
      </div>
    </section> <!-- .section -->
	<?php
}
else
{
	?>
	<section class="ftco-section">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-xl-7 ftco-animate">
          <?php 
           $userid = $_SESSION['s_user_id'];
           $sql = "SELECT * FROM wb_user_address WHERE user_id='$userid'";
           $run = mysqli_query($con,$sql);
           $row = mysqli_num_rows($run);
           if ($row > 0) 
           {  
           	  $_SESSION['add_id']=1;
           	  $data=mysqli_fetch_assoc($run);
           	  ?>
           	  <form action="checkout" class="billing-form" method="post">
								<h3 class=" mb-0 billing-heading">Billing Details </h3>
								<span class="icon-edit mb-4 mt-0 wantadd"> </span><span id="wanttext"> Edit Address</span>
		          	<div class="row align-items-end" id="billing">
		          		<div class="col-md-6">
		                <div class="form-group">
		                	<label for="firstname">Firt Name</label>
		                  <input type="text" class="form-control" value="<?php echo $data['f_name']?>" name="fname">
		                </div>
		              </div>
		              <div class="col-md-6">
		                <div class="form-group">
		                	<label for="lastname">Last Name</label>
		                  <input type="text" class="form-control" value="<?php echo $data['l_name']?>" name="lname">
		                </div>
	                </div>
	                <div class="w-100"></div>
			            <div class="col-md-12">
			            	<div class="form-group">
			            		<label for="country">State </label>
			            		<input type="text" class="form-control" value="<?php echo $data['state']?>" name="state">
			            	</div>
			            </div>
			            <div class="w-100"></div>
			            <div class="col-md-12">
			            	<div class="form-group">
		                	<label for="streetaddress">Street Address</label>
		                  <input type="text" class="form-control" value="<?php echo $data['address']?>" name="address">
		                </div>
			            </div>
			            <div class="w-100"></div>
			            <div class="col-md-6">
			            	<div class="form-group">
		                	<label for="towncity">Town / City</label>
		                  <input type="text" class="form-control" value="<?php echo $data['city']?>" name="city">
		                </div>
			            </div>
			            <div class="col-md-6">
			            	<div class="form-group">
			            		<label for="postcodezip">Postcode / ZIP *</label>
		                  <input type="text" class="form-control" value="<?php echo $data['pincode']?>" name="pincode">
		                </div>
			            </div>
			            <div class="w-100"></div>
			            <div class="col-md-6">
		                <div class="form-group">
		                	<label for="phone">Phone</label>
		                  <input type="text" class="form-control" value="<?php echo $data['phone']?>" name="phone">
		                </div>
		              </div>
		              <div class="col-md-6">
		                <div class="form-group">
		                	<label for="emailaddress">Email Address</label>
		                  <input type="text" class="form-control" value="<?php echo $data['email']?>" name="email">
		                </div>
	                </div>
	                <div class="w-100"></div>
	                <div class="col-md-12 text-center">
	                	<div class="form-group mt-4">
											<button class="btn btn-primary px-3 py-2" style="display:none" id="editadd" name="editadd">Change & Save Address</button>
										</div>
	                </div>
		            </div>
		          </form><!-- END -->
           	  <?php
           }
           else
           {
           	  ?>
           	  <form action="checkout" class="billing-form" method="post">
								<h3 class="mb-4 billing-heading">Billing Details</h3>
		          	<div class="row align-items-end" id="billing">
		          		<div class="col-md-6">
		                <div class="form-group">
		                	<label for="firstname">Firt Name</label>
		                  <input type="text" class="form-control" placeholder="Enter First Name" name="fname" required>
		                </div>
		              </div>
		              <div class="col-md-6">
		                <div class="form-group">
		                	<label for="lastname">Last Name</label>
		                  <input type="text" class="form-control" placeholder="Enter Last Name" name="lname" required>
		                </div>
	                </div>
	                <div class="w-100"></div>
			            <div class="col-md-12">
			            	<div class="form-group">
			            		<label for="country">State </label>
			            		<select class="form-control" name="state" required>
			            			  <?php echo $option ?>
			            		</select>
			            		
			            	</div>
			            </div>
			            <div class="w-100"></div>
			            <div class="col-md-12">
			            	<div class="form-group">
		                	<label for="streetaddress">Street Address</label>
		                  <input type="text" class="form-control" placeholder="Locality, House number and street name" name="address" required>
		                </div>
			            </div>
			            <div class="w-100"></div>
			            <div class="col-md-6">
			            	<div class="form-group">
		                	<label for="towncity">Town / City</label>
		                  <input type="text" class="form-control" placeholder="Enter Town / City" name="city" required>
		                </div>
			            </div>
			            <div class="col-md-6">
			            	<div class="form-group">
			            		<label for="postcodezip">Postcode / ZIP *</label>
		                  <input type="text" class="form-control" placeholder="Enter Pincode" name="pincode" required>
		                </div>
			            </div>
			            <div class="w-100"></div>
			            <div class="col-md-6">
		                <div class="form-group">
		                	<label for="phone">Phone</label>
		                  <input type="text" class="form-control" placeholder="Enter Phone" name="phone" required>
		                </div>
		              </div>
		              <div class="col-md-6">
		                <div class="form-group">
		                	<label for="emailaddress">Email Address</label>
		                  <input type="text" class="form-control" placeholder="Enter Email" name="email" required>
		                </div>
	                </div>
	                <div class="w-100"></div>
	                <div class="col-md-12 text-center">
	                	<div class="form-group mt-4">
											<button class="btn btn-primary px-3 py-2" name="add_address">Add Address</button>
										</div>
	                </div>
		            </div>
		          </form><!-- END -->
           	  <?php
           }

          ?>	
						
					</div>
					<div class="col-xl-5">
	          <div class="row mt-5 pt-3">
	          	<div class="col-md-12 d-flex mb-5">
	          		<div class="cart-detail cart-total p-3 p-md-4">
	          			<h3 class="billing-heading mb-4">Cart Total</h3>
	          			<p class="d-flex">
										<span>Subtotal</span>
										<span>₹ <?=$grand_total?></span>
									</p>
									<p class="d-flex">
										<span>Delivery</span>
										<span>₹ <?=$grand_total_ship?></span>
									</p>
									<p class="d-flex">
										<span>Discount</span>
										<span>₹ <?=$discount?></span>
									</p>
									<hr>
									<p class="d-flex total-price">
										<span>Total</span>
										<span>₹ <?=$total_net_pay?></span>
									</p>
								</div>
	          	</div>
	          	<div class="col-md-12">
	          		<div class="cart-detail p-3 p-md-4">
	          			<h3 class="billing-heading mb-4">Payment Method</h3>
									<div class="form-group">
										<div class="col-md-12">
											<div class="radio">
											   <label><input type="radio" name="optradio" value="online"  class="mr-2"> Online Playment</label>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-12">
											<div class="radio">
											   <label><input type="radio" name="optradio" value="cod" class="mr-2"> Cash On Delivery</label>
											</div>
										</div>
									</div>
									<?php 
									 $userid = $_SESSION['s_user_id']; 
									 $orderid = orderid($con); 
								  ?>
									<form action="PaytmKit/pgRedirect.php" method="post" id="Formonline" style="display:none">          
                       <div class="form-group">    
                          <input type="hidden" id="ORDER_ID" tabindex="1" maxlength="35" size="35" name="ORDER_ID" autocomplete="off" value="<?php echo $orderid.$userid ?>">
                          <input id="CUST_ID" type="hidden" tabindex="2" maxlength="12" size="12" name="CUST_ID" autocomplete="off" value="<?php echo $_SESSION['s_user_id']; ?>">
                          <input type="hidden" id="INDUSTRY_TYPE_ID" tabindex="4" maxlength="12" size="12" name="INDUSTRY_TYPE_ID" autocomplete="off" value="Retail">
                          <input type="hidden" id="CHANNEL_ID" tabindex="4" maxlength="12"size="12" name="CHANNEL_ID" autocomplete="off" value="WEB">
                          <input title="TXN_AMOUNT" tabindex="10" type="hidden" name="TXN_AMOUNT" value="<?php echo $total_net_pay;?>">
                        </div>
										 <button class="btn btn-primary py-3 px-4" name="submit">Place an order Online</button>
									</form>
									<form action="place_order" method="post" id="Formcod" style="display:none">
										 <input type="hidden" name="total_order_value" value="<?php echo $total_net_pay ?>">
										 <input type="hidden" name="orderid" value="<?php echo $orderid ?>">
										 <button class="btn btn-primary py-3 px-4" name="cod_order">Place an order COD</button>
									</form>
									<?php 
                   if (isset($_SESSION['add_id'])) {

                   	 ?><button class="btn btn-primary py-3 px-4" id="placeorder">Place an order</button>
                   	   <small id="placeshow" class="text-center text-danger ml-5"></small>
                   	 <?php
                   }
                   else
                   {
                      ?><button class="btn btn-primary py-3 px-4" id="addleft">Place an order</button>
                      <small id="addshow" class="text-center text-danger ml-5"></small>
                      <?php
                   }

									?>
								</div>
	          	</div>
	          </div>
          </div> <!-- .col-md-8 -->
        </div>
      </div>
    </section> <!-- .section -->
	<?php
}
?>
    

		<section class="ftco-section ftco-no-pt ftco-no-pb py-5 bg-light">
      <div class="container py-4">
        <div class="row d-flex justify-content-center py-5">
          <div class="col-md-6">
          	<h2 style="font-size: 22px;" class="mb-0">Subcribe to our Newsletter</h2>
          	<span>Get e-mail updates about our latest shops and special offers</span>
          </div>
          <div class="col-md-6 d-flex align-items-center">
            <form action="#" class="subscribe-form">
              <div class="form-group d-flex">
                <input type="text" class="form-control" placeholder="Enter email address">
                <input type="submit" value="Subscribe" class="submit px-3">
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>

<?php include('footer.php') ?>
<script type="text/javascript">
	$(document).ready(function(){
      $('#addleft').click(function(){
    	$('#addshow').html('* Please Add Your Shipping Address First');
   })

      $('#placeorder').click(function(){
    	$('#placeshow').html('* Please Select Payment Method');
   })

   $('.wantadd').click(function(){
    	$('#wanttext').html('Change and Save Address Details Now')
   	  $('#editadd').show();
   })

   $('input[name="optradio"]:radio').change( function(){

      if (this.value == 'online') 
      {
         $('#Formonline').show();
         $('#placeorder, #addleft, #Formcod, #placeshow').hide();
      }
      else if(this.value == 'cod'){

         $('#Formcod').show();
         $('#placeorder, #addleft, #Formonline, #placeshow').hide();
      } 
   });
	});
</script>
</body>
</html>
</head>
<?php 
if (isset($_POST['add_address'])){

	$fname = mysqli_real_escape_string($con, $_POST['fname']);
	$lname = mysqli_real_escape_string($con, $_POST['lname']);
	$state = mysqli_real_escape_string($con, $_POST['state']);
	$address = mysqli_real_escape_string($con, $_POST['address']);
	$city = mysqli_real_escape_string($con, $_POST['city']);
	$pincode = mysqli_real_escape_string($con, $_POST['pincode']);
	$phone = mysqli_real_escape_string($con, $_POST['phone']);
	$email = mysqli_real_escape_string($con, $_POST['email']);
	$userid = $_SESSION['s_user_id'];

	$sql = "INSERT INTO `wb_user_address`(`user_id`, `f_name`, `l_name`, `state`, `address`, `city`, `pincode`, `phone`, `email`) VALUES ('$userid','$fname','$lname','$state','$address','$city','$pincode','$phone','$email')";
	$run = mysqli_query($con, $sql);

	if ($run) {
      
          $_SESSION['add_id']=1;
          header('location:checkout');
		   
	}

}


if (isset($_POST['editadd'])){

	$fname = mysqli_real_escape_string($con, $_POST['fname']);
	$lname = mysqli_real_escape_string($con, $_POST['lname']);
	$state = mysqli_real_escape_string($con, $_POST['state']);
	$address = mysqli_real_escape_string($con, $_POST['address']);
	$city = mysqli_real_escape_string($con, $_POST['city']);
	$pincode = mysqli_real_escape_string($con, $_POST['pincode']);
	$phone = mysqli_real_escape_string($con, $_POST['phone']);
	$email = mysqli_real_escape_string($con, $_POST['email']);
	$userid = $_SESSION['s_user_id'];

	$sql = "UPDATE `wb_user_address` SET `f_name`='$fname',`l_name`='$lname',`state`='$state',`address`='$address',`city`='$city',`pincode`='$pincode',`phone`='$phone',`email`='$email' WHERE `user_id`='$userid'";
	$run = mysqli_query($con, $sql);

	if ($run) {
      
          $_SESSION['add_id']=1;
          header('location:checkout');
		   
	}

}
?>