<?php

  require_once '../core/init.php';

  global $connect;
  $class_id = $_POST['class_id'];
  $class_name = $_POST['class_name'];
  $class_cap = $_POST['class_cap'];




      if(countActiveStudentByClass($class_id) <= $class_cap){

        $sql = "UPDATE class SET class_name='$class_name', class_cap='$class_cap' WHERE class_id=$class_id";

        $query = $connect->query($sql);

        if($query === TRUE){
          echo '<div class="alert alert-success">
                <strong>Class updated succesfully.
                </div>';
        }else {
          echo '<div class="alert alert-danger">
                <strong>Failed!</strong>.
                </div>';
        }
    }else{
      echo '<div class="alert alert-danger">
            <strong>Capacity can not be ' . $class_cap . '!</strong>. Because there are already' . classCapacity($class_id) . ' students at this class
            </div>';
    }

 ?>
