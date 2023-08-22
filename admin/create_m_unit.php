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
    $sql = "DELETE FROM wb_measure_units WHERE `id`='$id'";
    $run = mysqli_query($con, $sql);
    header('location:create_m_unit.php');
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Ecommerece" name="author" />
    <title>Create Product Measure Units | Estore </title>
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
                        <li class="breadcrumb-item active">Create Measure Units</li>
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
                        <div class="col-6 p-3"><h4 class="text-muted">Product Measure Units Creation</h4></div>
                        <div class="col-6 p-3"><button  class="m-aut0 btn btn-primary float-end" id="addpro">Add New Unit</button></div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="pro_table">
                    <table class="table table-centered mb-0 text-center" id="basic-datatable">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Unit Short Name</th>
                                <th>Unit Full Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php
                           include('function.php');
                           $sql= "SELECT * FROM wb_measure_units";
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
                                        <td><?php echo $data['unit_short_name']; ?></td>
                                        <td><?php echo $data['unit_full_name']; ?></td>
                                        <td class="table-action">
                                             
                                            <a href="create_m_unit.php?delete=<?php echo $data['id']?>" class="btn btn-info btn-sm">Delete</a>
                                        </td>
                                    </tr>
                                   <?php
                               }
                               
                           }
                          ?>  
                            
                        </tbody>
                    </table>
                    </div>
                    <form action="create_m_unit.php" method="post"  id="addform" style="display:none;">
                        <div class="row g-2">
                            <div class="mb-3 col-md-6">
                                <label for="inputshort" class="form-label">Unit Short Name</label>
                                <input type="text" name="short" id="inputshort" placeholder="Enter Unit Name Like 'kg'" required class="form-control">
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="mb-3 col-md-6">
                                <label for="inputfull" class="form-label">Unit Full Name</label>
                                <input type="text" name="full" id="inputfull" placeholder="Enter Unit Name Like 'Kilograms'" required class="form-control">
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="mb-3 col-md-6">
                                <button type="submit" class="btn btn-primary float-end" name="submit">Create Unit</button>
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
</body>
</html>
<?php 


if (isset($_POST['submit'])) {

    $short =mysqli_real_escape_string($con, $_POST['short']);
    $full =mysqli_real_escape_string($con, $_POST['full']);
  
    $sql = "SELECT * FROM wb_measure_units WHERE unit_short_name = '$short' AND `unit_full_name`='$full'";
    $run = mysqli_query ($con, $sql);
    $row = mysqli_num_rows($run);
    if ($row > 0) 
    {
        ?>
         <script type="text/javascript">
             swal('Existed!','This Measure Unit is already registered !','error')
                 .then(function(){
              window.location = "create_m_unit.php";  
              });
         </script>
         <?php
    }
    else
    {

        $sql = "INSERT INTO `wb_measure_units`(`unit_short_name`, `unit_full_name`) VALUES ('$short','$full')";
        $run = mysqli_query($con,$sql);
        if ($run) 
        {
             ?>
             <script type="text/javascript">
                 swal('Created!','Measure Unit has been created Successfully !','success')
                     .then(function(){
                  window.location = "create_m_unit.php";  
                  });
             </script>
             <?php
             
        }
    }
   
    
}


?>