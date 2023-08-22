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
    $sql = "DELETE FROM wb_contact_us WHERE `id`='$id'";
    $run = mysqli_query($con, $sql);
    header('location:web_message.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Ecommerece" name="author" />
    <title>Website Messages | Estore </title>
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
                        <li class="breadcrumb-item active">Website Messages</li>
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
                        <div class="col-6 p-3"><h4 class="text-muted">Contact Us Messages</h4></div>
                        
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-centered mb-0 text-center">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Message Date</th>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th>Comment</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php
                           
                           $sql= "SELECT * FROM wb_contact_us ORDER BY msg_date DESC";
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
                                        <td class="p-0"><?php echo  date('d-m-Y', strtotime($data['msg_date']))   ?></td>
                                        <td><?php echo $data['name'] ?></td>
                                        <td><?php echo $data['mobile'] ?></td>
                                        <td><?php echo $data['email'] ?></td>
                                        <td><?php echo substr($data['message'], 0, 20). ".."  ?></td>
                                        <td class="table-action">
                                            <a href="view_web_message.php?view=<?php echo $data['id']?>" class="btn btn-success btn-sm"> View </a>
                                            <a href="web_message.php?delete=<?php echo $data['id']?>" class="btn btn-info btn-sm"> Delete </a>
                                        </td>
                                    </tr>
                                   <?php
                               }
                               
                           }
                           else
                           {
                               ?>
                               <tr>
                                    <td>There is no data to Dispaly</td>
                                    
                                </tr>
                               <?php
                           }
                          ?>  
                            
                        </tbody>
                    </table>
                                                    
                        
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
</body>
</html>