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

if (isset($_GET['active']) && !empty($_GET['active'])) {
    
    $id = $_GET['active'];
    $sql = "UPDATE `wb_category` SET `status`='Active' WHERE `id`='$id'";
    $run = mysqli_query($con, $sql);
    header('location:create_category.php');
}
elseif (isset($_GET['deactive']) && !empty($_GET['deactive'])) {
    
    $id = $_GET['deactive'];
    $sql = "UPDATE `wb_category` SET `status`='Deactive' WHERE `id`='$id'";
    $run = mysqli_query($con, $sql);
    header('location:create_category.php');
}
elseif (isset($_GET['delete']) && !empty($_GET['delete'])) {
    
    $id = $_GET['delete'];
    $sql = "DELETE FROM wb_category WHERE `id`='$id'";
    $run = mysqli_query($con, $sql);
    header('location:create_category.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Ecommerece" name="author" />
    <title>Create Category | Estore </title>
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
                        <div class="col-6 p-3"><h4 class="text-muted">New Category Creation</h4></div>
                        <div class="col-6 p-3"><button  class="m-aut0 btn btn-primary float-end" id="addcat">Add New Category</button></div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="cat_table">
                    <table class="table table-centered mb-0 text-center" id="basic-datatable">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Category Name</th>
                                <th>Action</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php
                           
                           $sql= "SELECT * FROM wb_category";
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
                                        <td><?php echo $data['category'] ?></td>
                                        <td>
                                          <?php 
                                            if ($data['status']=='Active') {
                                                ?><a href="create_category.php?deactive=<?php echo $data['id']?>" class="btn btn-success btn-sm">Active</a><?php
                                            }else{
                                                ?><a href="create_category.php?active=<?php echo $data['id']?>" class="btn btn-danger btn-sm">Deactive</a><?php 
                                            }
                                          ?>
                                            
                                        </td>
                                        <td class="table-action">
                                            <a href="edit_category.php?edit=<?php echo $data['id']?>" class="btn btn-primary btn-sm">Edit</a> 
                                             
                                            <a href="create_category.php?delete=<?php echo $data['id']?>" class="btn btn-info btn-sm">Delete</a>
                                        </td>
                                    </tr>
                                   <?php
                               }
                               
                           }
                          ?>  
                            
                        </tbody>
                    </table>
                    </div>
                    <form action="create_category.php" method="post"  id="addform" style="display:none;">
                        <div class="row g-2">
                            <div class="mb-3 col-md-6">
                                <label for="inputEmail1" class="form-label">Category Name</label>
                                <input type="text" class="form-control" id="inputEmail1" placeholder="Enter Category Name" name="category" required>
                            </div>
                           
                        </div>
                        
                        <div class="row g-2">
                            <div class="mb-3 col-md-6">
                                <button type="submit" class="btn btn-primary float-end" name="submit">Create Category</button>
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
     $('#addcat').click(function(){
       $('#cat_table').hide();
       $('#addform').show(); 
     })
    });
</script>
</body>
</html>
<?php 

if (isset($_POST['submit'])) {

    $category =mysqli_real_escape_string($con, $_POST['category']);
  
    $sql = "SELECT * FROM wb_category WHERE category = '$category'";
    $run = mysqli_query ($con, $sql);
    $row = mysqli_num_rows($run);
    if ($row > 0) 
    {
        ?>
         <script type="text/javascript">
             swal('Existed!','This category is already registered !','error')
                 .then(function(){
              window.location = "create_category.php";  
              });
         </script>
         <?php
    }
    else
    {

        $sql = "INSERT INTO `wb_category`(`category`) VALUES ('$category')";
        $run = mysqli_query($con,$sql);
        if ($run) 
        {
             ?>
             <script type="text/javascript">
                 swal('Created!','Category has been created Successfully !','success')
                     .then(function(){
                  window.location = "create_category.php";  
                  });
             </script>
             <?php
             
        }
    }
   
    
}


?>