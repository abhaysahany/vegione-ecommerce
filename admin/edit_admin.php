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
                        <li class="breadcrumb-item"><a href="view_all_admin.php">View All Admin</a></li>
                        <li class="breadcrumb-item active">Edit Admin</li>
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
                        <div class="col-6 p-3"><h4 class="text-muted">Edit Admin Details</h4></div>
                        <div class="col-6 p-3"><a href="view_all_admin.php" class="m-aut0 btn btn-primary float-end"> <i class=" uil-left-arrow-to-left"></i> Back</a></div>
                    </div>
                </div>
                <div class="card-body">
                <?php 
	              if (isset($_GET['edit']) && !empty($_GET['edit'])) {
				    $id = $_GET['edit'];
				    $sql = "SELECT * FROM `wb_admin` WHERE `id`='$id'";
				    $run = mysqli_query($con, $sql);
                    $data = mysqli_fetch_assoc($run);
				    ?>
				    <form action="edit_admin.php" method="post" enctype="multipart/form-data">
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
                  window.location = "view_all_admin.php";  
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
                      window.location = "view_all_admin.php";  
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
	              window.location = "view_all_admin.php";  
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
	                  window.location = "view_all_admin.php";  
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
	                      window.location = "view_all_admin.php";  
	                      });
	                 </script>
	                 <?php
	                 
	            }
	        }
	        
	    }
    }
    
   
    
}


?>