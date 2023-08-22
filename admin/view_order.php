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

if (isset($_GET['orderid']) && !empty($_GET['orderid'])) {
   
   $_SESSION['orderid']= mysqli_real_escape_string($con, $_GET['orderid']);
}

if (isset($_SESSION['orderid'])) {

    $orderid = $_SESSION['orderid'];
    $sql = "SELECT * FROM wb_order_table WHERE order_id = '$orderid'";
    $run = mysqli_query($con, $sql);
    $row = mysqli_num_rows($run);

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Order Details | Hyper - Responsive Bootstrap 5 Admin Dashboard</title>
<?php include('header.php') ?>        
                    <!-- Start Content-->
    <div class="container-fluid">
        
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Hyper</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">eCommerce</a></li>
                            <li class="breadcrumb-item active">Order Details</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Order Details</h4>
                </div>
            </div>
        </div>     
        <!-- end page title --> 

        <div class="row justify-content-center">
            <div class="col-lg-7 col-md-10 col-sm-11">

                <div class="horizontal-steps mt-4 mb-4 pb-5" id="tooltip-container">
                    <div class="horizontal-steps-content">
                        <div class="step-item current">
                            <span data-bs-container="#tooltip-container" data-bs-toggle="tooltip" data-bs-placement="bottom" title="20/08/2018 07:24 PM">Order Placed</span>
                        </div>
                        <div class="step-item">
                            <span>Packed</span>
                        </div>
                        <div class="step-item">
                            <span>Shipped</span>
                        </div>
                        <div class="step-item">
                            <span>Delivered</span>
                        </div>
                    </div>

                    <div class="process-line" style="width: 0%;"></div>
                </div>
            </div>
        </div>
        <!-- end row -->    
        
        
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-3">Items from Order #<?=$orderid?></h4>

                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead class="table-light">
                                <tr>
                                    <th>Item</th>
                                    <th>Type</th>
                                    <th>Quantity</th>
                                    <th>Value</th>
                                    <th>Shipping</th>
                                    <th>Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php 
                                 if ($row > 0) 
                                 {
                                    while ($data=mysqli_fetch_assoc($run)) 
                                    {
                                        ?>
                                        <tr>
                                            <td><?php $product_id=$data['puic']; echo getProName($product_id, $con); ?></td>
                                            <td><?php echo $data['product_type']; ?></td>
                                            <td><?php echo $data['quantity']; ?></td>
                                            <td>₹ <?php echo $data['order_value']; ?></td>
                                            <td>₹ <?php echo $data['shipping']; ?></td>
                                            <td>₹ <?php echo $data['order_value']+$data['shipping']; ?></td>
                                            
                                        </tr>
                                        <?php
                                    }
                                 }

                                ?>    
                                
                                
                                </tbody>
                            </table>
                        </div>
                        <!-- end table-responsive -->

                    </div>
                </div>
            </div> <!-- end col -->
            <?php 
                $qry = "SELECT sum(shipping)as s_total FROM wb_order_table WHERE order_id = '$orderid'";
                $run = mysqli_query($con, $qry);
                $sdata = mysqli_fetch_assoc($run);
                $shipping = $sdata['s_total'];

                $qry = "SELECT sum(order_value)as o_total FROM wb_order_table WHERE order_id = '$orderid'";
                $run = mysqli_query($con, $qry);
                $odata = mysqli_fetch_assoc($run);
                $order_value = $odata['o_total'];

            ?>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-3">Order Summary</h4>

                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead class="table-light">
                                <tr>
                                    <th>Description</th>
                                    <th>Price</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Grand Total :</td>
                                    <td>₹ <?=$order_value?></td>
                                </tr>
                                <tr>
                                    <td>Shipping Charge :</td>
                                    <td>₹ <?=number_format($shipping, 2) ?></td>
                                </tr>
                                <tr>
                                    <th>Total :</th>
                                    <th>₹ <?=number_format($shipping+$order_value, 2) ?></th>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- end table-responsive -->

                    </div>
                </div>
            </div> <!-- end col -->
        </div>
        <!-- end row -->

        <?php 
            $qry = "SELECT * FROM wb_order_table WHERE order_id = '$orderid' limit 1";
            $run = mysqli_query($con, $qry);
            $data = mysqli_fetch_assoc($run);
            $address_id = $data['address_id'];

            $sql = "SELECT * FROM wb_user_address WHERE id = '$address_id'";
            $run = mysqli_query($con, $sql);
            $data = mysqli_fetch_assoc($run);

        ?>
        <div class="row justify-content-between">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-3">Shipping Information</h4>

                        <h5><?=$data['f_name'].' '.$data['l_name']?></h5>
                        
                        <address class="mb-0 font-14 address-lg">
                            <?=$data['address']?><br>
                            <?=$data['city'].' '.$data['state'].'-'.$data['pincode']?><br>
                            <abbr title="Phone">M:</abbr> <?=$data['phone']?> <br/>
                            <abbr title="Mobile">E:</abbr> <?=$data['email']?>
                        </address>

                    </div>
                </div>
            </div> <!-- end col -->

            <!-- <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-3">Billing Information</h4>

                        <ul class="list-unstyled mb-0">
                            <li>
                                <p class="mb-2"><span class="fw-bold me-2">Payment Type:</span> Credit Card</p>
                                <p class="mb-2"><span class="fw-bold me-2">Provider:</span> Visa ending in 2851</p>
                                <p class="mb-2"><span class="fw-bold me-2">Valid Date:</span> 02/2020</p>
                                <p class="mb-0"><span class="fw-bold me-2">CVV:</span> xxx</p>
                            </li>
                        </ul>

                    </div>
                </div>
            </div> --> <!-- end col -->

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h4 class="header-title mb-3">Order Authentication</h4>

                        <div class="text-center">
                            <a href="order_status.php?accept=<?php echo $orderid ?>" class="btn btn-success">Accept</a>
                            <a href="order_status.php?reject=<?php echo $orderid ?>" class="btn btn-danger">Reject</a>
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
        <!-- end row -->

        
    </div> <!-- container -->

</div> <!-- content -->
<?php include('footer.php') ?>
</body>
</html>
