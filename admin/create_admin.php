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

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Ecommerece" name="author" />
    <title>Dashboard | Estore - Create Admin</title>
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
                        <li class="breadcrumb-item active">Create Admin</li>
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
                        <div class="col-6 p-3"><h4 class="text-muted">New Admin Creation</h4></div>
                        <div class="col-6 p-3"><a href="view_all_admin.php" class="m-aut0 btn btn-primary float-end">View All Admins</a></div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="create_admin.php" method="post" enctype="multipart/form-data">
                        <div class="row g-2">
                            <div class="mb-3 col-md-6">
                                <label for="inputEmail1" class="form-label">Admin Name</label>
                                <input type="text" class="form-control" id="inputEmail1" placeholder="Enter Admin Name" name="name" required>
                            </div>
                           
                        </div>
                        <div class="row g-2">
                            <div class="mb-3 col-md-6">
                                <label for="inputEmail2" class="form-label">Admin Email</label>
                                <input type="email" class="form-control" id="inputEmail2" placeholder="Enter Admin Email" name="email" required>
                            </div>
                           
                        </div>
                        <div class="row g-2">
                            <div class="mb-3 col-md-6">
                                <label for="inputEmail3" class="form-label">Password</label>
                                <input type="password" class="form-control" id="inputEmail3" placeholder="Enter Password" name="password" required>
                            </div>
                           
                        </div>
                        <div class="row g-2">
                            <div class="mb-3 col-md-6">
                                <label for="inputEmail4" class="form-label">Admin Image</label>
                                <input type="file" class="form-control" id="inputEmail4" placeholder="Select Image" name="admin_image">
                            </div>
                           
                        </div>
                        <div class="row g-2">
                            <div class="mb-3 col-md-6">
                                <button type="submit" class="btn btn-primary float-end" name="submit">Create Admin</button>
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
</body>
</html>
<?php 
include('function.php');

if (isset($_POST['submit'])) {

    $username =mysqli_real_escape_string($con, $_POST['name']);
    $email =mysqli_real_escape_string($con, $_POST['email']);
    $password =mysqli_real_escape_string($con, $_POST['password']);
    $image = $_FILES['admin_image']['name'];
    $tempimage = $_FILES['admin_image']['tmp_name'];
    $allowType = array('png','jpg','jpeg');
    $ext = pathinfo($image, PATHINFO_EXTENSION);
    if (!in_array($ext, $allowType)) {

        ?>
          <script type="text/javascript">
              swal('Checkout!','Only png, jpg, jpeg file formats are allowed','warning')
              .then(function(){
              window.location = "create_admin.php";  
              });
          </script>
        <?php
        
    }
    else
    {
        $sql = "SELECT * FROM wb_admin WHERE email = '$email'";
        $run = mysqli_query ($con, $sql);
        $row = mysqli_num_rows($run);
        if ($row > 0) 
        {
            ?>
             <script type="text/javascript">
                 swal('Existed!','This email is already registered !','error')
                     .then(function(){
                  window.location = "create_admin.php";  
                  });
             </script>
             <?php
        }
        else
        {
            move_uploaded_file($tempimage, 'assets/images/users/'.$image);

            $sql = "INSERT INTO `wb_admin`(`username`, `password`, `email`, `admin_image`) VALUES ('$username','$password','$email','$image')";
            $run = mysqli_query($con,$sql);
            if ($run) 
            {
                 
                 ?>
                 <script type="text/javascript">
                     swal('Created!','Admin User has been created Successfully !','success')
                         .then(function(){
                      window.location = "create_admin.php";  
                      });
                 </script>
                 <?php
                 
            }
        }
        
    }
   
    
}


?>