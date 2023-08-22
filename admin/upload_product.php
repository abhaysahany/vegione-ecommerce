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
    $option='';
    while ($data=mysqli_fetch_assoc($run)) 
    {

        $option .="<option value=".$data['id'].">".$data['category']."</option>";
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
    <title>Upload Products | Estore </title>
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
                        <li class="breadcrumb-item active">Upload Product</li>
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
                        <div class="col-6 p-3"><h4 class="text-muted">Upload Products</h4></div>
                        <!-- <div class="col-6 p-3"><button  class="m-aut0 btn btn-primary float-end" id="addpro">Add New Attribute</button></div> -->
                    </div>
                </div>
                <div class="card-body">
                    <form action="create_attrib.php" method="post"  id="addform" >
                        <div class="row g-3 justify-content-center" style="height:300px;">
                            <div class="mb-3 col-md-3 mt-4">
                                <div class="text-center">
                                    <h2 class="mt-0"><i class="mdi mdi-check-all"></i></h2>
                                    <h3 class="mt-0">Selection !</h3>
                                    <h5 class="mt-0">Product Selection Wizard</h5>

                                    <p class="w-100 mb-2 mx-auto">Select category and product name from given select option to upload your Product</p>

                                    
                                </div>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="inputEmail1" class="form-label">Category Name</label>
                                <select class="form-select" name="category" required id="category" size="10" style="overflow:auto">
                                    <?php echo $option; ?>
                                </select>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="inputEmail1" class="form-label">Product Name</label>
                                <select class="form-select" name="product" required id="product" size="10" style="overflow:auto" onchange="javascript:HandleSelect(this)">
                                    <option id="opt">Select Category for Product Selection</option>
                                </select>
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
      $('#category').on('change', function(){
        var catName = $(this).val();
        if (catName){
          $.ajax({
            type : 'POST',
            url  : 'get_data.php',
            data : 'cat_id_upload='+catName,
            success:function(html){
                $('#product').html(html);
            }
          })
        }
      })
    });
</script>
<script type="text/javascript">
    function HandleSelect(elm){
        window.location=elm.value;
    }
</script>
</body>
</html>
