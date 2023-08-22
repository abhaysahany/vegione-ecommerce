<?php  
include('admin/dbcon.php');
include('admin/function.php');
include('insert_cart.php');

if (isset($_POST['submit'])) 
{
	$size = $_POST['size'];
	$quantity = $_POST['quantity'];
	$product_id = $_POST['product_id'];
	$value = $size.$quantity;
	$name='cart_'.$product_id;
  setcookie($name, $value, time() + (86400 * 30), "/");
  
	header('location:cart');
}

if (isset($_GET['product_id']) && !empty($_GET['product_id'])) {

	$_SESSION['product_id'] = mysqli_real_escape_string($con, $_GET['product_id']);
}

if (isset($_SESSION['product_id']) && !empty($_SESSION['product_id'])) {

  $product_id = $_SESSION['product_id'];
	$sql = "SELECT * FROM wb_product_catalogs WHERE product_id = '$product_id'";
  $run = mysqli_query($con, $sql);
  $prodata=mysqli_fetch_assoc($run);
  $categoryid = $prodata['category_id'];
}else{
	header('location:index');
}

?>
<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
    <title>Vegefoods - Free Bootstrap 4 Template by Colorlib</title>
<?php include('header.php') ?>    

    <div class="hero-wrap hero-bread" style="background-image: url('images/bg_1.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span class="mr-2"><a href="index.html">Product</a></span> <span>Product Single</span></p>
            <h1 class="mb-0 bread">Product Single</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section">
    	<div class="container">
    		<div class="row">
    		 	
    			<div class="col-lg-6 mb-5 ftco-animate">
    				<a href="" class="image-popup"><img src="images/products/<?=$prodata['product_image']?>" class="img-fluid" alt="product_img"></a>
    			</div>
    			<div class="col-lg-6 product-details pl-md-5 ftco-animate">
    				<h3><?=$prodata['product_name']?></h3>
    				<div class="rating d-flex">
							<p class="text-left mr-4">
								<a href="#" class="mr-2"><?=$prodata['average_rating']?></a>
								<a href="#"><span class="ion-ios-star-outline"></span></a>
								<a href="#"><span class="ion-ios-star-outline"></span></a>
								<a href="#"><span class="ion-ios-star-outline"></span></a>
								<a href="#"><span class="ion-ios-star-outline"></span></a>
								<a href="#"><span class="ion-ios-star-outline"></span></a>
							</p>
							<p class="text-left mr-4">
								<a href="#" class="mr-2" style="color: #000;"><?=$prodata['rating_count']?> <span style="color: #bbb;">Rating</span></a>
							</p>
							<p class="text-left">
								<a href="#" class="mr-2" style="color: #000;"><?=$prodata['total_sales']?> <span style="color: #bbb;">Sold</span></a>
							</p>
						</div>
    				<p class="price mb-0"><span>₹ <?=$prodata['min_price']?></span></p>
    				<span class="mt-0"><strike>MRP : ₹ <?=$prodata['max_price']?></strike></span>
    				<p><?=$prodata['short_description']?></p>
    				<form action="product_display" method="post">
						<div class="row mt-4">
							<div class="col-md-6">
								<div class="form-group d-flex">
		              <div class="select-wrap">
	                  <div class="icon"><span class="ion-ios-arrow-down"></span></div>
	                  <select name="size" id="" class="form-control">
	                  	<option value="1">Small</option>
	                    <option value="2">Medium</option>
	                    <option value="3">Large</option>
	                    <option value="4">Extra Large</option>
	                  </select>
	                </div>
		            </div>
							</div>
							<div class="w-100"></div>
							<div class="input-group col-md-6 d-flex">
	             	<span class="input-group-btn mr-2">
	                	<button type="button" class="quantity-left-minus btn"  data-type="minus" data-field="">
	                   <i class="ion-ios-remove"></i>
	                	</button>
	            		</span>
	            	<input type="hidden" id="stock" name="stock"  value="<?=$prodata['stock_quantity']?>" >
	             	<input type="text" id="quantity" name="quantity" class="form-control input-number" value="1" min="1" max="100">
	             	<span class="input-group-btn ml-2">
	                	<button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
	                     <i class="ion-ios-add"></i>
	                 </button>
	             	</span>
	          	</div>
	            <div class="w-100"></div>
	          	<div id="msg" class="text-danger ml-3 mt-0" style="font-size:12px;"></div>
	          	<div class="w-100"></div>
	          	<div class="col-md-12 mt-3">
	          		<p style="color: #000;"><?=$prodata['stock_quantity']?> kg available</p>
	          	</div>
          	</div>
          	<input type="hidden"  name="product_id"  value="<?=$prodata['product_id']?>" >
          	<input type="submit" class="btn btn-black py-3 px-5" name="submit" value="Add to Cart">
          	</form>
    			</div>
    		</div>
    	</div>
    </section>

    <section class="ftco-section">
    	<div class="container">
				<div class="row justify-content-center mb-3 pb-3">
          <div class="col-md-12 heading-section text-center ftco-animate">
          	<span class="subheading">Products</span>
            <h2 class="mb-4">You may also like...</h2>
            <p>New arrived, top selling products you may also like along with this product</p>
          </div>
        </div>   		
    	</div>
    	<div class="container">
    		<div class="row">
		    	<?php 
		    	  
		    	  $sql = "SELECT * FROM `wb_cross_upsale` WHERE `wb_product_id`='$product_id' AND `type`='Upsale'";
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
		    	  else
		    	  {
                 $sql = "SELECT * FROM wb_product_catalogs WHERE category_id = '$categoryid' AND status='Live' limit 4";
				    		 $run = mysqli_query($con, $sql);
				    		 $row = mysqli_num_rows($run);
				    		 if ($row > 0) {
				            
				            while ($data=mysqli_fetch_assoc($run)) 
				            {
				            	 $datas[]=$data;
				            }

				            foreach ($datas as $key ) 
				            {
				               $mrp = $key['max_price'];
				               $min = $key['min_price'];
				               $discount = $mrp-$min;
				               $dis_pre =  number_format($discount/$mrp*100,2);
				            	 ?>
				            	 <div class="col-md-6 col-lg-3 ftco-animate">
						    				<div class="product">
						    					<a href="product_display?product_id=<?=$key['product_id'] ?>" class="img-prod"><img class="img-fluid" src="images/products/<?=$key['product_image']?>" alt="Product-img" >
						    						<span class="status"><?=$dis_pre?>%</span>
						    						<div class="overlay"></div>
						    					</a>
						    					<div class="text py-3 pb-4 px-3 ">
						    						<p class="m-0 p-0"><a href="product_display?product_id=<?=$key['product_id'] ?>"><?=$key['brand']?></a></p>
						    						<h3><a href="product_display?product_id=<?=$key['product_id'] ?>"><?=$key['product_name']?></a></h3>
						    						<div class="d-flex">
						    							<div >
						    								<span class="bg-success text-white" style="padding:2px 10px ; border-radius:5px; font-size:12px ;"><?=$key['average_rating'] ?> <span class="ion-ios-star text-white"></span></span>
								    						<span>( <?=$key['rating_count'] ?> )</span>
								    					</div>
							    					</div>
						    						<div class="d-flex">
						    							<div >
								    						<p class="price"><span class="mr-2 price-dc">₹ <?=$key['max_price']?></span><span class="price-sale">₹ <?=$key['min_price']?></span></p>
								    					</div>
							    					</div>
						    					</div>
						    				</div>
						    			</div>
				            	 <?php
				            }
				    		 	
				    		 }
				    		 else
				    		 {
				    		 	  ?>
				    		 	  <div class="col-md-12">
				    		 	  	<p>There is no Product to Display</p>
				    		 	  </div>
				    		 	  <?php
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
<?php include('footer.php') ?>
  <script>
		$(document).ready(function(){

		var quantitiy=0;
		var stock=parseInt($('#stock').val());
		   $('.quantity-right-plus').click(function(e){
		        
		        // Stop acting like a button
		        e.preventDefault();
		        // Get the field name
		        var quantity = parseInt($('#quantity').val());
		        // If is not undefined
		        if (quantity < stock) {
               $('#quantity').val(quantity + 1);
		        }else{
              $('#msg').html('Quantity can not be grater then Stock'); 
		        } 
		            
		            

		          
		            // Increment
		        
		    });

		     $('.quantity-left-minus').click(function(e){
		        // Stop acting like a button
		        e.preventDefault();
		        // Get the field name
		        var quantity = parseInt($('#quantity').val());
		        var stock=parseInt($('#stock').val());
		        
		        // If is not undefined
		      
		            // Increment
		            if(quantity> 0 && quantity <= stock){

		            $('#quantity').val(quantity - 1);
		            $('#msg').html('');
		            }
		    });
		    
		});
	</script>
    
</body>
</html>