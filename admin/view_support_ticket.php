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
    <title>Support Ticket Details | Estore </title>
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
                        <li class="breadcrumb-item"><a href="dashboard.php">Tickets History</a></li>
                        <li class="breadcrumb-item active">View Support Ticket</li>
                    </ol>
                </div>
                <h4 class="page-title">Dashboard</h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 
    <div class="row">
        <div class="col-sm-12">
            <!-- Profile -->
            <div class="card bg-primary">
                <div class="card-body profile-user-box">
            <?php 
              if (isset($_GET['view_ticket']) && !empty($_GET['view_ticket'])) {
                  
                  $id = $_GET['view_ticket'];
                  $sql = "SELECT * FROM  `wb_support_tickets` WHERE `id`='$id'";
                  $run = mysqli_query($con, $sql);
                  $datas = mysqli_fetch_assoc($run);
                
                  ?>
                  <div class="row">
                        <div class="col-sm-8">
                            <div class="row align-items-center">
                                <div class="col">
                                    <div>
                                        <table class="table table-info m-auto">
                                            <tr>
                                                <th>Support Ticket Id</th>
                                                <td><?php echo $datas['ticket_id'] ?></td>
                                            </tr>
                                            <tr>
                                                <th>Ticket Created By </th>
                                                <td><?php echo $datas['user_name'] ?> / <?php echo $datas['user_id'] ?></td>
                                            </tr>
                                            <tr>
                                                <th>Ticket Created On </th>
                                                <td><?php echo $datas['create_date'] ?></td>
                                            </tr>
                                            <tr>
                                                <th>Ticket Status </th>
                                                <td><?php echo $datas['status'] ?></td>
                                            </tr>
                                            <tr>
                                                <th>Last Action on </th>
                                                <td><?php echo $datas['last_action'] ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end col-->

                        <div class="col-sm-4">
                            <div class="text-center mt-sm-0 mt-3 text-sm-end">
                                <button type="button" class="btn btn-light" id="profile">
                                    <i class="mdi mdi-account-edit me-1"></i> View Communication
                                </button>
                            </div>
                        </div> <!-- end col-->
                  </div> <!-- end row -->
                  <?php
              }
              else
              {

              }
            ?>        
                    

                </div> <!-- end card-body/ profile-user-box-->
            </div><!--end profile/ card -->
        </div> <!-- end col-->
    </div>
    <!-- end row -->
    <!-- Form row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card" id="details" style="display: none;">
                <div class="card-header p-0 m-0">
                    <div class="row justify-content-between m-0">
                        <div class="col-12 p-3"><h4 class="text-muted">Support Ticket Details</h4></div>
                        
                    </div>
                </div>
                <div class="card-body">
                    <ul class="conversation-list" data-simplebar style="max-height: 537px">
                    <?php 
                      
                      $userid = $datas['user_id'];
                      $qry = "SELECT * FROM wb_user_details WHERE user_id = '$userid'";
                      $urun = mysqli_query($con, $qry);
                      $udata = mysqli_fetch_assoc($urun);

                      $query = "SELECT * FROM wb_ticket_content WHERE ticket_id = '$id'";
                      $trun = mysqli_query($con ,$query);
                      $row = mysqli_num_rows($trun);

                      if ($row > 0) 
                      {
                          while ($tdata = mysqli_fetch_assoc($trun)) {

                              if ($tdata['type']=='Question') {
                                  ?>
                                  <li class="clearfix">
                                    <div class="chat-avatar">
                                        <img src="assets/images/users/<?php echo $udata['user_image'] ?>" class="rounded" alt="User Image" />
                                        
                                    </div>
                                    <div class="conversation-text">
                                        <div class="ctext-wrap">
                                            <i><?php echo $udata['username'] ?></i>
                                            <p>
                                                <?php echo $tdata['comment'] ?>
                                            </p>
                                            <span><?php echo $tdata['action_time'] ?></span>
                                        </div>
                                    </div>
                                    
                                </li>
                                  <?php
                              }
                              else
                              {
                                 ?>
                                 <li class="clearfix odd">
                                    <div class="chat-avatar">
                                        <img src="assets/images/users/<?php echo $data['admin_image'] ?>" class="rounded" alt="dominic" />
                                        
                                    </div>
                                    <div class="conversation-text">
                                        <div class="ctext-wrap">
                                            <i>Admin - <?php echo $data['username'] ?></i>
                                            <p>
                                                <?php echo $tdata['comment'] ?>
                                            </p>
                                            <span><?php echo $tdata['action_time'] ?></span>
                                        </div>
                                    </div>
                                 </li>
                                 <?php 
                              }
                          }
                      }

                    ?>  
                    </ul>
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
      $('#profile').click(function(){
        $('#details').toggle();
      });
    });
</script>
</body>
</html>
