<?php 
include('dbcon.php');

  echo $log_filename = $_SERVER['DOCUMENT_ROOT']."/vegione/log";
    if (!file_exists($log_filename))
    {
        // create directory/folder uploads.
        mkdir($log_filename, 0777, true);
    }

?>