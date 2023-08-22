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

if (isset($_GET['reply_ticket']) && !empty($_GET['reply_ticket']) && isset($_GET['content_id']) && !empty($_GET['content_id'])) {
          
   $ticket_id = $_GET['reply_ticket'];
   $_SESSION['TICKET_ID']=$ticket_id;

   $content_id = $_GET['content_id'];
   $_SESSION['CONTENT_ID']=$content_id;
   $sql = "SELECT * FROM  `wb_ticket_content` WHERE `ticket_id`='$ticket_id'";
   $run = mysqli_query($con, $sql);
   $datas = mysqli_fetch_assoc($run);
   $_SESSION['TICKET_USER'] = $datas['user_id'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Ecommerece" name="author" />
    <title>Reply Support Ticket | Estore </title>
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
                        <li class="breadcrumb-item"><a href="supports_tickets.php">Support Tickets</a></li>
                        <li class="breadcrumb-item active">Reply Support Ticket</li>
                    </ol>
                </div>
                <h4 class="page-title">Dashboard</h4>
            </div>
        </div>
    </div>
        
    <!-- end page title --> 
    
    <!-- Form row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card" id="details" >
                <div class="card-header p-0 m-0">
                    <div class="row justify-content-between m-0">
                        <div class="col-6 p-3"><h4 class="text-muted">Support Ticket Details</h4></div>
                        <div class="col-6 p-3"><a href="supports_tickets.php" class="m-aut0 btn btn-primary float-end"><i class=" uil-left-arrow-to-left"></i> Back</a></div>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="conversation-list" data-simplebar style="max-height: 537px">
                    <?php 
                      
                      $userid=$_SESSION['TICKET_USER'];
                      $ticket_id=$_SESSION['TICKET_ID'];
                      $qry = "SELECT * FROM wb_user_details WHERE user_id = '$userid'";
                      $urun = mysqli_query($con, $qry);
                      $udata = mysqli_fetch_assoc($urun);

                      $query = "SELECT * FROM wb_ticket_content WHERE ticket_id = '$ticket_id'";
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
                    <div class="row">
                        <div class="col">
                            <div class="mt-2 bg-light p-3 rounded">
                                <form class="needs-validation" name="chat-form"
                                    id="chat-form" action="reply_ticket.php" method="post">
                                    <div class="row">
                                        <div class="col mb-2 mb-sm-0">
                                            <textarea class="form-control border-0" required name="reply" placeholder="Enter your reply"></textarea>
                                            <div class="invalid-feedback">
                                                Please enter your reply
                                            </div>
                                        </div>
                                        <div class="col-sm-auto">
                                            <div class="btn-group">
                                                <a href="#" class="btn btn-light"><i class="uil uil-paperclip"></i></a>
                                                <a href="#" class="btn btn-light"> <i class='uil uil-smile'></i> </a>
                                                <div class="d-grid">
                                                    <input type="hidden" name="ticket_id" value="<?php echo $ticket_id ?>">
                                                    <input type="hidden" name="userid" value="<?php echo $userid ?>">
                                                    <input type="hidden" name="admin_name" value="<?php echo $data['username'] ?>">
                                                    <input type="hidden" name="admin_id" value="<?php echo $data['id'] ?>">
                                                    <button type="submit" class="btn btn-success chat-send" name="submit"><i class='uil uil-message'></i></button>
                                                </div>
                                            </div>
                                        </div> <!-- end col -->
                                    </div> <!-- end row-->
                                </form>
                            </div> 
                        </div> <!-- end col-->
                    </div>
                    <!-- end row -->
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
<?php 

if (isset($_POST['submit'])) {

    $userid=$_POST['userid'];
    $ticket_id=$_POST['ticket_id'];
    $admin_id=$_POST['admin_id'];
    $admin_name=$_POST['admin_name'];
    $reply=$_POST['reply'];
    $content_id=$_SESSION['CONTENT_ID'];

    $sql ="INSERT INTO `wb_ticket_content`(`ticket_id`, `type`, `comment`, `reply_admin_name`, `reply_admin_id`) VALUES ('$ticket_id','Answer','$reply','$admin_name','$admin_id')";
    $run = mysqli_query($con,$sql);

    if ($run) {

        $qry = "UPDATE `wb_ticket_content` SET `status`= 'replied' WHERE `id`='$content_id'";
        $run = mysqli_query($con, $qry);

        if ($run) 
        {
            ?>
             <script type="text/javascript">
                 swal('Replied!','Reply has been registered successfully !','success')
                     .then(function(){
                  window.location = "reply_ticket.php";  
                  });
             </script>
             <?php
        }

        
    }
	   
    
}


?>