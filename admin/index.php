<?php
include('dbcon.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8" />
        <title>Log In | Hyper - Responsive Bootstrap 5 Admin Dashboard</title>
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
                    <div class="card" style="box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.2), -5px -5px 5px rgba(0, 0, 0, 0.2);">

                        <!-- Logo -->
                        <!-- <div class="card-header pt-3 pb-3 text-center bg-primary">
                            <a href="index.html">
                                <span><img src="assets/images/logo.png" alt="" height="15"></span>
                            </a>
                        </div>
                        -->
                        <div class="card-body p-4 pt-2 pb-2">
                            
                            <div class="text-center m-auto">
                                <h4 class="text-dark-50 text-center pb-0 fw-bold">Sign In</h4>
                                <p class="text-muted mb-4">Enter your User Name and password to access admin panel.</p>
                            </div>

                            <form action="index.php" method="post">

                                <div class="mb-3">
                                    <label for="emailaddress" class="form-label">User Name</label>
                                    <input class="form-control" type="text" id="emailaddress" required placeholder="Enter your Username" name="username">
                                </div>

                                <div class="mb-3">
                                    <a href="recoverpw.php" class="text-muted float-end"><small>Forgot your password?</small></a>
                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="password" class="form-control" placeholder="Enter your password" name="password" required>
                                        <div class="input-group-text" data-password="false">
                                            <span class="password-eye"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 mb-3">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="checkbox-signin" name="remember">
                                        <label class="form-check-label" for="checkbox-signin">Remember me</label>
                                    </div>
                                </div>

                                <div class="mb-3 mb-0 text-center">
                                    <button class="btn btn-primary" type="submit" name="submit"> Log In </button>
                                </div>

                            </form>
                        </div> <!-- end card-body -->
                    </div>
                    <!-- end card -->

                    <div class="row mt-3">
                        <div class="col-12 text-center">
                            <p class="text-muted">Don't have an account? <a href="javascript:;" class="text-muted ms-1"><b>Sign Up</b></a></p>
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

if (isset($_POST['submit'])) {

    $username =mysqli_real_escape_string($con, $_POST['username']);
    $password =mysqli_real_escape_string($con, $_POST['password']);
    if (isset($_POST['remember'])) {
       $remember =$_POST['remember'];
    }else{
       $remember ="off";
    }
   

    $sql = "SELECT * FROM wb_admin WHERE username = '$username' AND password = '$password'";
    $run = mysqli_query($con,$sql);
    $row = mysqli_num_rows($run);

    $msg="";
    if ($row > 0) 
    {
         $data = mysqli_fetch_assoc($run);
         $status = $data['status'];

         if ($status=='Deactive') 
         {
             ?>
             <script type="text/javascript">
                 swal('Checkout!','Your account has been Deactivated ! Please contact Superadmin','error')
                 .then(function(){
                    window.location = "index.php";
                 })
             </script>
             <?php
         }
         else{

             if ($remember =='on') 
             {
                 $name = "USER_ADMIN";
                 $value = $data['id'];

                 setcookie($name, $value, time() + (86400 * 30), "/");
                 header('location:dashboard.php');
             }
             else
             {
                
                $_SESSION['USER_ADMIN'] = $data['id'];
                header('location:dashboard.php');
             }
         }
         
         
    }
    else{
           
         ?>
         <script type="text/javascript">
             swal('Checkout!','Username and Password do not Match ! Please try again','error')
             .then(function(){
                window.location = "index.php";
             })
         </script>
         <?php  
          
    } 
}


?>