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

if (isset($_GET['product_id']) && !empty($_GET['product_id'])) {
    
    $_SESSION['product_id']= $_GET['product_id'];
}

if (isset($_SESSION['product_id']) && isset($_SESSION['product_id'])) {
    // code...
}
else{
    header('location:upload_product.php');
}

$sql = "SELECT * FROM `wb_measure_units`";
$run = mysqli_query($con, $sql);
$row = mysqli_num_rows($run);
if ($row > 0) 
{
    $option = "<option>Select Measure Unit</option>";
    while ($data_p=mysqli_fetch_assoc($run)) 
    {

        $option .="<option value=".$data_p['unit_short_name'].">".$data_p['unit_short_name'].' - '.$data_p['unit_full_name']."</option>";
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
    <title>List Product | Estore </title>
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
                        <li class="breadcrumb-item"><a href="upload_product.php">Upload Product</a></li>
                        <li class="breadcrumb-item active">List Product</li>
                    </ol>
                </div>
                <h4 class="page-title">Dashboard</h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 
    <!-- Form row -->
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body" style="min-height:300px;">
            <h4 class="header-title mb-3">New Product Listing</h4>
               <div id="progressbarwizard">
                  <ul class="nav nav-pills nav-justified form-wizard-header mb-3">
                        <li class="nav-item">
                            <a href="#account-2" data-bs-toggle="tab" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                <i class="mdi mdi-text-box-multiple me-1"></i>
                                <span class="d-none d-sm-inline">Key Details</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#profile-tab-2" data-bs-toggle="tab" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                <i class="mdi mdi-cart-variant me-1"></i>
                                <span class="d-none d-sm-inline">Product Details</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#image-2" data-bs-toggle="tab" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                <i class="mdi mdi-image me-1"></i>
                                <span class="d-none d-sm-inline">Image</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#finish-2" data-bs-toggle="tab" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                <i class="mdi mdi-checkbox-marked-circle-outline  me-1"></i>
                                <span class="d-none d-sm-inline">Finish Listing </span>
                            </a>
                        </li>
                  </ul>
                
                  <div class="tab-content b-0 mb-0">

                    <!-- <div id="bar" class="progress mb-3" style="height: 7px;">
                        <div class="bar progress-bar progress-bar-striped progress-bar-animated bg-success" style="width: 50%;" aria-valuenow="25" aria-valuemin="0"></div>
                    </div> -->
                    <div class="tab-pane active" >
                        <div class="row">
                            <div class="col-12">
                                <div class="text-center">
                                    <h2 class="mt-0"><i class="mdi mdi-check-all"></i></h2>
                                    <h3 class="mt-0">Welcome !</h3>
                                    <h5 class="mt-0">Product Listing Wizard</h5>

                                    <p class="w-75 mb-2 mx-auto">Start listing your prodcut for your E commerse store. Make sure to fill all details before finish listing tab.</p>

                                    
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->
                    </div>
                    <div class="tab-pane" id="account-2">
                        <div class="row">
                            <div class="col-12">
                              <form action="insert_listing.php" method="post">
                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label" for="password1"> SKU</label>
                                    <div class="col-md-9">
                                        <input type="text" id="password1" name="sku" class="form-control" placeholder="Enter SKU Code" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label" for="confirm1">Brand Name</label>
                                    <div class="col-md-9">
                                        <input type="text" id="confirm1" name="brand" class="form-control" placeholder="Enter Brand Name" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label" for="confirm1">Model No</label>
                                    <div class="col-md-9">
                                        <input type="text" id="confirm1" name="model" class="form-control" placeholder="Enter Model No" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label" for="name1">Max Price</label>
                                    <div class="col-md-9">
                                        <input type="number" id="name1" name="mrp" class="form-control" placeholder="Enter Item MRP" required min="0" step=".01">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label" for="surname1"> Min Price</label>
                                    <div class="col-md-9">
                                        <input type="number" id="surname1" name="minprice" class="form-control" placeholder="Enter Selling Price" required min="0" step=".01">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label" for="surname1"> Stock</label>
                                    <div class="col-md-9">
                                        <input type="number" id="surname1" name="stock" class="form-control" placeholder="Enter Item Stock" min="0" required>
                                    </div>
                                </div>       
                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label" for="email1">Measure Unit</label>
                                    <div class="col-md-9">
                                        <select class="form-select" name="unit" required>
                                            <?php echo $option ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3 ">
                                    <label class="form-check-label col-md-3" for="tax"> Tax Status</label>
                                    <div class="col-md-9">
                                    <div class="form-check  ">
                                        <input type="radio" class="form-radio-input " name="taxcheck" id="tax" value="taxable">
                                        <label class="form-check-label me-3" for="tax"> Taxable</label>
                                        <input type="radio" class="form-radio-input " name="taxcheck" id="notax" value="nontaxable">
                                        <label class="form-check-label" for="tax"> Non Taxable</label>
                                    </div>
                                    </div>
                                </div>
                                <div class="row mb-3" style="display:none" id="taxinput">
                                    <label class="col-md-3 col-form-label" for="email1">Tax Rate</label>
                                    <div class="col-md-9">
                                        <input type="number" name="taxrate" class="form-control" placeholder="Enter Tax Rate">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <button class="btn btn-primary float-end" name="key_details">Save Details</button>
                                    </div>
                                </div>
                                </form>
                            </div> <!-- end col -->
                        </div> <!-- end row -->
                    </div>

                    <div class="tab-pane" id="profile-tab-2">
                        <div class="row">
                            <div class="col-12">
                              <form action="insert_listing.php" method="post">
                                <?php 
                                  $productid=$_SESSION['product_id'];
                                  $query="SELECT * FROM `wb_product_attribute` WHERE `product_id`='$productid'";
                                  $run=mysqli_query($con,$query);
                                  $row = mysqli_num_rows($run);
                                  if ($row > 0)
                                  {
                                      while($row = mysqli_fetch_assoc($run))
                                      {
                                          $datas[]=$row['attrib_name'];
                                      }
                                      foreach($datas as $key => $value)
                                      {
                                          if ($value!='') 
                                          {
                                            ?>
                                             <div class="row mb-3" >
                                                <label class="col-md-3 col-form-label" for="email1"><?php echo $value;  ?></label>
                                                <div class="col-md-9">
                                                    <input type="text" name="data[<?php echo $value;  ?>]" class="form-control" placeholder="Enter Value" required>
                                                </div>
                                            </div>
                                            <?php
                                          }
                                          
                                      }
                                  }

                                  
                                ?>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <button class="btn btn-primary float-end" name="pro_details">Save Details</button>
                                    </div>
                                </div> 
                              </form>
                            </div> <!-- end col -->
                        </div> <!-- end row -->
                    </div>

                    <div class="tab-pane" id="image-2">
                        
                       <form action="insert_listing.php" method="post"  enctype="multipart/form-data">
                         <div class="row justify-content-center">
                            <div class="col-md-4 align-self-center">
                              <div class="card-body ">
                                 <div class="card">
                                    <img class="card-img-top align-self-center small" src="../images/products/empty.jpg" alt="Product-img" id="Img1" style="width:16rem; height:17rem;" required>
                                 </div>
                              </div>
                              <div class="input-group mb-3">
                                 <div class="custom-file">
                                 <input type="file" class="form-control" name="product_image" required onchange="document.getElementById('Img1').src = window.URL.createObjectURL(this.files[0])"> 
                                 
                                </div>
                              </div>
                              <button class="btn btn-primary float-end" name="save_image">Save Image</button>
                            </div> <!-- end col -->
                          </div> <!-- end row -->
                        </form>
                    </div>

                    <div class="tab-pane" id="finish-2">
                        <div class="row">
                            <div class="col-12">
                               <form action="insert_listing.php" method="post">
                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label" for="userName1">Shipping Charges</label>
                                    <div class="col-md-9">
                                        <input type="number" class="form-control" id="userName1" name="ship_charge" placeholder="Enter Shipping Charges Per Unit" required="">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label" for="userName1">Short Description</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="userName1" name="shortdes" placeholder="Enter Item Name">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label" for="password1">Description</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" name="description" placeholder="Enter Full Description"></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label" for="confirm1">Keyword</label>
                                    <div class="col-md-9">
                                        <input type="text" id="confirm1" name="keyword" class="form-control" placeholder="Enter Keyword">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <button class="btn btn-primary float-end" name="finish">Finish Listing</button>
                                    </div>
                                </div>
                               </form>  
                            </div> <!-- end col -->
                        </div> <!-- end row -->
                    </div>

                  </div> <!-- tab-content -->
               </div> <!-- end #progressbarwizard-->
            </form>
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
      $('#tax').change(function(){
        if (this.checked) {
          $('#taxinput').show();  
        }
      })
      $('#notax').change(function(){
        if (this.checked) {
          $('#taxinput').hide();  
        }
      })  
    })
