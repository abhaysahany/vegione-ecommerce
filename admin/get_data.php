<?php 
include('dbcon.php');
if (isset($_POST['cat_id'])) {

	$cat_id = $_POST['cat_id'];

	$sql = "SELECT * FROM wb_product_catalogs WHERE category_id = '$cat_id'";
	$run = mysqli_query($con, $sql);
	$row = mysqli_num_rows($run);
	if ($row > 0) 
	{
		?>
		<option>Select Product</option>
		<?php
		while ($data=mysqli_fetch_assoc($run)) {
			
			?>
			<option value="<?php echo $data['product_id'] ?>"><?php echo $data['product_name'] ?></option>
			<?php
		}
	}else{
	        ?>
			<option value="">No Product Listed</option>
			<?php	
	}
}


if (isset($_POST['cat_id_upload'])) {

	$category_id = $_POST['cat_id_upload'];
	
	$sql = "SELECT * FROM wb_product_catalogs WHERE category_id = '$category_id' AND (`brand`='' OR `product_image`='')";
	$run = mysqli_query($con, $sql);
	$row = mysqli_num_rows($run);
	if ($row > 0) 
	{
		
		while ($data=mysqli_fetch_assoc($run)) 
		{
			
			?>
			<option value="product_listing.php?product_id=<?php echo $data['product_id'] ?>"><?php echo $data['product_name'] ?></option>
			<?php
		}
	}else{
	        ?>
			<option value="">No Product created for this category. </option>
			<?php	
	}
}


?>