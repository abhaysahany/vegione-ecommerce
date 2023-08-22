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

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Ecommerece" name="author" />
    <title>Support Tickets | Estore </title>
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
                        <li class="breadcrumb-item active">Support Tickets</li>
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
                        <div class="col-6 p-3"><h4 class="text-muted">Pending Support Tickets</h4></div>
                        <!-- <div class="col-6 p-3"><a href="create_admin.php" class="m-aut0 btn btn-primary float-end">Back</a></div> -->
                    </div>
                </div>
                <div class="card-body">
                    <table id="basic-datatable" class="table table-centered mb-0 text-center">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>User Id</th>
                                <th>Type</th>
                                <th>Comments</th>
                                <th>Create Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php
                           
                           $sql= "SELECT * FROM wb_ticket_content WHERE status = 'asked'";
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
                                        <td class="p-0"><?php echo $data['user_id'] ?></td>
                                        <td><?php echo $data['type'] ?></td>
                                        <td><?php echo substr($data['comment'], 0, 20)." ....";  ?></td>
                                        <td><?php echo $data['action_time'] ?></td>
                                       
                                        <td class="table-action">
                                            <a href="reply_ticket.php?reply_ticket=<?php echo $data['ticket_id']?>&content_id=<?php echo $data['id']?>" class="btn btn-info btn-sm">Reply</a>
                                        </td>
                                    </tr>
                                   <?php
                               }
                               
                           }
                           else
                           {
                               ?>
                               <tr>
                                  <td colspan="6">There is no data to Dispaly</td>
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