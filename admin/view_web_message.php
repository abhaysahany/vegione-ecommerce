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
    <title>View Website Messages | Estore </title>
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
                        <li class="breadcrumb-item"><a href="web_message.php">Website Messages</a></li>
                        <li class="breadcrumb-item active">View Website Messages</li>
                    </ol>
                </div>
                <h4 class="page-title">Dashboard</h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 
    <!-- Form row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header p-0 m-0">
                    <div class="row justify-content-between m-0">
                        <div class="col-6 p-3"><h4 class="text-muted">Website Contact Us Message</h4></div>
                        <div class="col-6 p-3"><a href="web_message.php" class="m-aut0 btn btn-primary float-end"><i class=" uil-left-arrow-to-left"></i> Back</a></div>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="conversation-list" data-simplebar style="max-height:650px">
                    <?php 
                      
                      $id = $_GET['view'];
                      $qry = "SELECT * FROM wb_contact_us WHERE id = '$id'";
                      $run = mysqli_query($con, $qry);
                      $data = mysqli_fetch_assoc($run);

                      ?>
                      <li class="clearfix">
                        <div class="conversation-text">
                            <p><b>Name</b> : <?php echo $data['name'] ?></p>
                            <p><b>Mobile</b> : <?php echo $data['mobile'] ?></p>  
                            <p><b>Email</b> : <?php echo $data['email'] ?></p><br>
                        </div>
                        <div class="conversation-text">

                            <div class="ctext-wrap">
                                
                                <p class="font-18">
                                    Message : <?php echo $data['message'] ?>
                                </p>
                                <i><?php echo $data['msg_date'] ?></i>
                            </div>
                        </div>
                        
                      </li>
                      <?php 

                    ?>  
                    </ul>
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