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

if (isset($_GET['product_id']) && !empty($_GET['product_id'])) {
    
    $_SESSION['product_id']=$_GET['product_id'];
    
}

if (isset($_SESSION['product_id']) && !empty($_SESSION['product_id'])) {
    
    $product_id = $_SESSION['product_id'];

    $sql = "SELECT * FROM `wb_product_catalogs` WHERE `status` = 'Live' AND product_id != '$product_id'";
    $run = mysqli_query($con, $sql);
    $row_p = mysqli_num_rows($run);
    if ($row_p > 0) 
    {
        $option_up = "";
        while ($data=mysqli_fetch_assoc($run)) 
        {

            $option_up .="<option value=".$data['product_id'].">".$data['product_name']."</option>";
        }
    }else
    {
        $option_up = "There is no product to Select";
    }
}

if (isset($_GET['up_product_id']) && isset($_GET['type'])) 
{
    $product_id=$_GET['up_product_id'];
    $type=$_GET['type'];

    $sql="DELETE FROM `wb_cross_upsale` WHERE `select_product_id`='$product_id' AND `type`='$type'";
    $run = mysqli_query($con, $sql);
    header('location:add_upsale_cross.php');
}

if (isset($_GET['cross_product_id']) && isset($_GET['type'])) 
{
    $product_id=$_GET['cross_product_id'];
    $type=$_GET['type'];

    $sql="DELETE FROM `wb_cross_upsale` WHERE `select_product_id`='$product_id' AND `type`='$type'";
    $run = mysqli_query($con, $sql);
    header('location:add_upsale_cross.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Ecommerece" name="author" />
    <title>Add Cross & Upsale | Estore </title>
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
                        <li class="breadcrumb-item"><a href="cross_and_upsale.php">Cross & Upsale Products</a></li>
                        <li class="breadcrumb-item active">Add Products</li>
                    </ol>
                </div>
                <h4 class="page-title">Store Display</h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 
    <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header p-0 m-0">
                <div class="row justify-content-between m-0">
                    <div class="col-md-6 p-3"><h4 class="text-muted">Add Product</h4></div>
                    <div class="col-md-6 p-3"><a href="cross_and_upsale.php" class="me-1 btn btn-primary float-end" id="addcat">Back</a>
                    <button class="me-1 btn btn-primary float-end" id="cross">Cross Sale</button>
                    <button class="me-1 btn btn-primary float-end" id="upsale">Upsale</button>
                    </div>
                </div>
            </div>
            <div class="card-body">
              <div class="row" id="welcome">
                 <div class="col-12">
                    <div class="text-center">
                        <h1 class="mt-0"><i class="mdi mdi-check-all"></i></h1>
                        <h2 class="mt-0">Welcome !</h2>
                        <h4 class="mt-0">Upsale & Cross Sale<br>Product Selection Wizard</h4>

                        <p class="w-75 mb-2 mx-auto">Start selecting products for upsale products and cross sale products for your store display.</p>

                        
                    </div>
                 </div> <!-- end col -->
              </div> <!-- end row -->   
              <!-- upsale div ends --> 
              <div class="row" id="upsale_div" style="display:none">
                <div class="col-md-5" >
                   <form action="add_upsale_cross.php" method="post">
                      <div class="mb-3">
                          <label for="inputEmail1" class="form-label">Enter Product Name</label>
                          <?php 
                           if ($row_p > 0) 
                           {
                               ?><input type="text" class="form-control" id="inputEmail1" placeholder="Enter Product Name" name="product" required list="dataupsale"><?php
                           }
                           else
                           {
                             ?><input type="text" class="form-control" id="inputEmail1" placeholder="No Product Listed to Select" name="product" disabled list="dataupsale"><?php
                           }

                          ?>
                          
                          <datalist id="dataupsale">
                              <?php echo $option_up; ?>
                          </datalist>
                      </div>
                      <div class="mb-3">
                          <label for="placement" class="form-label">Enter Placement No</label>
                          <input type="number" class="form-control" id="placement" placeholder="Enter Product Placement" name="placement" required >
                      </div>
                      <button class="btn btn-primary float-end" name="upsale">Add for Upsale</button> 
                   </form> 
                </div>
                <div class="col-md-7" style="border-left:1px solid rgba(0, 0, 0, 0.1); zoom:90%">
                   <div class="table-responsive">
                    <table class="table table-centered w-100 dt-responsive nowrap" id="products-datatable">
                        <thead class="table-light">
                            <tr>
                                <th class="all" style="width: 20px;">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="customCheck1">
                                        <label class="form-check-label" for="customCheck1">&nbsp;</label>
                                    </div>
                                </th>
                                <th class="all">Upsale Product</th>
                                <th>Category</th>
                                <th>MRP</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php  
                           $product_id=$_SESSION['product_id'];

                           $sql= "SELECT * FROM wb_cross_upsale WHERE wb_product_id ='$product_id' AND `type` = 'Upsale'";
                           $run = mysqli_query($con, $sql);
                           $row = mysqli_num_rows($run);
                           if ($row > 0) 
                           {
                               $i=0;
                               while ($result=mysqli_fetch_assoc($run)) 
                               {
                                  $datas[]=$result;
                               }
                               foreach ($datas as $data) 
                               {
                                   $wb_product_id=$data['select_product_id'];
                                   $sql= "SELECT * FROM wb_product_catalogs WHERE product_id ='$wb_product_id'";
                                   $run = mysqli_query($con, $sql);
                                   $result=mysqli_fetch_assoc($run);
                                   ?>
                                  <tr>
                                    <td>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="customCheck2">
                                            <label class="form-check-label" for="customCheck2">&nbsp;</label>
                                        </div>
                                    </td>
                                    <td>
                                      <img src="../images/products/<?php echo $result['product_image'] ?>" alt="product-img" title="contact-img" class="rounded me-3" height="48" />
                                     <p class="m-0 d-inline-block align-middle font-16">
                                        <a href="javascript:;" class="text-body"><?php echo $result['product_name'] ?></a>
                                        <br/>
                                        <span class="text-warning mdi mdi-star"></span>
                                        <span class="text-warning mdi mdi-star"></span>
                                        <span class="text-warning mdi mdi-star"></span>
                                        <span class="text-warning mdi mdi-star"></span>
                                        <span class="text-warning mdi mdi-star"></span>
                                      </p>      
                                    </td>
                                    <td><?php $category_id=$result['category_id'];
                                         echo getCatName($category_id, $con)
                                     ?></td>
                                    
                                    <td>₹ <?php echo $result['max_price'] ?></td>
                                    <td>₹ <?php echo $result['min_price'] ?></td>
                                    <td >
                                        <a href="add_upsale_cross.php?up_product_id=<?php echo $result['product_id'] ?>&type=Upsale" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                    </td>
                                   </tr>
                                   <?php
                               }  
                                  
                           }   

                        ?>    
                            
                        </tbody>
                    </table>
                </div> 
                </div>  
              </div>
              <!-- upsale div ends --> 
              <div class="row" id="cross_div" style="display:none">
                <div class="col-md-5" >
                   <form action="add_upsale_cross.php" method="post">
                      <div class="mb-3">
                          <label for="inputEmail1" class="form-label">Enter Product Name</label>
                          <?php 
                           if ($row_p > 0) 
                           {
                               ?><input type="text" class="form-control" id="inputEmail1" placeholder="Enter Product Name" name="product" required list="dataupsale"><?php
                           }
                           else
                           {
                             ?><input type="text" class="form-control" id="inputEmail1" placeholder="No Product Listed to Select" name="product" disabled list="dataupsale"><?php
                           }

                          ?>
                          
                          <datalist id="dataupsale">
                              <?php echo $option_up; ?>
                          </datalist>
                      </div>
                      <div class="mb-3">
                          <label for="placement" class="form-label">Enter Placement No</label>
                          <input type="number" class="form-control" id="placement" placeholder="Enter Product Placement" name="placement" required >
                      </div>
                      <button class="btn btn-primary float-end" name="cross">Add for Cross Sale</button> 
                   </form> 
                </div>
                <div class="col-md-7" style="border-left:1px solid rgba(0, 0, 0, 0.1); zoom:90%">
                   <div class="table-responsive">
                    <table class="table table-centered w-100 dt-responsive nowrap" id="products-datatable">
                        <thead class="table-light">
                            <tr>
                                <th class="all" style="width: 20px;">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="customCheck1">
                                        <label class="form-check-label" for="customCheck1">&nbsp;</label>
                                    </div>
                                </th>
                                <th class="all">Cross Sale Product</th>
                                <th>Category</th>
                                <th>MRP</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php  
                           $product_id=$_SESSION['product_id'];

                           $sql= "SELECT * FROM wb_cross_upsale WHERE wb_product_id ='$product_id'AND `type` = 'Cross Sale'";
                           $run = mysqli_query($con, $sql);
                           $row = mysqli_num_rows($run);
                           if ($row > 0) 
                           {
                               $i=0;
                               while ($result=mysqli_fetch_assoc($run)) 
                               {
                                  $datac[]=$result;
                               }
                               foreach ($datac as $data) 
                               {
                                   $wb_product_id=$data['select_product_id'];
                                   $sql= "SELECT * FROM wb_product_catalogs WHERE product_id ='$wb_product_id'";
                                   $run = mysqli_query($con, $sql);
                                   $result=mysqli_fetch_assoc($run);
                                   ?>
                                  <tr>
                                    <td>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="customCheck2">
                                            <label class="form-check-label" for="customCheck2">&nbsp;</label>
                                        </div>
                                    </td>
                                    <td>
                                      <img src="../images/products/<?php echo $result['product_image'] ?>" alt="product-img" title="contact-img" class="rounded me-3" height="48" />
                                     <p class="m-0 d-inline-block align-middle font-16">
                                        <a href="javascript:;" class="text-body"><?php echo $result['product_name'] ?></a>
                                        <br/>
                                        <span class="text-warning mdi mdi-star"></span>
                                        <span class="text-warning mdi mdi-star"></span>
                                        <span class="text-warning mdi mdi-star"></span>
                                        <span class="text-warning mdi mdi-star"></span>
                                        <span class="text-warning mdi mdi-star"></span>
                                      </p>      
                                    </td>
                                    <td><?php $category_id=$result['category_id'];
                                         echo getCatName($category_id, $con)
                                     ?></td>
                                    
                                    <td>₹ <?php echo $result['max_price'] ?></td>
                                    <td>₹ <?php echo $result['min_price'] ?></td>
                                    <td >
                                        <a href="add_upsale_cross.php?cross_product_id=<?php echo $result['product_id'] ?>&type=Cross Sale" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                    </td>
                                   </tr>
                                   <?php
                               }  
                                  
                           }   

                        ?>    
                            
                        </tbody>
                    </table>
                </div> 
                </div>  
              </div>
              <!-- cross div ends --> 
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
<!-- third party js -->
<script src="assets/js/vendor/jquery.dataTables.min.js"></script>
<script src="assets/js/vendor/dataTables.bootstrap4.js"></script>
<script src="assets/js/vendor/dataTables.responsive.min.js"></script>
<script src="assets/js/vendor/responsive.bootstrap4.min.js"></script>
<script src="assets/js/vendor/dataTables.checkboxes.min.js"></script>
<script>
   $(document).ready(function(){
     $('#cross').click(function(){
       $('#upsale_div,#welcome').hide();
       $('#cross_div').show();
     })

     $('#upsale').click(function(){
       $('#upsale_div').show();
       $('#cross_div,#welcome').hide();
     })
   }); 
</script>
</body>
</html>
<?php 

if (isset($_POST['upsale'])) {

    $product = $_POST['product'];
    $wb_product_id = $_SESSION['product_id'];
    $placement = $_POST['placement'];

    $sql = "SELECT * FROM `wb_cross_upsale` WHERE `wb_product_id`='$wb_product_id' AND `select_product_id`='$product' AND`type`='Upsale'";
    $run = mysqli_query($con, $sql);
    $row = mysqli_num_rows($run);
    if ($row > 0) 
    {
        ?>
        <script type="text/javascript">
             swal('Checkout!','This product is already added for upsale !','error')
                 .then(function(){
                    $('#upsale_div').show();
                    $('#cross_div,#welcome').hide();
              // window.location = "add_upsale_cross.php";  
              });
         </script>
        <?php
    }
    else
    {
        $sql = "INSERT INTO `wb_cross_upsale`(`wb_product_id`, `type`, `select_product_id`, `placement`) VALUES ('$wb_product_id','Upsale','$product','$placement')";
        $run = mysqli_query($con, $sql);
        if ($run) 
        {
            ?>
            <script type="text/javascript">
                 swal('Added!','This product added for upsale successfully!','success')
                     .then(function(){
                    window.location = "add_upsale_cross.php";  
                  });
             </script>
            <?php
        }
    }

}

if (isset($_POST['cross'])) {

    $product = $_POST['product'];
    $wb_product_id = $_SESSION['product_id'];
    $placement = $_POST['placement'];

    $sql = "SELECT * FROM `wb_cross_upsale` WHERE `wb_product_id`='$wb_product_id' AND `select_product_id`='$product' AND`type`='Cross Sale'";
    $run = mysqli_query($con, $sql);
    $row = mysqli_num_rows($run);
    if ($row > 0) 
    {
        ?>
        <script type="text/javascript">
             swal('Checkout!','This product is already added for Cross Sale !','error')
                 .then(function(){
              $('#upsale_div,#welcome').hide();
              $('#cross_div').show();
              });
         </script>
        <?php
    }
    else
    {
        $sql = "INSERT INTO `wb_cross_upsale`(`wb_product_id`, `type`, `select_product_id`, `placement`) VALUES ('$wb_product_id','Cross Sale','$product','$placement')";
        $run = mysqli_query($con, $sql);
        if ($run) 
        {
            ?>
            <script type="text/javascript">
                 swal('Added!','This product added for Cross Sale successfully!','success')
                     .then(function(){
                  window.location = "add_upsale_cross.php";  
                  });
             </script>
            <?php
        }
    }

}
?>