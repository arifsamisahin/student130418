<?php

  require_once '../core/init.php';

  global $connect;
  $u_id = $_POST['u_id'];
  $school_name = $_POST['school_name'];


    $sql = "INSERT INTO school (u_id, school_name) VALUES ('$u_id', '$school_name')";

    $query = $connect->query($sql);
    if($query === TRUE){
      echo '<div class="alert alert-success">
            <strong> ' . $school_name . '</strong> added succesfully.
            </div>';
    }else {
      echo '<div class="alert alert-danger">
            <strong>Failed!</strong>.
            </div>';
    }

 ?>
