<?php  
include('dbcon.php');

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
    
    $_SESSION['edit_cat'] = $_GET['edit'];
    $sql = "SELECT * FROM `wb_category` WHERE `id`='$id'";
    $run = mysqli_query($con, $sql);
    $cat = mysqli_fetch_assoc($run);
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Ecommerece" name="author" />
    <title>Edit Category | Estore </title>
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
                        <li class="breadcrumb-item active">Create Category</li>
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
                        <div class="col-6 p-3"><h4 class="text-muted">Edit Category </h4></div>
                        <div class="col-6 p-3"><a href="create_category.php"  class="m-aut0 btn btn-primary float-end" >Back</a></div>
                    </div>
                </div>
                <div class="card-body">
                    <?php   
                       if (isset($_SESSION['edit_cat']) && !empty($_SESSION['edit_cat'])) {
    
                            $id = $_SESSION['edit_cat'];
                            $sql = "SELECT * FROM `wb_category` WHERE `id`='$id'";
                            $run = mysqli_query($con, $sql);
                            $cat = mysqli_fetch_assoc($run);

                            ?>
                            <form action="edit_category.php" method="post"  id="addform" >
                                <div class="row g-2">
                                    <div class="mb-3 col-md-6">
                                        <label for="inputEmail1" class="form-label">Category Name</label>
                                        <input type="text" class="form-control" id="inputEmail1" value="<?php echo $cat['category'] ?>" name="category" required>
                                    </div>
                                   
                                </div>
                                
                                <div class="row g-2">
                                    <div class="mb-3 col-md-6">
                                        <input type="hidden" value="<?php echo $cat['id'] ?>" name="id" >
                                        <button type="submit" class="btn btn-primary float-end" name="submit">Edit Category</button>
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
    $id =mysqli_real_escape_string($con, $_POST['id']);
  
    $sql = "UPDATE wb_category SET `category`='$category' WHERE id = '$id'";
    $run = mysqli_query ($con, $sql);

    $sql = "UPDATE wb_products SET `category`='$category' WHERE category_id = '$id'";
    $run = mysqli_query ($con, $sql);

    if ($run ) 
    {
        ?>
         <script type="text/javascript">
             swal('Updated!','Category has been updated Successfully !','success')
                 .then(function(){
              window.location = "edit_category.php";  
              });
         </script>
         <?php
    }
   
    
}


?>