<?php

  require_once '../core/init.php';

  global $connect;
  $school_id = $_POST['school_id'];


    $sql = "UPDATE school SET school_status='0' WHERE school_id=$school_id";

    $query = $connect->query($sql);
    if($query === TRUE){
      echo '<div class="alert alert-success">
            <strong>School removed succesfully.
            </div>';
    }else {
      echo '<div class="alert alert-danger">
            <strong>Failed!</strong>.
            </div>';
    }
  
 ?>
