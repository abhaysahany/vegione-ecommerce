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

if (isset($_GET['delete']) && !empty($_GET['delete'])) {
    
    $id = $_GET['delete'];
    $sql = "DELETE FROM wb_user_details WHERE `id`='$id'";
    $run = mysqli_query($con, $sql);

    $sql = "DELETE FROM wb_user_address WHERE `user_id`='$id'";
    $run = mysqli_query($con, $sql);

    header('location:customer_details.php');
}

if (isset($_GET['change']) && !empty($_GET['change'])) {
    
    $id = $_GET['change'];
    $sql = "SELECT * FROM wb_user_details WHERE `id`='$id'";
    $run = mysqli_query($con, $sql);
    $data = mysqli_fetch_assoc($run);
    $status = $data['status'];
    if ($status=='Active') {

        $sql = "UPDATE `wb_user_details` SET `status`='Blocked' WHERE `id`";
        $run = mysqli_query($con, $sql);

    }elseif ($status=='Blocked') {

        $sql = "UPDATE `wb_user_details` SET `status`='Active' WHERE `id`";
        $run = mysqli_query($con, $sql);
    }

    // header('location:customer_details.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8" />
        <title>Customers | Estore</title>
<?php include('header.php') ?>
    <!-- Start Content-->
    <div class="container-fluid">
        
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="dashboard.php">Admin</a></li>
                            <li class="breadcrumb-item active">Customers</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Customers</h4>
                </div>
            </div>
        </div>     
        <!-- end page title --> 

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-sm-4">
                                <a href="javascript:void(0);" class="btn btn-danger mb-2">Customers Details</a>
                            </div>
                            <div class="col-sm-8">
                                <div class="text-sm-end">
                                    <!-- <button type="button" class="btn btn-success mb-2 me-1"><i class="mdi mdi-cog"></i></button>
                                    <button type="button" class="btn btn-light mb-2 me-1">Import</button>
                                    <button type="button" class="btn btn-light mb-2">Export</button> -->
                                </div>
                            </div><!-- end col-->
                        </div>

                        <div class="table-responsive">
                            <table class="table table-centered table-striped dt-responsive nowrap w-100" id="products-datatable">
                                <thead>
                                    <tr>
                                        <th style="width: 20px;">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="customCheck1">
                                                <label class="form-check-label" for="customCheck1">&nbsp;</label>
                                            </div>
                                        </th>
                                        <th>Customer</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Location</th>
                                        <th>Create Date</th>
                                        <th>Status</th>
                                        <th style="width: 75px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                           
                                   $sql= "SELECT * FROM wb_user_details";
                                   $run = mysqli_query($con, $sql);
                                   $row = mysqli_num_rows($run);
                                   if ($row > 0) 
                                   {
                                       $i=0;
                                       while ($data=mysqli_fetch_assoc($run)) 
                                       {
                                          $datas[]=$data; 
                                       }

                                       foreach ($datas as $value) 
                                       {
                                           $id = $value['id'];
                                           $sql= "SELECT * FROM wb_user_address WHERE `user_id`='$id'";
                                           $run = mysqli_query($con, $sql);
                                           $row = mysqli_num_rows($run);
                                           if ($row > 0) {
                                               $udata = mysqli_fetch_assoc($run);
                                           }else
                                           {
                                               $udata['phone']="Not Available";
                                               $udata['email']="Not Available";
                                               $udata['city']="Not Available";
                                           }
                                           
                                           $i++;
                                           ?> 
                                           <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="customCheck2">
                                                    <label class="form-check-label" for="customCheck2">&nbsp;</label>
                                                </div>
                                            </td>
                                            <td class="table-user">
                                                
                                                <a href="javascript:void(0);" class="text-body fw-semibold"><?=$value['username']?></a>
                                            </td>
                                            <td>
                                                <?=$udata['phone']?>
                                            </td>
                                            <td>
                                                <?=$udata['email']?>
                                            </td>
                                            <td>
                                                <?=$udata['city']?>
                                            </td>
                                            <td>
                                                <?=$value['create_on']?>
                                            </td>
                                            <td>
                                            <?php 
                                              if ($value['status']=='Active') {
                                                 ?><span class="badge badge-success-lighten px-2 py-1">Active</span><?php
                                              }else{
                                                ?><span class="badge badge-danger-lighten px-2 py-1">Blocked</span><?php
                                              }

                                            ?>    
                                                
                                            </td>
        
                                            <td>
                                                <a href="customer_details.php?change=<?php echo $value['id'] ?>" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                                <a href="customer_details.php?delete=<?php echo $value['id'] ?>" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                            </td>
                                        </tr>
                                           <?php
                                       }
                                    }
                                ?>              
                                    
                                </tbody>
                            </table>
                        </div>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div>
        <!-- end row -->
        
    </div> <!-- container -->

</div> <!-- content -->


<?php include('footer.php') ?>        
</body>
</html>
