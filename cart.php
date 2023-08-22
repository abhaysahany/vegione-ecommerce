<?php  
include('admin/dbcon.php');
include('insert_cart.php');
?>
<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
    <title>Cart - Vegione</title>
<?php include('header.php')  ?>   
    <div class="hero-wrap hero-bread" style="background-image: url('images/bg_1.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Cart</span></p>
            <h1 class="mb-0 bread">My Cart</h1>
          </div>
        </div>
      </div>
    </div>

<section class="ftco-section ftco-cart">
	<div class="container">
		<div class="row">
		<div class="col-md-12 ftco-animate">
			<div class="cart-list">
		      <?php
                if ($cart_count > 0) 
                {  
                	?>
                	<table class="table">
									  <thead class="thead-primary">
								        <tr class="text-center">
								          <th>&nbsp;</th>
								          <th>&nbsp;</th>
								          <th>Product name</th>
								          <th>MRP</th>
								          <th>Price</th>
								          <th>Quantity</th>
								          <th>Total</th>
								          <th>Shipping</th>
								        </tr>
									  </thead>
									  <tbody>
                    <?php
                   	echo load_cart($con);
                    ?>
                     </tbody>
		              </table>
                   <?php	
                }
                else
                {
                    ?>
                    <div class="text-center">
                    	<img src="images/emptycart.png" class="img-fluid" style="max-width:200px"><br>
                    	<a href="index" class="btn btn-dark px-4 py-2 mb-3">Go Shopping</a>
                    	<p>Start shopping to enjoy great deals</p>
                    </div>
		      	 	<?php	
                }

		      ?>    
			  </div>
		</div>
	</div>
	<div class="row justify-content-end">
		<!-- <div class="col-lg-4 mt-5 cart-wrap ftco-animate">
			<div class="cart-total mb-3">
				<h3>Coupon Code</h3>
				<p>Enter your coupon code if you have one</p>
					<form action="#" class="info">
          <div class="form-group">
          	<label for="">Coupon code</label>
            <input type="text" class="form-control text-left px-3" placeholder="">
          </div>
        </form>
			</div>
			<p><a href="checkout.html" class="btn btn-primary py-3 px-4">Apply Coupon</a></p>
		</div> -->
		<!-- <div class="col-lg-4 mt-5 cart-wrap ftco-animate">
			<div class="cart-total mb-3">
				<h3>Estimate shipping and tax</h3>
				<p>Enter your destination to get a shipping estimate</p>
					<form action="#" class="info">
          <div class="form-group">
          	<label for="">Country</label>
            <input type="text" class="form-control text-left px-3" placeholder="">
          </div>
          <div class="form-group">
          	<label for="country">State/Province</label>
            <input type="text" class="form-control text-left px-3" placeholder="">
          </div>
          <div class="form-group">
          	<label for="country">Zip/Postal Code</label>
            <input type="text" class="form-control text-left px-3" placeholder="">
          </div>
        </form>
			</div>
			<p><a href="checkout.html" class="btn btn-primary py-3 px-4">Estimate</a></p>
		</div> -->
		<div class="col-lg-4 mt-5 cart-wrap ftco-animate">
			<div class="cart-total mb-3">
				<h3>Cart Totals</h3>
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
			<?php 
			  $count = cart_count($con);
        if ($count > 0) {

        	?><p><a href="checkout" class="btn btn-primary py-3 px-4 float-right">Proceed to Checkout</a></p><?php
        }else{
        	?><p><a href="javascript:;" class="btn btn-primary py-3 px-4 float-right" id="emptycart">Proceed to Checkout</a></p>
        	<?php
        }

			?>
			
		</div>
	</div>
	</div>
</section>
<hr>
<section class="ftco-section pb-0 pt-4" >
	<div class="container" >
		<div class="row justify-content-center mb-3 pb-3">
      <div class="col-md-12 heading-section  ftco-animate">
        <h3 class="mb-2">Other Recommended Items..</h3>
        <p>New arrived, top selling products you may also like along with this product</p>
      </div>
    </div>   		
	</div>
	<div class="container">
		<div class="row">
    	<?php 
    	  
  	  foreach ($_COOKIE as $key => $value) 
			{  
		       if (substr($key,0,5) == 'cart_') 
		       {	
		      	 
		      	  $product_id = substr($key, 5, (strlen($key)-5));
              $sql = "SELECT * FROM `wb_cross_upsale` WHERE `wb_product_id`='$product_id' AND `type`='Cross Sale'";
			    	  $run = mysqli_query($con, $sql);
			    	  $row = mysqli_num_rows($run);
			    	  if ($row > 0) 
			    	  {

			    	  	while ($data=mysqli_fetch_assoc($run)) 
			          {
			          	 $datas[]=$data;
			          }

			          foreach ($datas as $key ) 
			          {
			             $productid = $key['select_product_id'];
			             $sql = "SELECT * FROM wb_product_catalogs WHERE product_id = '$productid' AND status='Live'";
			    		     $run = mysqli_query($con, $sql);
			    		     $data=mysqli_fetch_assoc($run);
			    		     $mrp = $data['max_price'];
			             $min = $data['min_price'];
			             $discount = $mrp-$min;
			             $dis_pre =  number_format($discount/$mrp*100,2);
			          	 ?>
			          	 <div class="col-md-6 col-lg-3 ftco-animate">
				    				<div class="product">
				    					<a href="product_display?product_id=<?=$data['product_id'] ?>" class="img-prod"><img class="img-fluid" src="images/products/<?=$data['product_image']?>" alt="Product-img" >
				    						<span class="status"><?=$dis_pre?>%</span>
				    						<div class="overlay"></div>
				    					</a>
				    					<div class="text py-3 pb-4 px-3 ">
				    						<p class="m-0 p-0"><a href="product_display?product_id=<?=$key['product_id'] ?>"><?=$data['brand']?></a></p>
				    						<h3><a href="product_display?product_id=<?=$key['product_id'] ?>"><?=$data['product_name']?></a></h3>
				    						<div class="d-flex">
				    							<div >
				    								<span class="bg-success text-white" style="padding:2px 10px ; border-radius:5px; font-size:12px ;"><?=$data['average_rating'] ?> <span class="ion-ios-star text-white"></span></span>
						    						<span>( <?=$data['rating_count'] ?> )</span>
						    					</div>
					    					</div>
				    						<div class="d-flex">
				    							<div >
						    						<p class="price"><span class="mr-2 price-dc">₹ <?=$data['max_price']?></span><span class="price-sale">₹ <?=$data['min_price']?></span></p>
						    					</div>
					    					</div>
				    					</div>
				    				</div>
				    			</div>
			          	 <?php
			          }
			    	  }
		      	 
		       }
		       
			   
		  }
    	  
    	?>
		</div>
	</div>
</section>
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

<?php include('footer.php')  ?>
<script>
	$(document).ready(function(){
    $('#emptycart').click(function(){
     $(this).html('Sorry! Your Cart is Empty');
    })    
	});
</script>
    
</body>
</html>