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

$sql = "SELECT * FROM `wb_product_catalogs` WHERE `status` = 'Live'";
$run = mysqli_query($con, $sql);
$row = mysqli_num_rows($run);
if ($row > 0) 
{
    $option_up = "";
    while ($data=mysqli_fetch_assoc($run)) 
    {

        $option_up .="<option value=".$data['product_id'].">".$data['product_name']."</option>";
    }
}
else
{
    $option_up = "";
}

if (isset($_GET['delete']) && !empty($_GET['delete'])) {
    
    $id = $_GET['delete'];
    $sql = "DELETE FROM wb_store_front_products WHERE `id`='$id'";
    $run = mysqli_query($con, $sql);
    header('location:front_products.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8" />
        <title>Sellers | Hyper - Responsive Bootstrap 5 Admin Dashboard</title>
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
                    <li class="breadcrumb-item active">Add Products</li>
                </ol>
            </div>
            <h4 class="page-title">Store Front</h4>
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
                    <div class="col-6 p-3"><h4 class="text-muted">Store Front Products</h4></div>
                    <div class="col-6 p-3"><button  class="m-aut0 btn btn-primary float-end" id="addcat">Add Front Product</button></div>
                </div>
            </div>
            <div class="card-body">
                <div id="cat_table">
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
                        <th>Front Type</th>
                        <th>Placement</th>
                        <th style="width: 85px;">Action</th>
                    </tr>
                 </thead>
                 <tbody>
                 <?php  
                  
                   $sql= "SELECT * FROM wb_store_front_products";
                   $run = mysqli_query($con, $sql);
                   $row = mysqli_num_rows($run);
                   if ($row > 0) 
                   {
                       $i=0;
                       while ($result=mysqli_fetch_assoc($run)) 
                       {
                          $datas[]=$result;
                       }
                       foreach ($datas as $value) 
                       {
                          $productid=$value['puic'];
                          $sql= "SELECT * FROM wb_product_catalogs WHERE `product_id`='$productid' ";
                          $run = mysqli_query($con, $sql);
                          $data = mysqli_fetch_assoc($run);
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
                            <td><?php echo $value['front_type']  ?></td>
                            <td><?php echo $value['placement']  ?></td>
                            <td class="table-action">
                                <a href="front_products.php?delete=<?php echo $value['id'] ?>" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                            </td>
                           </tr>
                           <?php
                       }  
                          
                   }   

                 ?>    
                   
                 </tbody>
                </table>
                </div>
                <form action="front_products.php" method="post" id="addform" style="display:none;">
                  <div class="mb-3 col-md-6">
                      <label for="inputEmail1" class="form-label">Enter Product Name</label>
                      <input type="text" class="form-control" id="inputEmail1" placeholder="Enter Product Name" name="product" required list="dataupsale">
                      <datalist id="dataupsale">
                          <?php echo $option_up; ?>
                      </datalist>
                  </div>
                  <div class="mb-3 col-md-6">
                      <label for="placement" class="form-label">Enter Front Type</label>
                      <select class="form-select" name="type" required>
                          <option>Select Front Type</option>
                          <option value="Featured Products">Featured Products</option>
                          <option value="New Arriavals">New Arriavals </option>
                          <option value="Deal of the Day">Deal of the Day </option>
                      </select>
                  </div>
                  <div class="mb-3 col-md-6">
                      <label for="placement" class="form-label">Enter Placement No</label>
                      <input type="number" class="form-control" id="placement" placeholder="Enter Product Placement" name="placement" required >
                  </div>
                  <div class="mb-3 col-md-6">
                      <button class="btn btn-primary float-end" name="submit">Add Product</button>
                  </div>
                   
               </form>  
            </div> <!-- end card-body -->
        </div> <!-- end card-->
    </div> <!-- end col -->
</div>
<!-- end row -->
        
</div> <!-- container -->

</div> <!-- content -->

                
<?php include('footer.php') ?>
<script type="text/javascript">
    $(document).ready(function(){
     $('#addcat').click(function(){
       $('#cat_table').hide();
       $('#addform').show(); 
     })
    });
</script>
</body>
</html>
<?php 

if (isset($_POST['submit'])) {

    $product = $_POST['product'];
    $type = $_POST['type'];
    $placement = $_POST['placement'];

    $sql = "SELECT * FROM `wb_store_front_products` WHERE `puic`='$product' AND `front_type`='$type'";
    $run = mysqli_query($con, $sql);
    $row = mysqli_num_rows($run);
    if ($row > 0) 
    {
        ?>
        <script type="text/javascript">
             swal('Checkout!','This product is already added for Store Front!','error')
                 .then(function(){
             window.location = "front_products.php";  
              });
         </script>
        <?php
    }
    else
    {
        $sql = "INSERT INTO `wb_store_front_products`(`front_type`, `puic`, `placement`) VALUES ('$type','$product','$placement')";
        $run = mysqli_query($con, $sql);
        if ($run) 
        {
            ?>
            <script type="text/javascript">
                 swal('Added!','This product added for Store Front!','success')
                     .then(function(){
                    window.location = "front_products.php";  
                  });
             </script>
            <?php
        }
    }

}

?>