<?php 
include('dbcon.php');
include('function.php');

##################-Key details Submission-##################

if (isset($_POST['key_details'])) 
{
	$sku = $_POST['sku'];
	$brand = $_POST['brand'];
	$model = $_POST['model'];
	$mrp = $_POST['mrp'];
	$minprice = $_POST['minprice'];
	$stock = $_POST['stock'];
	$unit = $_POST['unit'];
	$taxcheck = $_POST['taxcheck'];
	$taxrate = $_POST['taxrate'];
	$product_id = $_SESSION['product_id'];
	$category_id = getCategoryId($product_id, $con);

	$sql="SELECT * FROM wb_product_catalogs WHERE product_id ='$product_id'";
	$run = mysqli_query($con,$sql);
	$row = mysqli_num_rows($run);
	if ($row > 0) 
	{
	 	$qry="UPDATE `wb_product_catalogs` SET `sku`='$sku',`brand`='$brand',`model_no`='$model',`product_unit_class`='$unit',`min_price`='$minprice', `max_price`='$mrp', `stock_quantity`='$stock',`tax_status`='$taxcheck',`tax_class_rate`='$taxrate' WHERE `product_id`='$product_id'";
         $run = mysqli_query($con, $qry);

         ?>
         <script>
         	alert('Details inserted successfully')
         	window.location = "product_listing.php"
         </script>
         <?php
	} 
}

##################-Prodcut details Submission-##################

if (isset($_POST['pro_details'])) 
{
	$product_id = $_SESSION['product_id'];
	$category_id = getCategoryId($product_id, $con);
	$attrib = $_POST['data'];

	$sql = "SELECT * FROM wb_product_attribute_value WHERE product_id = '$product_id' ";
	$run = mysqli_query($con, $sql);
	$row = mysqli_num_rows($run);
	if ($row > 0) 
	{
		?>
         <script>
         	alert('Details are already Submitted')
         	window.location = "product_listing.php"
         </script>
         <?php
	}
	else
	{
		foreach ($attrib as $key => $value) {

		  $sql= "INSERT INTO `wb_product_attribute_value`(`product_id`, `category_id`, `attrib_name`, `attrib_value`) VALUES ('$product_id','$category_id','$key','$value')";
		  $run = mysqli_query($con, $sql);

	    }

	    ?>
         <script>
         	alert('Details inserted successfully')
         	window.location = "product_listing.php"
         </script>
         <?php
	}

	


}

##################-Prodcut details Submission-##################

if (isset($_POST['save_image'])) 
{
	
	$product_id = $_SESSION['product_id'];
	$category_id = getCategoryId($product_id, $con);
	$image = $_FILES['product_image']['name'];
    $tempimage = $_FILES['product_image']['tmp_name'];
    $allowType = array('png','jpg','jpeg');
    $ext = pathinfo($image, PATHINFO_EXTENSION);
    if (!in_array($ext, $allowType)) {

        ?>
          <script type="text/javascript">
              alert('Only png, jpg, jpeg file formats are allowed')
              window.location = "product_listing.php";  
          </script>
        <?php
        
    }
    else
    {
        $sql="SELECT * FROM wb_product_catalogs WHERE product_id ='$product_id'";
		$run = mysqli_query($con,$sql);
		$row = mysqli_num_rows($run);
		if ($row > 0) 
		{
			$location="../images/products/".$image;
            compressedImage($tempimage,$location,60);

		 	$qry="UPDATE `wb_product_catalogs` SET `product_image`='$image' WHERE `product_id`='$product_id'";
	         $run = mysqli_query($con, $qry);

	         ?>
	         <script>
	         	alert('Image inserted successfully')
	         	window.location = "product_listing.php"
	         </script>
	         <?php
		}
		
        
    }

	 
}


##################-Finiash Listing Submission-##################

if (isset($_POST['finish'])) 
{
	$ship_charge=$_POST['ship_charge'];
	$shortdes = $_POST['shortdes'];
	$description = $_POST['description'];
	$keyword = $_POST['keyword'];
	$product_id = $_SESSION['product_id'];

	$sql="SELECT * FROM wb_product_catalogs WHERE product_id ='$product_id'";
	$run = mysqli_query($con,$sql);
	$row = mysqli_num_rows($run);
	if ($row > 0) 
	{ 
	 	$qry="UPDATE `wb_product_catalogs` SET `ship_unit_rate`='$ship_charge',`short_description`='$shortdes',`description`='$description',`meta_keywords`='$keyword' WHERE `product_id`='$product_id'";
         $run = mysqli_query($con, $qry);

         ?>
         <script>
         	alert('Listing has been Finished successfully')
         	window.location = "manage_products.php"
         </script>
         <?php
	}
	else
	{

         ?>
         <script>
         	alert('Fill Key, Product and Image Details First')
         	window.location = "product_listing.php"
         </script>
         <?php
	} 
}

function compressedImage($source, $path, $quality) 
{

    $info = getimagesize($source);

    if ($info['mime'] == 'image/jpeg') 
        $image = imagecreatefromjpeg($source);

    elseif ($info['mime'] == 'image/gif') 
        $image = imagecreatefromgif($source);

    elseif ($info['mime'] == 'image/png') 
        $image = imagecreatefrompng($source);

    imagejpeg($image, $path, $quality);
}


?>