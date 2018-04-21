<?php

  require_once '../core/init.php';

  global $connect;
  $u_id = $_POST['u_id'];
  $lesson_name = $_POST['lesson_name'];


    $sql = "INSERT INTO lesson (u_id, lesson_name) VALUES ('$u_id', '$lesson_name')";

    $query = $connect->query($sql);
    if($query === TRUE){
      echo '<div class="alert alert-success">
            <strong> ' . $lesson_name . '</strong> added succesfully.
            </div>';
    }else {
      echo '<div class="alert alert-danger">
            <strong>Failed!</strong>.
            </div>';
    }

 ?>
