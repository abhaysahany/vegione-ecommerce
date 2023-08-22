<?php  
include('dbcon.php');
include('function.php');

if (isset($_SESSION['USER_ADMIN'])) {
    
    $id = $_SESSION['USER_ADMIN'];

}elseif (isset($_COOKIE['USER_ADMIN'])) {

    $id = $_COOKIE['USER_ADMIN'];

}else{

    header('location:index.php');
}

if ($id!='') {

    $sql = "SELECT * FROM wb_admin WHERE id = '$id'";
    $run = mysqli_query($con,$sql);
    $data = mysqli_fetch_assoc($run);
    $type = $data['type'];
}

if (isset($_GET['edit']) && !empty($_GET['edit'])) {
    
    $_SESSION['edit_pro'] = $_GET['edit'];
    $sql = "SELECT * FROM `wb_product_catalogs` WHERE `id`='$id'";
    $run = mysqli_query($con, $sql);
    $cat = mysqli_fetch_assoc($run);
}

$sql = "SELECT * FROM `wb_category` WHERE `status` = 'Active'";
$run = mysqli_query($con, $sql);
$row = mysqli_num_rows($run);
if ($row > 0) 
{
    $option='';
    while ($data=mysqli_fetch_assoc($run)) 
    {

        $option .="<option value=".$data['id'].">".$data['category']."</option>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Ecommerece" name="author" />
    <title>Edit Product | Estore </title>
<?php include('header.php'); ?>                
<!-- Start Content-->
<div class="container-fluid">

 
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="dashboard.php">Admin</a></li>
                        <li class="breadcrumb-item"><a href="create_product.php">Create Product</a></li>
                        <li class="breadcrumb-item active">Edit Product</li>
                    </ol>
                </div>
                <h4 class="page-title">Dashboard</h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 
    <!-- Form row -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header p-0 m-0">
                    <div class="row justify-content-between m-0">
                        <div class="col-6 p-3"><h4 class="text-muted">Edit Product </h4></div>
                        <div class="col-6 p-3"><a href="create_product.php"  class="m-aut0 btn btn-primary float-end" >Back</a></div>
                    </div>
                </div>
                <div class="card-body">
                    <?php   
                       if (isset($_SESSION['edit_pro']) && !empty($_SESSION['edit_pro'])) {
    
                            $id = $_SESSION['edit_pro'];
                            $sql = "SELECT * FROM `wb_product_catalogs` WHERE `id`='$id'";
                            $run = mysqli_query($con, $sql);
                            $pro = mysqli_fetch_assoc($run);
                            $category_id=$pro['category_id'];
                            $category = getCatName($category_id, $con);

                            ?>
                            <form action="edit_product.php" method="post"  id="addform" >
                                <div class="row g-2">
                                    <div class="mb-3 col-md-6">
                                        <label for="inputEmail1" class="form-label">Category Name</label>
                                        <select class="form-select" name="category" required>
                                            <option value="<?php echo $category_id ?>"><?php echo $category ?></option>
                                            <?php echo $option; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row g-2">
                                    <div class="mb-3 col-md-6">
                                        <label for="inputEmail1" class="form-label">Product Name</label>
                                        <input type="text" class="form-control" id="inputEmail1" value="<?php echo $pro['product_name'] ?>" name="product" required>
                                    </div>
                                   
                                </div>
                                
                                <div class="row g-2">
                                    <div class="mb-3 col-md-6">
                                        <input type="hidden" value="<?php echo $pro['id'] ?>" name="id" >
                                        <button type="submit" class="btn btn-primary float-end" name="submit">Edit Product</button>
                                    </div>
                                </div>
                                
                            </form> 
                            <?php 
                        }  

                    ?>
                    
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
    <!-- end row -->
    

</div>
<!-- container -->
</div>
<!-- content -->
<?php include('footer.php'); ?>
</body>
</html>
<?php 

if (isset($_POST['submit'])) {

    $category =mysqli_real_escape_string($con, $_POST['category']);
    $product =mysqli_real_escape_string($con, $_POST['product']);
    $id =mysqli_real_escape_string($con, $_POST['id']);
  
    $sql = "UPDATE wb_product_catalogs SET `category_id`='$category', `product_name`='$product' WHERE id = '$id'";
    $run = mysqli_query ($con, $sql);
    if ($run > 0) 
    {
        ?>
         <script type="text/javascript">
             swal('Updated!','Product has been updated Successfully !','success')
                 .then(function(){
              window.location = "edit_product.php";  
              });
         </script>
         <?php
    }
   
    
}


?>