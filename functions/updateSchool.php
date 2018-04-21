<?php

  require_once '../core/init.php';

  global $connect;
  $school_id = $_POST['school_id'];
  $new_name = $_POST['new_name'];


    $sql = "UPDATE school SET school_name='$new_name' WHERE school_id=$school_id";

    $query = $connect->query($sql);
    if($query === TRUE){
      echo '<div class="alert alert-success">
            <strong>School updated succesfully.
            </div>';
    }else {
      echo '<div class="alert alert-danger">
            <strong>Failed!</strong>.
            </div>';
    }

 ?>
