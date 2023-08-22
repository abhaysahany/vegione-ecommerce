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
                        <li class="breadcrumb-item active">Admin Details / Edit</li>
                    </ol>
                </div>
                <h4 class="page-title">Dashboard</h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 
    <div class="row">
        <div class="col-sm-12">
            <!-- Profile -->
            <div class="card bg-primary">
                <div class="card-body profile-user-box">
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <div class="avatar-lg">
                                        <img src="assets/images/users/<?php echo $data['admin_image'] ?>" alt="" class="rounded-circle img-thumbnail">
                                    </div>
                                </div>
                                <div class="col">
                                    <div>
                                        <h4 class="mt-1 mb-1 text-white"><?php echo $data['username'] ?></h4>
                                        <p class="font-13 text-white-50"> Authorised Admin</p>

                                        <ul class="mb-0 list-inline text-light">
                                            <li class="list-inline-item me-3">
                                                <h5 class="mb-1">Email</h5>
                                                <p class="mb-0 font-13 text-white-50"><?php echo $data['email'] ?></p>
                                            </li>
                                            <li class="list-inline-item">
                                                <h5 class="mb-1">Status</h5>
                                                <p class="mb-0 font-13 text-white-50"><?php echo $data['status'] ?></p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end col-->

                        <div class="col-sm-4">
                            <div class="text-center mt-sm-0 mt-3 text-sm-end">
                                <button type="button" class="btn btn-light" id="profile">
                                    <i class="mdi mdi-account-edit me-1"></i> Edit Profile
                                </button>
                            </div>
                        </div> <!-- end col-->
                    </div> <!-- end row -->

                </div> <!-- end card-body/ profile-user-box-->
            </div><!--end profile/ card -->
        </div> <!-- end col-->
    </div>
    <!-- end row -->
    <!-- Form row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card" id="details" style="display: none;">
                <div class="card-header p-0 m-0">
                    <div class="row justify-content-between m-0">
                        <div class="col-12 p-3"><h4 class="text-muted">Edit Admin Details</h4></div>
                        
                    </div>
                </div>
                <div class="card-body" >
				    <form action="admin_details.php" method="post" enctype="multipart/form-data">
                        <div class="row g-2">
                            <div class="mb-3 col-md-6">
                                <label for="inputEmail1" class="form-label">Admin Name</label>
                                <input type="text" class="form-control" id="inputEmail1" name="name" value="<?php echo $data['username'] ?>">
                            </div>
                           
                        </div>
                        <div class="row g-2">
                            <div class="mb-3 col-md-6">
                                <label for="inputEmail2" class="form-label">Admin Email</label>
                                <input type="email" class="form-control" id="inputEmail2" value="<?php echo $data['email'] ?>" name="email">
                            </div>
                           
                        </div>
                        <div class="row g-2">
                            <div class="mb-3 col-md-6">
                                <label for="inputEmail3" class="form-label">Password</label>
                                <input type="password" class="form-control" id="inputEmail3" value="<?php echo $data['password'] ?>" name="password" >
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
                            	<input type="hidden" name="admin_id" value="<?php echo $data['id'] ?>" >
                                <button type="submit" class="btn btn-primary float-end" name="submit">Edit Admin</button>
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
      $('#profile').click(function(){
        $('#details').toggle();
      });
    });
</script>
</body>
</html>
<?php 

if (isset($_POST['submit'])) {

    $admin_id=$_POST['admin_id'];
    $username =mysqli_real_escape_string($con, $_POST['name']);
    $email =mysqli_real_escape_string($con, $_POST['email']);
    $password =mysqli_real_escape_string($con, $_POST['password']);
    $image = $_FILES['admin_image']['name'];
	$tempimage = $_FILES['admin_image']['tmp_name'];
	
    if ($image == '') 
    {
        $sql = "SELECT * FROM wb_admin WHERE email = '$email' AND id !='$admin_id'";
        $run = mysqli_query ($con, $sql);
        $row = mysqli_num_rows($run);
        if ($row > 0) 
        {
            ?>
             <script type="text/javascript">
                 swal('Existed!','This email is already registered !','error')
                     .then(function(){
                  window.location = "admin_details.php";  
                  });
             </script>
             <?php
        }else{

            $sql = "UPDATE `wb_admin` SET `username`='$username',`password`='$password',`email`='$email' WHERE `id`='$admin_id'";
            $run = mysqli_query($con,$sql);
            if ($run) 
            {
                 ?>
                 <script type="text/javascript">
                     swal('Updated!','Admin User has been updated Successfully !','success')
                         .then(function(){
                      window.location = "admin_details.php";  
                      });
                 </script>
                 <?php
                 
            }
        }
	    
    }
    else{

    	
	    $allowType = array('png','jpg','jpeg');
	    $ext = pathinfo($image, PATHINFO_EXTENSION);
	    if (!in_array($ext, $allowType)) {

	        ?>
	          <script type="text/javascript">
	              swal('Checkout!','Only png, jpg, jpeg file formats are allowed','warning')
	              .then(function(){
	              window.location = "admin_details.php";  
	              });
	          </script>
	        <?php
	        
	    }
	    else
	    {
	        $sql = "SELECT * FROM wb_admin WHERE email = '$email' AND id !='$admin_id'";
	        $run = mysqli_query ($con, $sql);
	        $row = mysqli_num_rows($run);
	        if ($row > 0) 
	        {
	            ?>
	             <script type="text/javascript">
	                 swal('Existed!','This email is already registered !','error')
	                     .then(function(){
	                  window.location = "admin_details.php";  
	                  });
	             </script>
	             <?php
	        }
	        else
	        {
	            move_uploaded_file($tempimage, 'assets/images/users/'.$image);

	            $sql = "UPDATE `wb_admin` SET `username`='$username',`password`='$password',`email`='$email',`admin_image`='$image' WHERE `id`='$admin_id'";
	            $run = mysqli_query($con,$sql);
	            if ($run) 
	            {
	                 ?>
	                 <script type="text/javascript">
	                     swal('Updated!','Admin User has been updated Successfully !','success')
	                         .then(function(){
	                      window.location = "admin_details.php";  
	                      });
	                 </script>
	                 <?php
	                 
	            }
	        }
	        
	    }
    }
    
   
    
}


?>