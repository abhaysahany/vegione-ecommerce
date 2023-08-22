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

if (isset($_GET['live']) && !empty($_GET['live'])) {
    
    $id = $_GET['live'];
    $qry="SELECT * FROM wb_product_catalogs WHERE `id`='$id'";
    $run = mysqli_query($con, $qry);
    $data=mysqli_fetch_assoc($run);
    $image=$data['product_image'];
    $brand=$data['brand'];
    if ($image!='' && $brand !='') {
       $sql = "UPDATE `wb_product_catalogs` SET `status`='Live' WHERE `id`='$id'";
       $run = mysqli_query($con, $sql);
       header('location:manage_products.php');
    }else{
        ?>
        <script type="text/javascript">
            alert('Complete your Listing First')
            window.location="manage_products.php";
        </script>
        <?php
    }

    
}
elseif (isset($_GET['notlive']) && !empty($_GET['notlive'])) {
    
    $id = $_GET['notlive'];
    $sql = "UPDATE `wb_product_catalogs` SET `status`='Not Live' WHERE `id`='$id'";
    $run = mysqli_query($con, $sql);
    header('location:manage_products.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Ecommerece" name="author" />
    <title>Products Catalog | Estore </title>
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
                        <li class="breadcrumb-item active">Product Catalog</li>
                    </ol>
                </div>
                <h4 class="page-title">Products</h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 
    <div class="row">
    <div class="col-12">
        <div class="card" style="zoom:85%">
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-sm-4">
                        <a href="upload_product.php" class="btn btn-danger mb-2"><i class="mdi mdi-plus-circle me-2"></i> Add Products</a>
                    </div>
                    <div class="col-sm-8">
                        <div class="text-sm-end">
                            <button type="button" class="btn btn-success mb-2 me-1"><i class="mdi mdi-cog-outline"></i></button>
                            <button type="button" class="btn btn-light mb-2 me-1">Import</button>
                            <button type="button" class="btn btn-light mb-2">Export</button>
                        </div>
                    </div><!-- end col-->
                </div>

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
                                <th class="all">Product</th>
                                <th>Category</th>
                                <th>Brand</th>
                                <th>MRP / Price</th>
                                <th>Quantity</th>
                                <th>Status</th>
                                <th style="width: 85px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php  
                          
                           $sql= "SELECT * FROM wb_product_catalogs WHERE `brand`!='' AND `product_image`!=''";
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
                                    <td>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="customCheck2">
                                            <label class="form-check-label" for="customCheck2">&nbsp;</label>
                                        </div>
                                    </td>
                                    <td>
                                    <?php 
                                     if ($data['product_image']!='') 
                                     {
                                       ?>
                                        <img src="../images/products/<?php echo $data['product_image'] ?>" alt="contact-img" title="contact-img" class="rounded me-3" height="48" />
                                        <p class="m-0 d-inline-block align-middle font-16">
                                            <a href="javascript:;" class="text-body"><?php echo $data['product_name'] ?></a>
                                            <br/>
                                            <span class="text-warning mdi mdi-star"></span>
                                            <span class="text-warning mdi mdi-star"></span>
                                            <span class="text-warning mdi mdi-star"></span>
                                            <span class="text-warning mdi mdi-star"></span>
                                            <span class="text-warning mdi mdi-star"></span>
                                        </p>
                                       <?php 
                                     }else
                                     {
                                       ?>
                                       <img src="../images/products/empty.jpg" alt="contact-img" title="contact-img" class="rounded me-3" height="48" />
                                        <p class="m-0 d-inline-block align-middle font-16">
                                            <a href="javascript:;" class="text-body"><?php echo $data['product_name'] ?></a>
                                            <br/>
                                            <span class="text-warning mdi mdi-star"></span>
                                            <span class="text-warning mdi mdi-star"></span>
                                            <span class="text-warning mdi mdi-star"></span>
                                            <span class="text-warning mdi mdi-star"></span>
                                            <span class="text-warning mdi mdi-star"></span>
                                        </p>
                                       <?php  
                                     }
                                    ?>    
                                        
                                    </td>
                                    <td><?php $category_id=$data['category_id'];
                                         echo getCatName($category_id, $con)
                                     ?></td>
                                    <td><?php echo $data['brand'] ?></td>
                                    <td>₹ <?php echo $data['max_price'] ?> / ₹ <?php echo $data['min_price'] ?></td>
                                    <td><?php echo $data['stock_quantity'] ?></td>
                                    <td class="text-center">
                                          <?php 
                                            if ($data['status']=='Live') {
                                                ?><a href="manage_products.php?notlive=<?php echo $data['id']?>" class="btn btn-success btn-sm">Live</a><?php
                                            }else{
                                                ?><a href="manage_products.php?live=<?php echo $data['id']?>" class="btn btn-danger btn-sm">Not Live</a><?php 
                                            }
                                          ?>
                                            
                                    </td>
                                    <td class="table-action">
                                        <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-eye"></i></a>
                                        <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
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
</body>
</html>