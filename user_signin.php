<?php  
include('admin/dbcon.php');
include('insert_cart.php');

if (isset($_GET['checkout'])) {
  $_SESSION['checkout']=$_GET['checkout'];
}else{
  $_SESSION['checkout']=0;
}
?>
<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
    <title>Vegefoods - Free Bootstrap 4 Template by Colorlib</title>
<?php include('header.php') ?>     
    

    <section class="ftco-section contact-section bg-light">
      <div class="container">
      	
        <div class="row block-9">
          <div class="col-md-6  d-flex">

            <form action="user_signin" class="bg-white p-5 contact-form" method="post">
              <h3 class="text-center mb-4">Login Form</h3>
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Your Email" name="email" required>
              </div>
              <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Your Password" required>
              </div>
              <div class="form-group">
                <input type="hidden" name="checkout" value="<?php echo $_SESSION['checkout'] ?>">
                <input type="submit" value="Sign In" class="btn btn-primary py-2 px-4 float-right" name="signin">
              </div>
            </form>
          
          </div>

          <div class="col-md-6 d-flex">
          	<form action="user_signin" class="bg-white p-5 contact-form" method="post">
              <h3 class="text-center mb-4">Signup Form</h3>
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Your Name" name="username">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Your Email" name="email">
              </div>
              <div class="form-group">
                <input type="password" class="form-control" placeholder="Your Password" name="password">
              </div>
              <div class="form-group">
                    <div class="col-md-12">
                      <div class="checkbox">
                         <label><input type="checkbox" value="" class="mr-2"> I have read and accept the terms and conditions</label>
                      </div>
                    </div>
              </div>
              <div class="form-group">
                <input type="hidden" name="checkout" value="<?php echo $_SESSION['checkout'] ?>">
                <input type="submit" value="Sign Up" class="btn btn-primary py-2 px-4 float-right" name="signup">
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>

<?php include('footer.php') ?>    
</body>
</html>
<?php 

if (isset($_POST['signin'])) {

    $email =mysqli_real_escape_string($con, $_POST['email']);
    $password =mysqli_real_escape_string($con, $_POST['password']);
    $checkout =mysqli_real_escape_string($con, $_POST['checkout']);

    $sql = "SELECT * FROM wb_user_details WHERE email = '$email' AND password = '$password'";
    $run = mysqli_query($con,$sql);
    $row = mysqli_num_rows($run);

    if ($row > 0) 
    {
         $data = mysqli_fetch_assoc($run);

         $status=$data['status'];

         if ($status=='Active') {
             $_SESSION['s_user_id'] = $data['id'];
             $_SESSION['s_user_name'] = $data['username'];

             if ($checkout==1) {
                header('location:checkout');
             }else{
                header('location:index');
             }
         }else
         {
            ?>
            <script type="text/javascript">
                alert('Your Account is Blocked. Please contact to Customer Care');
            </script>
            <?php 
         }

         
         
             
    }
    else{
           
         ?>
         <script type="text/javascript">
             swal('Checkout!','Email and Password do not Match ! Please try again','error')
             .then(function(){
                window.location = "user_signin";
             })
         </script>
         <?php  
          
    } 
}

############################################################

if (isset($_POST['signup'])) {

    $username =mysqli_real_escape_string($con, $_POST['username']);
    $email =mysqli_real_escape_string($con, $_POST['email']);
    $password =mysqli_real_escape_string($con, $_POST['password']);
    $checkout =mysqli_real_escape_string($con, $_POST['checkout']);
    date_default_timezone_set('Asia/Kolkata');
    $date = date('Y-m-d');

    $sql = "SELECT * FROM wb_user_details WHERE email = '$email'";
    $run = mysqli_query($con,$sql);
    $row = mysqli_num_rows($run);

    if ($row > 0) 
    {
        ?>
         <script type="text/javascript">
             swal('Checkout!','Email is already registered. Please change Email','error')
             .then(function(){
                window.location = "user_signin";
             })
         </script>
         <?php          
    }
    else
    {
        
        $sql="INSERT INTO `wb_user_details`(`create_on`,`username`, `email`, `password`) VALUES ('$date','$username','$email','$password')";
        $run=mysqli_query($con,$sql);
        if ($run) 
        {
            $sql="SELECT * FROM wb_user_details WHERE email = '$email'";
            $run = mysqli_query($con,$sql);
            $data = mysqli_fetch_assoc($run);

            $_SESSION['s_user_id'] = $data['id'];
            $_SESSION['s_user_name'] = $data['username'];

             if ($checkout==1) {
                header('location:checkout');
             }else{
                header('location:index');
             }
        } 
           
          
    } 
}
?>