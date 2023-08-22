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


elseif (isset($_GET['delete']) && !empty($_GET['delete'])) {
    
    $id = $_GET['delete'];
    $sql = "DELETE FROM wb_product_catalogs WHERE `id`='$id'";
    $run = mysqli_query($con, $sql);
    header('location:create_product.php');
}

$sql = "SELECT * FROM `wb_category` WHERE `status` = 'Active' ";
$run = mysqli_query($con, $sql);
$row = mysqli_num_rows($run);
if ($row > 0) 
{
    $option = "<option>Select Category</option>";
    while ($data_c=mysqli_fetch_assoc($run)) 
    {

        $option .="<option value=".$data_c['category'].">".$data_c['category']."</option>";
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
    <title>Create Product | Estore </title>
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
                        <li class="breadcrumb-item active">Create Product</li>
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
                        <div class="col-6 p-3"><h4 class="text-muted">New Product Creation</h4></div>
                        <div class="col-6 p-3"><button  class="m-aut0 btn btn-primary float-end" id="addpro">Add New Product</button></div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="pro_table">
                    <table class="table table-centered mb-0 text-center" id="basic-datatable">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Category Name</th>
                                <th>Product Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php
                           
                           $sql= "SELECT * FROM wb_product_catalogs ";
                           $run = mysqli_query($con, $sql);
                           $row = mysqli_num_rows($run);
                           if ($row > 0) 
                           {
                               $i=0;
                               while ($data=mysqli_fetch_assoc($run)) 
                               {
                                   $i++;
                                   ?>
                                   <tr>
                                        <td><?php echo $i ?></td>
                                        <td><?php $category_id=$data['category_id'];
                                             echo getCatName($category_id, $con)
                                         ?></td>
                                        <td><?php echo $data['product_name'] ?></td>
                                        <td class="table-action">
                                            <a href="edit_product.php?edit=<?php echo $data['id']?>" class="btn btn-primary btn-sm">Edit</a> 
                                             
                                        </td>
                                    </tr>
                                   <?php
                               }
                               
                           }
                          ?>  
                            
                        </tbody>
                    </table>
                    </div>
                    <form action="create_product.php" method="post"  id="addform" style="display:none;">
                        <div class="row g-2">
                            <div class="mb-3 col-md-6">
                                <label for="inputEmail1" class="form-label">Category Name</label>
                                <select class="form-select" name="category" required>
                                    <?php echo $option; ?>
                                </select>
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="mb-3 col-md-6">
                                <label for="inputEmail1" class="form-label">Product Name</label>
                                <input type="text" class="form-control" id="inputEmail1" placeholder="Enter Product Name" name="product" required>
                            </div>
                        </div>
                        
                        <div class="row g-2">
                            <div class="mb-3 col-md-6">
                                <button type="submit" class="btn btn-primary float-end" name="submit">Create Product</button>
                            </div>
                        </div>
                        
                    </form> 
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
<script type="text/javascript">
    $(document).ready(function(){
     $('#addpro').click(function(){
       $('#pro_table').hide();
       $('#addform').show(); 
     })
    });
</script>
</body>
</html>
<?php 


if (isset($_POST['submit'])) {

    $category = mysqli_real_escape_string($con, $_POST['category']);
    $product = mysqli_real_escape_string($con, $_POST['product']);
    $cat_id = getCatId($category,$con);
    $puic = puic();
  
    $sql = "SELECT * FROM wb_product_catalogs WHERE product_name = '$product' AND `category_id`='$cat_id'";
    $run = mysqli_query ($con, $sql);
    $row = mysqli_num_rows($run);
    if ($row > 0) 
    {
        ?>
         <script type="text/javascript">
             swal('Existed!','This product is already registered !','error')
                 .then(function(){
              window.location = "create_product.php";  
              });
         </script>
         <?php
    }
    else
    {

        $sql = "INSERT INTO `wb_product_catalogs`(`product_id`, `product_name`, `category_id`) VALUES ('$puic','$product','$cat_id')";
        $run = mysqli_query($con,$sql);
        if ($run) 
        {
             ?>
             <script type="text/javascript">
                 swal('Created!','Product has been created Successfully !','success')
                     .then(function(){
                  window.location = "create_product.php";  
                  });
             </script>
             <?php
             
        }
    }
   
    
}


?>