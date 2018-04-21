<?php

  require_once '../core/init.php';

  global $connect;
  $u_id = $_POST['u_id'];
  $class_name = $_POST['class_name'];
  $class_cap = $_POST['class_cap'];


    $sql = "INSERT INTO class (u_id, class_name, class_cap) VALUES ('$u_id', '$class_name', '$class_cap')";

    $query = $connect->query($sql);
    if($query === TRUE){
      echo '<div class="alert alert-success">
            <strong> ' . $class_name . ' </strong> class added succesfully.
            </div>';
    }else {
      echo '<div class="alert alert-danger">
            <strong>Failed!</strong>.
            </div>';
    }

 ?>
