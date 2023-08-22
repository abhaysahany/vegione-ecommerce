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
    $runs = mysqli_query($con, $sql);
    $row = mysqli_num_rows($runs);

    $sql = "SELECT * FROM wb_store_details";
    $runsd = mysqli_query($con, $sql);
    $datasd = mysqli_fetch_assoc($runsd);
    $store_state = $datasd['state'];

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Invoice | Estore </title>
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
                            <li class="breadcrumb-item"><a href="manage_orders.php">Manage Orders</a></li>
                            <li class="breadcrumb-item active">Invoice</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Invoice</h4>
                </div>
            </div>
        </div>     
        <!-- end page title --> 

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <!-- Invoice Logo-->
                        <div class="clearfix">
                            <div class="float-start mb-3">
                                <img src="assets/images/logo-light.png" alt="" height="18">
                            </div>
                            <div class="float-end">
                                <h4 class="m-0 d-print-none">Invoice</h4>
                            </div>
                        </div> 
                        <?php 
                            $qry = "SELECT * FROM wb_order_table WHERE order_id = '$orderid' limit 1";
                            $run = mysqli_query($con, $qry);
                            $data = mysqli_fetch_assoc($run);
                            $address_id = $data['address_id'];

                            $sql = "SELECT * FROM wb_user_address WHERE id = '$address_id'";
                            $run = mysqli_query($con, $sql);
                            $adata = mysqli_fetch_assoc($run);
                            $user_state = $adata['state']
                        ?>
                        <!-- Invoice Detail-->
                        <div class="row justify-content-between">
                            <div class="col-4">
                                <h6>Billing Address</h6>
                                <address>
                                    <?=$adata['f_name'].' '.$adata['l_name']?><br>
                                    <?=$adata['address']?><br>
                                    <?=$adata['city'].' '.$adata['state'].'-'.$adata['pincode']?><br>
                                    <abbr title="Phone">M:</abbr> <?=$adata['phone']?> <br/>
                                    <abbr title="Mobile">E:</abbr> <?=$adata['email']?>
                                </address>
                            </div> <!-- end col-->
                            <div class="col-4 ">
                                <div class="mt-3 float-lg-end">
                                    <p class="font-13"><strong>Order Date: </strong> &nbsp;&nbsp;&nbsp; <?php
                                         $date = $data['order_date'];
                                         echo date('D', strtotime($date));
                                         echo " , ";
                                         echo date('M d', strtotime($date));
                                         echo " , ";
                                         echo date('Y', strtotime($date));
                                     ?></p>
                                    <p class="font-13"><strong>Order Status: </strong> <span class="badge bg-success float-end"><?=$data['order_type']?></span></p>
                                    <p class="font-13"><strong>Order ID: </strong> <span class="float-end">#<?=$data['order_id']?></span></p>
                                </div>
                            </div><!-- end col -->
                        </div>
                        <!-- end row -->

                        <div class="row mt-4 justify-content-between">
                            
                            <div class="col-4">
                                <h6>Shipped From:</h6>
                                <address>
                                    Lifeleads Enterprises<br>
                                    24 Laxman Ganj,Near Bhumi Vikas Bank<br>
                                    Khurja Utter Pradesh-203131<br>
                                    <abbr title="Phone">GSTIN NO:</abbr> 09AXNPS8060Q1ZA <br/>
                                </address>
                            </div> <!-- end col-->
                            <div class="col-4">
                                <h6>Invoice Details</h6>
                                <div class="mt-3 ">
                                    <p class="font-13"><strong>Invoice Date: </strong> &nbsp;&nbsp;&nbsp; <?php
                                     $date = $data['invoice_date'];
                                         echo date('D', strtotime($date));
                                         echo " , ";
                                         echo date('M d', strtotime($date));
                                         echo " , ";
                                         echo date('Y', strtotime($date));
                                     ?></p>
                                    <p class="font-13"><strong>Invoice No: </strong> <span class="">&nbsp;&nbsp;&nbsp;Estore<?=$data['session'].' --- 0'.$data['invoice_no']?></span></p>
                                </div>
                            </div> <!-- end col-->
                        </div>    
                        <!-- end row -->        
                        <?php 
                         if ($store_state==$user_state) 
                         {
                             ?>
                             <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table mt-4">
                                            <thead>
                                            <tr><th>#</th>
                                                <th>Item</th>
                                                <th>Quantity</th>
                                                <th>Order Value</th>
                                                <th>IGST</th>
                                                <th class="text-end">Total</th>
                                            </tr></thead>
                                            <tbody>
                                        <?php 
                                          if ($row > 0) 
                                          {
                                             $i=0;
                                             while ($data=mysqli_fetch_assoc($runs)) 
                                             {
                                                 $datas[]=$data;
                                             }

                                             $g_value =0;
                                             $g_tax =0;
                                             foreach ($datas as $value) 
                                             {
                                                $product_id = $value['puic']; 
                                                $sql = "SELECT * FROM wb_product_catalogs WHERE product_id = '$product_id' ";
                                                $run = mysqli_query($con, $sql);
                                                $data = mysqli_fetch_assoc($run);
                                                $taxrate=$data['tax_class_rate'];
                                                $total_taxrate=100+$taxrate;
                                                $totalvalue=$value['order_value']+$value['shipping'];
                                                $ordervalue = $totalvalue/$total_taxrate*100;
                                                $gst = $totalvalue/$total_taxrate*$taxrate;

                                                
                                                $i++;
                                                ?>
                                                <tr>
                                                    <td>1</td>
                                                    <td>
                                                        <b><?php echo $data['product_name'] ?></b> <br/>
                                                        Brand & Model <?=$data['brand'].' - '.$data['model_no'] ?> 
                                                    </td>
                                                    <td><?=$value['quantity']?></td>
                                                    <td>₹ <?=number_format($ordervalue,2) ?><br><small>With Shipping</small></td>
                                                    <td >₹ <?=number_format($gst, 2) ?></td>
                                                    <td class="text-end">₹ <?=$ordervalue+$gst?></td>
                                                </tr>
                                                <?php 
                                                $g_value +=$ordervalue;
                                                $g_tax +=$gst;
                                             }
                                             
                                          }

                                        ?>
                                            </tbody>
                                        </table>
                                    </div> <!-- end table-responsive-->
                                </div> <!-- end col -->
                             </div>
                             <!-- end row -->

                             <div class="row">
                                <div class="col-sm-6">
                                    <div class="clearfix pt-3">
                                        <h6 class="text-muted">Notes:</h6>
                                        <small>
                                            Customer Self Declaration : I <?=$adata['f_name'].' '.$adata['l_name']?> hereby confirm that the content of this packege are being purchased for my internal and personal purpose and not for re-sale. I further understand and agree to lifeleads terms and conditions.
                                        </small>
                                    </div>
                                </div> <!-- end col -->
                                <div class="col-sm-6">
                                    <div class="float-end mt-3 mt-sm-0">

                                        <p><b>Sub-total:</b> <span class="float-end">₹ <?=number_format($g_value, 2) ?></span></p>
                                        <p><b>IGST:</b> <span class="float-end">₹ <?=number_format($g_tax, 2) ?></span></p>
                                        <h3>₹ <?=number_format($g_value+$g_tax, 2)?> INR</h3>
                                    </div>
                                    <div class="clearfix"></div>
                                </div> <!-- end col -->
                             </div>
                             <?php
                         }
                         else
                         {
                             ?>
                             <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table mt-4">
                                            <thead>
                                            <tr><th>#</th>
                                                <th>Item</th>
                                                <th>Quantity</th>
                                                <th>Order Value</th>
                                                <th>CGST</th>
                                                <th>SGST</th>
                                                <th class="text-end">Total</th>
                                            </tr></thead>
                                            <tbody>
                                        <?php 
                                          if ($row > 0) 
                                          {
                                             $i=0;
                                             while ($data=mysqli_fetch_assoc($runs)) 
                                             {
                                                 $datas[]=$data;
                                             }

                                             $g_value =0;
                                             $g_tax =0;
                                             foreach ($datas as $value) 
                                             {
                                                $product_id = $value['puic']; 
                                                $sql = "SELECT * FROM wb_product_catalogs WHERE product_id = '$product_id' ";
                                                $run = mysqli_query($con, $sql);
                                                $data = mysqli_fetch_assoc($run);
                                                $taxrate=$data['tax_class_rate'];
                                                $total_taxrate=100+$taxrate;
                                                $totalvalue=$value['order_value']+$value['shipping'];
                                                $ordervalue = $totalvalue/$total_taxrate*100;
                                                $gst = $totalvalue/$total_taxrate*$taxrate;

                                                
                                                $i++;
                                                ?>
                                                <tr>
                                                    <td>1</td>
                                                    <td>
                                                        <b><?php echo $data['product_name'] ?></b> <br/>
                                                        Brand & Model <?=$data['brand'].' - '.$data['model_no'] ?> 
                                                    </td>
                                                    <td><?=$value['quantity']?></td>
                                                    <td>₹ <?=number_format($ordervalue,2) ?><br><small>With Shipping</small></td>
                                                    <td >₹ <?=number_format($gst/2, 2) ?></td>
                                                    <td >₹ <?=number_format($gst/2, 2) ?></td>
                                                    <td class="text-end">₹ <?=$ordervalue+$gst?></td>
                                                </tr>
                                                <?php 
                                                $g_value +=$ordervalue;
                                                $g_tax +=$gst;
                                             }
                                             
                                          }

                                        ?>
                                            </tbody>
                                        </table>
                                    </div> <!-- end table-responsive-->
                                </div> <!-- end col -->
                             </div>
                             <!-- end row -->

                             <div class="row">
                                <div class="col-sm-6">
                                    <div class="clearfix pt-3">
                                        <h6 class="text-muted">Notes:</h6>
                                        <small>
                                            Customer Self Declaration : I <?=$adata['f_name'].' '.$adata['l_name']?> hereby confirm that the content of this packege are being purchased for my internal and personal purpose and not for re-sale. I further understand and agree to lifeleads terms and conditions.
                                        </small>
                                    </div>
                                </div> <!-- end col -->
                                <div class="col-sm-6">
                                    <div class="float-end mt-3 mt-sm-0">

                                        <p><b>Sub-total:</b> <span class="float-end">₹ <?=number_format($g_value, 2) ?></span></p>
                                        <p><b>IGST:</b> <span class="float-end">₹ <?=number_format($g_tax, 2) ?></span></p>
                                        <h3>₹ <?=number_format($g_value+$g_tax, 2)?> INR</h3>
                                    </div>
                                    <div class="clearfix"></div>
                                </div> <!-- end col -->
                             </div>
                             <?php
                         }

                        ?>
                        
                        <!-- end row-->

                        <div class="d-print-none mt-4">
                            <div class="text-end">
                                <a href="javascript:window.print()" class="btn btn-primary"><i class="mdi mdi-printer"></i> Print Invoice</a>
                            </div>
                        </div>   
                        <!-- end buttons -->

                    </div> <!-- end card-body-->
                </div> <!-- end card -->
            </div> <!-- end col-->
        </div>
        <!-- end row -->
        
    </div> <!-- container -->

</div> <!-- content -->

<?php include('footer.php') ?>        
</body>
</html>
