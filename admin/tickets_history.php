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

if (isset($_GET['close']) && !empty($_GET['close'])) {

    $id = $_GET['close'];
    $sql = "UPDATE `wb_support_tickets` SET `status`='Closed' WHERE `id`='$id'";
    $run = mysqli_query($con, $sql);
    header('location:tickets_history.php');

}elseif (isset($_GET['open']) && !empty($_GET['open'])) {

    $id = $_GET['open'];
    $sql = "UPDATE `wb_support_tickets` SET `status`='Open' WHERE `id`='$id'";
    $run = mysqli_query($con, $sql);
    header('location:tickets_history.php');

}elseif (isset($_GET['delete']) && !empty($_GET['delete'])) {

    $id = $_GET['delete'];
    $sql = "DELETE FROM  `wb_support_tickets` WHERE `id`='$id'";
    $run = mysqli_query($con, $sql);

    $sqls = "DELETE FROM  `wb_ticket_content` WHERE `ticket_id`='$id'";
    $run = mysqli_query($con, $sqls);

    header('location:tickets_history.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Ecommerece" name="author" />
    <title>Tickets History | Estore </title>
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
                        <li class="breadcrumb-item active">Tickets History</li>
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
                                <th>Ticket Id</th>
                                <th>Created By</th>
                                <th>Create Time</th>
                                <th>Last Action</th>
                                <th>Status</th>
                                <th >Action on Ticket ?</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php
                           
                           $sql= "SELECT * FROM wb_support_tickets ORDER BY create_date ASC";
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
                                        <td><?php echo $data['ticket_id'] ?></td>
                                        <td><?php echo $data['user_id'] ?></td>
                                        <td><?php echo $data['create_date'];  ?></td>
                                        <td><?php echo $data['last_action'];  ?></td>
                                        <td><?php echo $data['status'] ?></td>
                                        <td class="table-action">
                                            <?php 
                                             if ($data['status']=='Closed') {
                                                 ?><a href="tickets_history.php?open=<?php echo $data['id']?>" class="btn btn-success btn-sm">Open</a><?php
                                             }else{
                                                ?><a href="tickets_history.php?close=<?php echo $data['id']?>" class="btn btn-danger btn-sm">Close</a><?php
                                             }
                                            ?>
                                            
                                            <a href="view_support_ticket.php?view_ticket=<?php echo $data['id']?>" class="btn btn-info btn-sm">View</a>
                                            <a href="tickets_history.php?delete=<?php echo $data['id']?>" class="btn btn-dark btn-sm">Delete</a>
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