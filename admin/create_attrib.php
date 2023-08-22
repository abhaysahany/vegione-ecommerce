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

if (isset($_GET['delete']) && !empty($_GET['delete'])) {
    
    $id = $_GET['delete'];
    $sql = "DELETE FROM wb_product_attribute WHERE `id`='$id'";
    $run = mysqli_query($con, $sql);
    header('location:create_attrib.php');
}

$sql = "SELECT * FROM `wb_category` WHERE `status` = 'Active' ";
$run = mysqli_query($con, $sql);
$row = mysqli_num_rows($run);
if ($row > 0) 
{
    $option = "<option>Select Category</option>";
    while ($data_a=mysqli_fetch_assoc($run)) 
    {

        $option .="<option value=".$data_a['id'].">".$data_a['category']."</option>";
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
    <title>Create Product Attribute | Estore </title>
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
                        <li class="breadcrumb-item active">Create Attribute</li>
                    </ol>
                </div>
                <h4 class="page-title">Dashboard</h4>
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
                        <div class="col-6 p-3"><h4 class="text-muted">Product Attribute Creation</h4></div>
                        <div class="col-6 p-3"><button  class="m-aut0 btn btn-primary float-end" id="addpro">Add New Attribute</button></div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="pro_table">
                    <table class="table table-centered mb-0 text-center" id="basic-datatable">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Category Name</th>
                                <th>Product Name</th>
                                <th>Attribute Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php
                           include('function.php');
                           $sql= "SELECT * FROM wb_product_attribute";
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
                                        <td><?php echo $i ?></td>
                                        <td><?php $category_id=$data['category_id']; 
                                         echo getCatName($category_id,$con) ?></td>
                                        <td><?php $product_id=$data['product_id']; 
                                         echo getProName($product_id,$con) ?></td>
                                        <td><?php echo $data['attrib_name'] ?></td>
                                        <td class="table-action">
                                             
                                            <a href="create_attrib.php?delete=<?php echo $data['id']?>" class="btn btn-info btn-sm">Delete</a>
                                        </td>
                                    </tr>
                                   <?php
                               }
                               
                           }
                          ?>  
                            
                        </tbody>
                    </table>
                    </div>
                    <form action="create_attrib.php" method="post"  id="addform" style="display:none;">
                        <div class="row g-2">
                            <div class="mb-3 col-md-6">
                                <label for="inputEmail1" class="form-label">Category Name</label>
                                <select class="form-select" name="category" required id="category">
                                    <?php echo $option; ?>
                                </select>
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="mb-3 col-md-6">
                                <label for="inputEmail1" class="form-label">Product Name</label>
                                <select class="form-select" name="product" required id="product">
                                    <option id="opt">Select Product</option>
                                </select>
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="mb-3 col-md-6">
                                <label for="inputattrib" class="form-label">Attribute Name</label>
                                <input type="text" name="attrib" id="inputattrib" placeholder="Enter Attribute Name" required class="form-control">
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="mb-3 col-md-6">
                                <button type="submit" class="btn btn-primary float-end" name="submit">Create Attribute</button>
                            </div>
                        </div>
                        
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
     $('#addpro').click(function(){
       $('#pro_table').hide();
       $('#addform').show(); 
     })
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
      $('#category').on('change', function(){
        var catId = $(this).val();
        if (catId){
          $.ajax({
            type : 'POST',
            url  : 'get_data.php',
            data : 'cat_id='+catId,
            success:function(html){
                $('#product').html(html);
            }
          })
        }
      })
    });
</script>
</body>
</html>
<?php 


if (isset($_POST['submit'])) {

    $cat_id =mysqli_real_escape_string($con, $_POST['category']);
    $pro_id =mysqli_real_escape_string($con, $_POST['product']);
    $attrib =mysqli_real_escape_string($con, $_POST['attrib']);
  
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