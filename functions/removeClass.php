<?php

  require_once '../core/init.php';

  global $connect;
  $class_id = $_POST['class_id'];

  if(countActiveStudentByClass($class_id) == '0'){

    $sql = "UPDATE class SET class_status='0' WHERE class_id=$class_id";

    $query = $connect->query($sql);
    if($query === TRUE){
      echo '<div class="alert alert-success">
            <strong>Class removed succesfully.</strong>
            </div>';
    }else {
      echo '<div class="alert alert-danger">
            <strong>Failed!</strong>.
            </div>';
    }
    }
    else{
      echo '<div class="alert alert-danger">
            <strong>This class has students, it can not be removed!</strong>.
            </div>';
    }

 ?>
