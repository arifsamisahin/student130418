<?php

  require_once '../core/init.php';

  global $connect;
  $lesson_id = $_POST['lesson_id'];


    $sql = "UPDATE lesson SET lesson_status='0' WHERE lesson_id=$lesson_id";

    $query = $connect->query($sql);
    if($query === TRUE){
      echo '<div class="alert alert-success">
            <strong>Lesson removed succesfully.
            </div>';
    }else {
      echo '<div class="alert alert-danger">
            <strong>Failed!</strong>.
            </div>';
    }

 ?>