</script>
</body>
</html>
<?php 


if (isset($_POST['submit'])) {

    $category =mysqli_real_escape_string($con, $_POST['category']);
    $product =mysqli_real_escape_string($con, $_POST['product']);
    $attrib =mysqli_real_escape_string($con, $_POST['attrib']);
    $cat_id = getCatId($category,$con);
    $pro_id = getProId($product,$category,$con);
  
    $sql = "SELECT * FROM wb_product_attribute WHERE attrib_name = '$attrib' AND `product_id`='$pro_id'";
    $run = mysqli_query ($con, $sql);
    $row = mysqli_num_rows($run);
    if ($row > 0) 
    {
        ?>
         <script type="text/javascript">
             swal('Existed!','This product Attribute is already registered !','error')
                 .then(function(){
              window.location = "create_attrib.php";  
              });
         </script>
         <?php
    }
    else
    {

        $sql = "INSERT INTO `wb_product_attribute`(`product_id`, `category_id`, `attrib_name`) VALUES ('$pro_id','$cat_id','$attrib')";
        $run = mysqli_query($con,$sql);
        if ($run) 
        {
             ?>
             <script type="text/javascript">
                 swal('Created!','Product Attribute has been created Successfully !','success')
                     .then(function(){
                  window.location = "create_attrib.php";  
                  });
             </script>
             <?php
             
        }
    }
   
    
}


?>