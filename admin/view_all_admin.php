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
    $sql = "UPDATE `wb_admin` SET `status`='Active' WHERE `id`='$id'";
    $run = mysqli_query($con, $sql);
    header('location:view_all_admin.php');
}
elseif (isset($_GET['deactive']) && !empty($_GET['deactive'])) {
    
    $id = $_GET['deactive'];
    $sql = "UPDATE `wb_admin` SET `status`='Deactive' WHERE `id`='$id'";
    $run = mysqli_query($con, $sql);
    header('location:view_all_admin.php');
}
elseif (isset($_GET['delete']) && !empty($_GET['delete'])) {
    
    $id = $_GET['delete'];
    $sql = "DELETE FROM wb_admin WHERE `id`='$id'";
    $run = mysqli_query($con, $sql);
    header('location:view_all_admin.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Ecommerece" name="author" />
    <title>Dashboard | Estore - Admin Details</title>
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
                        <li class="breadcrumb-item active">View All Admin</li>
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
                        <div class="col-6 p-3"><h4 class="text-muted">Admin Table</h4></div>
                        <div class="col-6 p-3"><a href="create_admin.php" class="m-aut0 btn btn-primary float-end"><i class=" uil-left-arrow-to-left"></i> Back</a></div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-centered mb-0 text-center">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Image</th>
                                <th>Admin Name</th>
                                <th>Id</th>
                                <th>Email</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php
                           
                           $sql= "SELECT * FROM wb_admin";
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
                                        <td class="p-0"><img src="assets/images/users/<?php echo $data['admin_image'] ?>" width="50" height="50"></td>
                                        <td><?php echo $data['username'] ?></td>
                                        <td><?php echo $data['id'] ?></td>
                                        <td><?php echo $data['email'] ?></td>
                                        <td><?php echo $data['type'] ?></td>
                                        <td>
                                          <?php 
                                            if ($data['status']=='Active') {
                                                ?><a href="view_all_admin.php?deactive=<?php echo $data['id']?>" class="btn btn-success btn-sm">Active</a><?php
                                            }else{
                                                ?><a href="view_all_admin.php?active=<?php echo $data['id']?>" class="btn btn-danger btn-sm">Deactive</a><?php 
                                            }
                                          ?>
                                            
                                        </td>
                                        <td class="table-action">
                                            <a href="edit_admin.php?edit=<?php echo $data['id']?>" class="btn btn-primary btn-sm">Edit</a> 
                                             
                                            <a href="view_all_admin.php?delete=<?php echo $data['id']?>" class="btn btn-info btn-sm">Delete</a>
                                        </td>
                                    </tr>
                                   <?php
                               }
                               
                           }
                           else
                           {
                               ?>
                               <tr>
                                    <td>There is no data to Dispaly</td>
                                    
                                </tr>
                               <?php
                           }
                          ?>  
                            
                        </tbody>
                    </table>
                                                    
                        
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

if (isset($_POST['status'])) {
    
    echo "active";
}
?>