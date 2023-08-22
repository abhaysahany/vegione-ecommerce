<?php 
session_start();
unset($_SESSION['USER_ADMIN']);

setcookie("USER_ADMIN","", time() - 3600);

header('location:index.php');

?>