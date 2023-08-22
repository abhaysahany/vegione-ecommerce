<?php  
include('admin/dbcon.php');
include('admin/function.php');
include('insert_cart.php');

if (isset($_GET['category_id']) && !empty($_GET['category_id'])) {

	$_SESSION['shop_category'] = mysqli_real_escape_string($con, $_GET['category_id']);
	$category_id=$_SESSION['shop_category'];
  $category_name=getCatName($category_id, $con);
}
?>
<!DOCTYPE html>
<html lang="en">
  
<meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
    <title>Category - Vegione</title>
<?php include('header.php') ?>    

    <div class="hero-wrap hero-bread" style="background-image: url('images/bg_1.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Products</span></p>
            <h1 class="mb-0 bread">Products</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section">
    	<div class="container">
    		<div class="row justify-content-center">
    			<div class="col-md-10 mb-5 text-center">
    				<ul class="product-category">
    					<li><a href="#" class="active"><?=$category_name ?></a></li>
    				</ul>
    			</div>
    		</div>
    		<div class="row">
    		<?php 
    		 $sql = "SELECT * FROM wb_product_catalogs WHERE category_id = '$category_id' AND status='Live'";
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
    		?>	
    			
    			
    		</div>
    		<!-- <div class="row mt-5">
          <div class="col text-center">
            <div class="block-27">
              <ul>
                <li><a href="#">&lt;</a></li>
                <li class="active"><span>1</span></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#">&gt;</a></li>
              </ul>
            </div>
          </div>
        </div> -->
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
</body>
</html>