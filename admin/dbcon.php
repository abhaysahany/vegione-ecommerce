<?php  
session_start();
ob_start();

$con = mysqli_connect("localhost","root","","ecommerce");

if ($con) {

	

}else{

    echo "Not Connected";

}


?>