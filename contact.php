<?php  
include('admin/dbcon.php');
include('admin/function.php');
include('insert_cart.php');

?>
<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
    <title>Contact Us - Vegione</title>
<?php include('header.php') ?>    
    <div class="hero-wrap hero-bread" style="background-image: url('images/bg_1.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Contact us</span></p>
            <h1 class="mb-0 bread">Contact us</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section contact-section bg-light">
      <div class="container">
      	<div class="row d-flex mb-5 contact-info">
          <div class="w-100"></div>
          <div class="col-md-3 d-flex">
          	<div class="info bg-white p-4">
	            <p><span>Address:</span> 198 West 21th Street, Suite 721 New York NY 10016</p>
	          </div>
          </div>
          <div class="col-md-3 d-flex">
          	<div class="info bg-white p-4">
	            <p><span>Phone:</span> <a href="tel://1234567920">+ 1235 2355 98</a></p>
	          </div>
          </div>
          <div class="col-md-3 d-flex">
          	<div class="info bg-white p-4">
	            <p><span>Email:</span> <a href="mailto:info@yoursite.com">info@yoursite.com</a></p>
	          </div>
          </div>
          <div class="col-md-3 d-flex">
          	<div class="info bg-white p-4">
	            <p><span>Website</span> <a href="#">yoursite.com</a></p>
	          </div>
          </div>
        </div>
        <div class="row block-9">
          <div class="col-md-6 order-md-last d-flex">
            <form action="contact" class="bg-white p-5 contact-form" method="post">
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Your Name" name="name">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Your Mobile" name="mobile">
              </div>
              <div class="form-group">
                <input type="email" class="form-control" placeholder="Your Email" name="email">
              </div>
              <div class="form-group">
                <textarea name="message" cols="30" rows="7" class="form-control" placeholder="Message" ></textarea>
              </div>
              <div class="form-group">
                <input type="submit" value="Send Message" class="btn btn-primary py-3 px-5 float-right" name="submit">
              </div>
            </form>
          
          </div>

          <div class="col-md-6 d-flex">
          	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d111679.97494391547!2d77.62891950810051!3d28.98739421544116!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390c64f457b66325%3A0x42faa83387a6be5e!2sMeerut%2C%20Uttar%20Pradesh!5e0!3m2!1sen!2sin!4v1628341935254!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
          </div>
        </div>
      </div>
    </section>

<?php include('footer.php') ?>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>  
</body>
</html>
<?php 

if (isset($_POST['submit'])) {
  
  $name = mysqli_real_escape_string($con, $_POST['name']);
  $mobile = mysqli_real_escape_string($con, $_POST['mobile']);
  $email = mysqli_real_escape_string($con, $_POST['email']);
  echo $message = mysqli_real_escape_string($con, $_POST['message']);
  date_default_timezone_set('Asia/Kolkata');
  $date = date('Y-m-d');

  $sql = "INSERT INTO `wb_contact_us`(`msg_date`, `name`, `mobile`, `email`, `message`) VALUES ('$date','$name','$mobile','$email','$message')";
  $run = mysqli_query($con, $sql);

  if ($run) 
  {
    ?>
    <script type="text/javascript">
      swal("Sent","Your Message has been sent successfully! We will get back to you soon","success")
      .then(function(){
      window.location = "contact";
      });
    </script>
    <?php
  }
}


?>