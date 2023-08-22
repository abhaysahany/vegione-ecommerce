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

$sql = "SELECT * FROM `wb_state_name`";
$run = mysqli_query($con, $sql);
$row =mysqli_num_rows($run);
if ($row > 0) {

    $option="<option>Select State</option>";
    while ($data_s=mysqli_fetch_assoc($run)) {

        $option .="<option >".$data_s['name']."</option>";
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
    <title>Store Details | Estore </title>
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
            <?php 
             
            ?>
            <div class="card">
                <div class="card-header p-0 m-0">
                    <div class="row justify-content-between m-0">
                        <div class="col-6 p-3"><h4 class="text-muted">Store Details</h4></div>
                        <!-- <div class="col-6 p-3"><a href="view_all_admin.php" class="m-aut0 btn btn-primary float-end"> Edit Store Details</a></div> -->
                    </div>
                </div>
                <div class="card-body">
                <?php 
                 $sql = "SELECT * FROM `wb_store_details`";
                 $run = mysqli_query($con, $sql);
                 $row =mysqli_num_rows($run);

                 if ($row > 0) {
                    $data=mysqli_fetch_assoc($run);
                     ?>
                     <div id="storeDetails">

                        <h4 class="mb-0 mt-2"><?=$data['display_name']?> <a href="javascript:void(0);" class="action-icon" id="editdetails"> <i class="mdi mdi-square-edit-outline"></i></a></h4>
                        <p class="text-muted font-14"><?=$data['registered_name']?></p>

                        <div class="text-start mt-3">
                            <h4 class="font-13 text-uppercase">Description:</h4>
                            <p class="text-muted font-13 mb-3"><?=$data['description']?>
                            </p>
                            <p class="text-muted mb-2 font-13"><strong>GST NO :</strong> <span class="ms-2"><?=$data['gst_no']?></span></p>
                            <p class="text-muted mb-2 font-13"><strong>Address :</strong> <span class="ms-2"><?=$data['address']?></span></p>

                            <p class="text-muted mb-2 font-13"><strong>City :</strong><span class="ms-2"><?=$data['city']?></span></p>

                            <p class="text-muted mb-2 font-13"><strong>State :</strong> <span class="ms-2 "><?=$data['state']?></span></p>

                            <p class="text-muted mb-1 font-13"><strong>Pincode :</strong> <span class="ms-2"><?=$data['pincode']?></span></p>
                        </div>

                        <ul class="social-list list-inline mt-3 mb-0">
                            <li class="list-inline-item">
                                <a href="javascript: void(0);" class="social-list-item border-primary text-primary"><i
                                        class="mdi mdi-facebook"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="javascript: void(0);" class="social-list-item border-danger text-danger"><i
                                        class="mdi mdi-google"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="javascript: void(0);" class="social-list-item border-info text-info"><i
                                        class="mdi mdi-twitter"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="javascript: void(0);" class="social-list-item border-secondary text-secondary"><i
                                        class="mdi mdi-github"></i></a>
                            </li>
                        </ul>
                    </div>
                    <form action="store_details.php" method="post" id="editForm" style="display:none">
                        <div class="row g-2">
                            <div class="mb-3 col-md-4">
                                <label for="inputEmail1" class="form-label">Dispaly Name</label>
                                <input type="text" class="form-control" id="inputEmail1" value="<?php echo $data['display_name'] ?>" name="display" required>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="inputEmail1" class="form-label">Registered Name</label>
                                <input type="text" class="form-control" id="inputEmail1" value="<?php echo $data['registered_name'] ?>" name="registered" required>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="inputEmail2" class="form-label">GST NO</label>
                                <input type="text" class="form-control" id="inputEmail2" value="<?php echo $data['gst_no'] ?>" name="gst" >
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="mb-3 col-md-12">
                                <label for="inputEmail3" class="form-label">Address</label>
                                <input type="text" class="form-control" id="inputEmail3" value="<?php echo $data['address'] ?>" name="address" required>
                            </div>
                           
                        </div>
                        <div class="row g-2">
                            <div class="mb-3 col-md-4">
                                <label for="inputEmail4" class="form-label">City</label>
                                <input type="text" class="form-control" id="inputEmail4" value="<?php echo $data['city'] ?>" name="city" required>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="inputEmail4" class="form-label">State</label>
                                <select class="form-select" name="state" required>
                                    <option><?php echo $data['state'] ?></option>
                                    <?php echo $option; ?>
                                </select>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="inputEmail4" class="form-label">Pincode</label>
                                <input type="text" class="form-control" id="inputEmail4" value="<?php echo $data['pincode'] ?>" name="pincode" autocomplete="off">
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="mb-3 col-md-12">
                                <label for="inputEmail3" class="form-label">Description</label>
                                <input type="text" class="form-control" id="inputEmail3" value="<?php echo $data['description'] ?>" name="des" required>
                            </div>
                           
                        </div>
                        <div class="row g-2">
                            <div class="mb-3 col-md-12 text-center">
                                <input type="hidden" class="form-control" id="inputEmail3" value="<?php echo $data['id'] ?>" name="id" required>
                                <button type="submit" class="btn btn-primary" name="editdetails">Edit Store Details</button>
                            </div>
                        </div>
                        
                    </form>
                     <?php
                 }
                 else
                 {
                     ?>
                     <form action="store_details.php" method="post" id="storeForm" >
                        <div class="row g-2">
                            <div class="mb-3 col-md-4">
                                <label for="inputEmail1" class="form-label">Dispaly Name</label>
                                <input type="text" class="form-control" id="inputEmail1" placeholder="Enter Display Name" name="display" required>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="inputEmail1" class="form-label">Registered Name</label>
                                <input type="text" class="form-control" id="inputEmail1" placeholder="Enter Registered Business Name" name="registered" required>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="inputEmail2" class="form-label">GST NO</label>
                                <input type="text" class="form-control" id="inputEmail2" placeholder="Enter GST NO (Optional)" name="gst" >
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="mb-3 col-md-12">
                                <label for="inputEmail3" class="form-label">Address</label>
                                <input type="text" class="form-control" id="inputEmail3" placeholder="Enter Address" name="address" required>
                            </div>
                           
                        </div>
                        <div class="row g-2">
                            <div class="mb-3 col-md-4">
                                <label for="inputEmail4" class="form-label">City</label>
                                <input type="text" class="form-control" id="inputEmail4" placeholder="Enter City" name="city" required>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="inputEmail4" class="form-label">State</label>
                                <select class="form-select" name="state" required>
                                    <?php echo $option; ?>
                                </select>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="inputEmail4" class="form-label">Pincode</label>
                                <input type="text" class="form-control" id="inputEmail4" placeholder="Enter Pincode" name="pincode" autocomplete="off">
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="mb-3 col-md-12">
                                <label for="inputEmail3" class="form-label">Description</label>
                                <input type="text" class="form-control" id="inputEmail3" placeholder="Enter Description" name="des" required>
                            </div>
                           
                        </div>
                        <div class="row g-2">
                            <div class="mb-3 col-md-12 text-center">
                                <button type="submit" class="btn btn-primary" name="savedetails">Save Store Details</button>
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
<script type="text/javascript">
    $(document).ready(function(){
      $('#editdetails').click(function(){
        $('#storeDetails').hide();
        $('#editForm').show();
      })
    });
</script>
</body>
</html>
<?php 

if (isset($_POST['savedetails'])) {

    $display =mysqli_real_escape_string($con, $_POST['display']);
    $registered =mysqli_real_escape_string($con, $_POST['registered']);
    $gst =mysqli_real_escape_string($con, $_POST['gst']);
    $address =mysqli_real_escape_string($con, $_POST['address']);
    $city =mysqli_real_escape_string($con, $_POST['city']);
    $state =$_POST['state'];
    $pincode =mysqli_real_escape_string($con, $_POST['pincode']);
    $des =mysqli_real_escape_string($con, $_POST['des']);
   

    $sql = "INSERT INTO `wb_store_details`(`display_name`, `registered_name`, `gst_no`, `address`, `city`, `state`, `pincode`, `description`) VALUES ('$display','$registered','$gst','$address','$city','$state','$pincode','$des')";
    $run = mysqli_query($con,$sql);
    if ($run) 
    {
         ?>
         <script type="text/javascript">
             swal('SAVED!','Store Details have been saved Successfully !','success')
                 .then(function(){
              window.location = "store_details.php";  
              });
         </script>
         <?php
         
    }
                
    
   
    
}


if (isset($_POST['editdetails'])) {

    $display =mysqli_real_escape_string($con, $_POST['display']);
    $registered =mysqli_real_escape_string($con, $_POST['registered']);
    $gst =mysqli_real_escape_string($con, $_POST['gst']);
    $address =mysqli_real_escape_string($con, $_POST['address']);
    $city =mysqli_real_escape_string($con, $_POST['city']);
    $state =$_POST['state'];
    $pincode =mysqli_real_escape_string($con, $_POST['pincode']);
    $des =mysqli_real_escape_string($con, $_POST['des']);
    $id =mysqli_real_escape_string($con, $_POST['id']);
   

    $sql = "UPDATE `wb_store_details` SET `display_name`='$display',`registered_name`='$registered',`gst_no`='$gst',`address`='$address',`city`='$city',`state`='$state',`pincode`='$pincode',`description`='$des' WHERE `id`='$id'";
    $run = mysqli_query($con,$sql);
    if ($run) 
    {
         ?>
         <script type="text/javascript">
             swal('Updated!','Store Details have been updated Successfully !','success')
                 .then(function(){
              window.location = "store_details.php";  
              });
         </script>
         <?php
         
    }
                
    
   
    
}

?>