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


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Ecommerece" name="author" />
    <title>Delivered Orders | Estore </title>
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
                        <li class="breadcrumb-item active">Manage Orders</li>
                    </ol>
                </div>
                <h4 class="page-title"> Orders Management</h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 
    <div class="row" style="zoom:85%">
    <div class="col-12">
        <div class="card">
            <div class="card-header p-0 m-0">
                <div class="row justify-content-between m-0">
                    <div class="col-6 p-3"><h4 class="text-muted">Delivered Order Management</h4></div>
                    
                </div>
            </div>
            <div class="card-body">
                <!-- <div class="row mb-2 ">
                    <div class="col-sm-3">
                        <a href="manage_orders.php" class="btn btn-danger mb-2 float-end"><i class="mdi mdi-arrow-up-bold "></i>Manage Orders</a>
                    </div>
                    <div class="col-sm-9">
                        <div class="text-sm-end">
                            <button type="button" class="btn btn-success mb-2 me-1"><i class="mdi mdi-cog-outline"></i></button>
                            <button type="button" class="btn btn-light mb-2 me-1">Import</button>
                            <button type="button" class="btn btn-light mb-2">Export</button>
                        </div>
                    </div> end col
                </div> -->

                <table id="scroll-horizontal-datatable" class="table w-100 nowrap">
                    <thead class="table-light">
                        <tr>
                            <th>S.No</th>
                            <th>Order Date</th>
                            <th>Order Id</th>
                            <th>Order Type</th>
                            <th>Type</th>
                            <th>Order Value</th>
                            <th>Customer</th>
                            <th>City</th>
                            <th>State</th>
                            <th  class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php  
                      
                       $sql= "SELECT * FROM wb_order_table WHERE `status`='Delivered' group by order_id";
                       $run = mysqli_query($con, $sql);
                       $row = mysqli_num_rows($run);
                       if ($row > 0) 
                       {
                           $i=0;
                           while ($data=mysqli_fetch_assoc($run)) 
                           {
                              $datas[]=$data;
                           }

                           foreach ($datas as  $value) 
                           {
                               $i++;
                               ?>
                              <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo date('d/m/Y', strtotime($value['order_date']))   ?></td>
                                <td><?php echo $value['order_id'] ?></td>
                                <td><?php 
                                    $type=$value['order_type'];
                                    if ($type == 'ONLINE') {
                                      ?><h5 class="m-auto"><span class="badge badge-success-lighten"><i class="mdi mdi-coin"></i> Paid</span></h5><?php
                                    }else{
                                       ?><h5 class="m-auto"><span class="badge badge-info-lighten"><i class="mdi mdi-cash"></i> Unpaid</span></h5><?php 
                                    }
                                    ?>  
                                 </td>
                                <td><?php $orderid=$value['order_id'];
                                     $ordercount = getOrderCount($orderid, $con);
                                     if ($ordercount > 1) {
                                      ?><h4 class="m-auto"><span class="badge badge-success-lighten"><i class="mdi mdi-coin"></i> Multi (<?=$ordercount?>)</span></h4><?php
                                     }else{
                                       ?><h4 class="m-auto"><span class="badge badge-info-lighten"><i class="mdi mdi-coin"></i> Single </span></h4><?php 
                                     }
                                 ?></td>
                                <td>₹ <?php echo $value['total_order_value'] ?></td>
                                <?php 
                                   $address_id=$value['address_id'];
                                   $sql = "SELECT * FROM wb_user_address WHERE id = '$address_id' ";
                                   $run = mysqli_query($con, $sql);
                                   $add = mysqli_fetch_assoc($run);
                                ?>
                                <td><?php echo $add['f_name'].' '.$add['l_name'] ?></td>
                                <td><?php echo $add['city'] ?></td>
                                <td><?php echo $add['state'] ?></td> 
                                <td class="table-action">
                                    <a href="view_complete_order.php?orderid=<?php echo $value['order_id'] ?>" class="btn btn-sm btn-success mx-0">View Order </a>
                                </td>
                               </tr>
                               <?php
                           }
                       }   

                    ?>    
                        
                    </tbody>
                </table>
            </div> <!-- end card-body-->
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