<?php  
include('admin/dbcon.php');
include('insert_cart.php');


?>
<!DOCTYPE html>
<html lang="en">
  
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
    <title>Vegione | Fresh Vegetables Store</title>
<?php include('header.php') ?>    

    <section id="home-section" class="hero">
		  <div class="home-slider owl-carousel">
	      <div class="slider-item" style="background-image: url(images/bg_1.jpg);">
	      	<div class="overlay"></div>
	        <div class="container">
	          <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

	            <div class="col-md-12 ftco-animate text-center">
	              <h1 class="mb-2">We serve Fresh Vegestables &amp; Fruits</h1>
	              <h2 class="subheading mb-4">We deliver organic vegetables &amp; fruits</h2>
	              <p><a href="#product_details" class="btn btn-primary">View Details</a></p>
	            </div>

	          </div>
	        </div>
	      </div>

	      <div class="slider-item" style="background-image: url(images/bg_2.jpg);">
	      	<div class="overlay"></div>
	        <div class="container">
	          <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

	            <div class="col-sm-12 ftco-animate text-center">
	              <h1 class="mb-2">100% Fresh &amp; Organic Foods</h1>
	              <h2 class="subheading mb-4">We deliver organic vegetables &amp; fruits</h2>
	              <p><a href="#product_details" class="btn btn-primary">View Details</a></p>
	            </div>

	          </div>
	        </div>
	      </div>
	    </div>
    </section>

    <section class="ftco-section">
			<div class="container">
				<div class="row no-gutters ftco-services">
          <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services mb-md-0 mb-4">
              <div class="icon bg-color-1 active d-flex justify-content-center align-items-center mb-2">
            		<span class="flaticon-shipped"></span>
              </div>
              <div class="media-body">
                <h3 class="heading">Free Shipping</h3>
                <span>On order over ₹ 1000</span>
              </div>
            </div>      
          </div>
          <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services mb-md-0 mb-4">
              <div class="icon bg-color-2 d-flex justify-content-center align-items-center mb-2">
            		<span class="flaticon-diet"></span>
              </div>
              <div class="media-body">
                <h3 class="heading">Always Fresh</h3>
                <span>Product well package</span>
              </div>
            </div>    
          </div>
          <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services mb-md-0 mb-4">
              <div class="icon bg-color-3 d-flex justify-content-center align-items-center mb-2">
            		<span class="flaticon-award"></span>
              </div>
              <div class="media-body">
                <h3 class="heading">Superior Quality</h3>
                <span>Quality Products</span>
              </div>
            </div>      
          </div>
          <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services mb-md-0 mb-4">
              <div class="icon bg-color-4 d-flex justify-content-center align-items-center mb-2">
            		<span class="flaticon-customer-service"></span>
              </div>
              <div class="media-body">
                <h3 class="heading">Support</h3>
                <span>24/7 Support</span>
              </div>
            </div>      
          </div>
        </div>
			</div>
		</section>

		<section class="ftco-section ftco-category ftco-no-pt">
			<div class="container">
				<div class="row">
					<div class="col-md-8">
						<div class="row">
							<div class="col-md-6 order-md-last align-items-stretch d-flex">
								<div class="category-wrap-2 ftco-animate img align-self-stretch d-flex" style="background-image: url(images/category.jpg);">
									<div class="text text-center">
										<h2>Vegetables</h2>
										<p>Protect the health of every home</p>
										<p><a href="#" class="btn btn-primary">Shop now</a></p>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="category-wrap ftco-animate img mb-4 d-flex align-items-end" style="background-image: url(images/category-1.jpg);">
									<div class="text px-3 py-1">
										<h2 class="mb-0"><a href="#">Fruits</a></h2>
									</div>
								</div>
								<div class="category-wrap ftco-animate img d-flex align-items-end" style="background-image: url(images/category-2.jpg);">
									<div class="text px-3 py-1">
										<h2 class="mb-0"><a href="#">Vegetables</a></h2>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-4">
						<div class="category-wrap ftco-animate img mb-4 d-flex align-items-end" style="background-image: url(images/category-3.jpg);">
							<div class="text px-3 py-1">
								<h2 class="mb-0"><a href="#">Juices</a></h2>
							</div>		
						</div>
						<div class="category-wrap ftco-animate img d-flex align-items-end" style="background-image: url(images/category-4.jpg);">
							<div class="text px-3 py-1">
								<h2 class="mb-0"><a href="#">Dried</a></h2>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

    <section class="ftco-section" id="product_details">
    	<div class="container">
				<div class="row justify-content-center mb-3 pb-3" >
          <div class="col-md-12 heading-section text-center ftco-animate">
          	<span class="subheading">Featured Products</span>
            <h2 class="mb-4">Our Products</h2>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p>
          </div>
        </div>   		
    	</div>
    	<div class="container">
    		<div class="row">
    			<?php 
		    	  
		    	  $sql = "SELECT * FROM `wb_store_front_products` WHERE `front_type`='Featured Products' ";
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
		             $productid = $key['puic'];
		             $sql = "SELECT * FROM wb_product_catalogs WHERE product_id = '$productid' AND status='Live'";
		    		     $run = mysqli_query($con, $sql);
		    		     $data=mysqli_fetch_assoc($run);
		    		     $mrp = $data['max_price'];
		             $min = $data['min_price'];
		             $discount = $mrp-$min;
		             $dis_pre =  number_format($discount/$mrp*100,2);
		          	 ?>
		          	 <div class="col-md-4 col-lg-3 ftco-animate">
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
                 $sql = "SELECT * FROM wb_product_catalogs WHERE  status='Live' limit 8";
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
				            	 <div class="col-md-4 col-lg-3 ftco-animate">
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
		<?php 
		    	  
  	  $sql = "SELECT * FROM `wb_store_front_products` WHERE `front_type`='Deal of the Day' limit 1";
  	  $run = mysqli_query($con, $sql);
  	  $row = mysqli_num_rows($run);
  	  if ($row > 0) 
  	  {
  	  	  $data=mysqli_fetch_assoc($run);
  	  	  $productid=$data['puic'];

  	  	  $sql = "SELECT * FROM wb_product_catalogs WHERE product_id = '$productid' AND status='Live'";
			    $run = mysqli_query($con, $sql);
			    $data=mysqli_fetch_assoc($run);
  	  }else
  	  {
  	  	  $sql = "SELECT * FROM wb_product_catalogs WHERE status='Live' order by stock_quantity desc limit 1";
			    $run = mysqli_query($con, $sql);
			    $data=mysqli_fetch_assoc($run);
  	  }
  	  $date = "21 December 2019 9:56:00 GMT+01:00";
		?>
		<section class="ftco-section img" style="background-image: url(images/bg_3.jpg);">
    	<div class="container">
				<div class="row justify-content-end">
          <div class="col-md-6 heading-section ftco-animate deal-of-the-day ftco-animate">
          	<span class="subheading">Best Price For You</span>
            <h2 class="mb-4">Deal of the day</h2>
            <p>Get the best deal of the day, The best offer for you to get the best discount given for the limited period.</p>
            <h3><a href="#"><?=$data['product_name']?></a></h3>
            <span class="price">₹<?=$data['max_price']?> <a href="#">now ₹<?=$data['min_price']?> only</a></span>
            <div id="timer" class="d-flex mt-5">
						  <div class="time" id="day"></div>
						  <div class="time pl-3" id="hour"></div>
						  <div class="time pl-3" id="minute"></div>
						  <div class="time pl-3" id="second"></div>
						</div>
          </div>
        </div>   		
    	</div>
    </section>

    <section class="ftco-section testimony-section">
      <div class="container-fluid">
        <div class="row justify-content-center mb-5 pb-3">
          <div class="col-md-7 heading-section ftco-animate text-center">
          	<span class="subheading">New Arriavals</span>
            <h2 class="mb-4">Our Fresh Stock</h2>
          </div>
        </div>
        <div class="row ftco-animate">
          <div class="col-md-12">
            <div class="carousel-testimony owl-carousel ">
            	<?php 
		    	  
			    	  $sql = "SELECT * FROM `wb_store_front_products` WHERE `front_type`='New Arriavals' ";
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
			             $productid = $key['puic'];
			             $sql = "SELECT * FROM wb_product_catalogs WHERE product_id = '$productid' AND status='Live'";
			    		     $run = mysqli_query($con, $sql);
			    		     $data=mysqli_fetch_assoc($run);
			    		     $mrp = $data['max_price'];
			             $min = $data['min_price'];
			             $discount = $mrp-$min;
			             $dis_pre =  number_format($discount/$mrp*100,2);
			          	 ?>
			          	 <div class=" ftco-animate">
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
	                 $sql = "SELECT * FROM wb_product_catalogs WHERE  status='Live' limit 10";
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
					            	 <div class="">
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
			    	  }
			    	?>
            </div>
          </div>
        </div>
      </div>
    </section>

   <!--  <hr> -->

		<!-- <section class="ftco-section ftco-partner">
    	<div class="container">
    		<div class="row">
    			<div class="col-sm ftco-animate">
    				<a href="#" class="partner"><img src="images/partner-1.png" class="img-fluid" alt="Colorlib Template"></a>
    			</div>
    			<div class="col-sm ftco-animate">
    				<a href="#" class="partner"><img src="images/partner-2.png" class="img-fluid" alt="Colorlib Template"></a>
    			</div>
    			<div class="col-sm ftco-animate">
    				<a href="#" class="partner"><img src="images/partner-3.png" class="img-fluid" alt="Colorlib Template"></a>
    			</div>
    			<div class="col-sm ftco-animate">
    				<a href="#" class="partner"><img src="images/partner-4.png" class="img-fluid" alt="Colorlib Template"></a>
    			</div>
    			<div class="col-sm ftco-animate">
    				<a href="#" class="partner"><img src="images/partner-5.png" class="img-fluid" alt="Colorlib Template"></a>
    			</div>
    		</div>
    	</div>
    </section> -->

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

		var date;
		var day = document.getElementById('day');
		var hour = document.getElementById('hour'); 
		var minute = document.getElementById('minute'); 
		var second = document.getElementById('second'); 
		setInterval(function(){ 
		    date = new Date();
		    var currenthours = date.getHours();
		    var hours;
		    var minutes;
		    var secondes;
		    if (currenthours != 0){
		        if (currenthours <= 23)
		            hours = 24 - currenthours;
		        else hours = 24 + (23 - currenthours);
		        minutes = 60 - date.getMinutes();
		        secondes = 60 - date.getSeconds();

		    day.innerHTML = "0"  + "<span>Days</span>";    
		    hour.innerHTML = hours  + "<span>Hours</span>";
		    minute.innerHTML =  minutes  + "<span>Minutes</span>";
		    second.innerHTML = secondes  + "<span>Seconds</span>";
		    }
		    
		},1000);

</script>    
</body>
</html>