<!DOCTYPE html>
<html lang="en">
    
<!-- Mirrored from coderthemes.com/hyper/saas/pages-recoverpw.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 21 Jul 2021 10:16:55 GMT -->
<head>
        <meta charset="utf-8" />
        <title>Recover Password | Hyper - Responsive Bootstrap 5 Admin Dashboard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- App css -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="light-style" />
        <link href="assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="dark-style" />

    </head>

    <body class="loading authentication-bg" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>

        <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xxl-4 col-lg-5">
                        <div class="card">
                            <!-- Logo -->
                            <div class="card-header pt-3 pb-3 text-center bg-primary">
                                <h4 class="text-white">E-Commerce</h4>
                            </div>
                            
                            <div class="card-body p-4">
                                
                                <div class="text-center w-75 m-auto">
                                    <h4 class="text-dark-50 text-center mt-0 fw-bold">Reset Password</h4>
                                    <p class="text-muted mb-4">Enter your email address and we'll send you an email with instructions to reset your password.</p>
                                </div>

                                <form action="recoverpw.php" method="post">
                                    <div class="mb-3">
                                        <label for="emailaddress" class="form-label">Email address</label>
                                        <input class="form-control" type="email" id="emailaddress" required="" placeholder="Enter your email" name="email">
                                    </div>

                                    <div class="mb-0 text-center">
                                        <button class="btn btn-primary" type="submit" name="submit">Reset Password</button>
                                    </div>
                                </form>
                            </div> <!-- end card-body-->
                        </div>
                        <!-- end card -->

                        <div class="row mt-3">
                            <div class="col-12 text-center">
                                <p class="text-muted">Back to <a href="index.php" class="text-muted ms-1"><b>Log In</b></a></p>
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->

<footer class="footer footer-alt">
© <?php echo date('Y')?> StoreName - By Lifetech.com
</footer>

<!-- bundle -->
<script src="assets/js/vendor.min.js"></script>
<script src="assets/js/app.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>         
</body>
</html>
<?php 
include('dbcon.php');

if (isset($_POST['submit'])) 
{
  $email=$_POST['email'];

  $query="SELECT * FROM `wb_admin` WHERE `email`='$email'";
  $run=mysqli_query($con,$query);
  $row=mysqli_num_rows($run);
  

  if ($row > 0) 
  { 
    $data=mysqli_fetch_assoc($run);
    $name=$data['username'];
    $str=substr($name, 0, 3);
    $new_password=$str.rand(10000,99999);

    $query="UPDATE `wb_admin` SET `password`='$new_password' WHERE `email`='$email'";
    $run=mysqli_query($con,$query);
    
    if ($run) 
    {
        
        $mail = new PHPMailer;

        $mail->SMTPDebug = 3;                               // Enable verbose debug output

        $mail->isSMTP();                                    // Set mailer to use SMTP
        $mail->Host = 'smtp.hostinger.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = '';                 // SMTP username
        $mail->Password = '';                // SMTP password
        $mail->SMTPSecure = 'ssl';           // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 465;

        $mail->setFrom('', 'Admin Support');
        $mail->addAddress($email, 'Admin');     //Add a recipient
        // $mail->addAddress('ellen@example.com');               //Name is optional
        // $mail->addReplyTo('info@example.com', 'Information');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');


        //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Here is the subject';
        $mail->Body    = '<div style="margin-left:10px; margin-right:10px; padding:20px; width:600px;">
                            <h3 style="font-family: Arial, Helvetica, sans-serif; text-align:left;line-height:2.5em;">Hey ".$name." !</h3>
                            <h1 style="margin-bottom:5px; font-family: Microsoft Sans Serif, Helvetica, sans-serif;color:#5E5D97">Account Password Recovery</h1>
                            <p style="margin-top:0px;">Your account password has been changed successfully.Please login using this password. Let’s get started!</p>
                            <hr>
                            <table >
                            <tr >
                            <td style="text-align:center">
                            <div style="width:600px;">
                            <h3 style="font-family: Arial, Helvetica, sans-serif; text-align:left; color:#5E5D97; line-height:2.5em;">".$new_password."</h3>
                            </div>
                            </td>
                            </tr>

                            </table>


                            <table>
                            <tr>

                            <td><div style="float:left;"><p style="font-family: Allura, cursive, Arial,Helvetica, sans-serif; font-size:30px">Comapny Name</p></div></td>
                            </tr>
                            </table>

                            <div style="text-align:left;">
                            <p style="font-size:14px;">
                            Comapny Name<br>
                            Address, INDIA, 203131<br>

                            </div>
                            </div>';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        

          if(!$mail->send()) 
          {
             
          } 
          else 
          {
                ?>
                  <script type="text/javascript">
                    swal("Sent", "New Password has been sent to your registered email", "success")
                    .then(function(){
                      window.location="login.php";
                    })
                  </script>
                <?php
          }
        
    }

  }
  else
  {
    ?>
      <script type="text/javascript">
        swal("Sorry!", "Entered Email is not Registered with Us", "error")
        .then(function(){
          window.location="forget_password.php";
        })
      </script>
    <?php
  }
  
}

?>
