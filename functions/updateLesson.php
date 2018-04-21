<?php

  require_once '../core/init.php';

  global $connect;
  $lesson_id = $_POST['lesson_id'];
  $new_name = $_POST['new_name'];


    $sql = "UPDATE lesson SET lesson_name='$new_name' WHERE lesson_id=$lesson_id";

    $query = $connect->query($sql);
    if($query === TRUE){
      echo '<div class="alert alert-success">
            <strong>Lesson updated succesfully.
            </div>';
    }else {
      echo '<div class="alert alert-danger">
            <strong>Failed!</strong>.
            </div>';
    }

 ?>
