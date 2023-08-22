<?php 
session_start();
unset($_SESSION['s_user_id']);
unset($_SESSION['s_user_name']);

header('location:index');

?>