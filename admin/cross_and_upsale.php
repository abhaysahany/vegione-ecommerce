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
    <title>Cross & Upsale | Estore </title>
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
                        <li class="breadcrumb-item active">Cross & Upsale Products</li>
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
            <div class="card-body">
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
                                <th>MRP</th>
                                <th>Price</th>
                                <th>Upsale</th>
                                <th>Cross Sale</th>
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
                               while ($result=mysqli_fetch_assoc($run)) 
                               {
                                  $datas[]=$result;
                               }
                               foreach ($datas as $data) 
                               {
                                   
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
                                    
                                    <td>₹ <?php echo $data['max_price'] ?></td>
                                    <td>₹ <?php echo $data['min_price'] ?></td>
                                    <td><?php echo CrossSale($data['product_id'], $con)  ?></td>
                                    <td><?php echo UpsaleSale($data['product_id'], $con)  ?></td>
                                    <td class="table-action">
                                        <a href="add_upsale_cross.php?product_id=<?php echo $data['product_id'] ?>" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
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
</body>
</html>