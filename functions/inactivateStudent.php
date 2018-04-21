<?php

  require_once '../core/init.php';

  global $connect;

  $u_id = $_POST['u_id'];
  $s_id = $_POST['s_id'];


        $sql = "UPDATE student SET s_status='0' WHERE u_id=$u_id AND s_id=$s_id";

        $query = $connect->query($sql);

        if($query === TRUE){
          echo '<div class="alert alert-success">
                <strong>Student is inactivated.
                </div>';
        }else {
          echo '<div class="alert alert-danger">
                <strong>Failed!</strong>.
                </div>';
        }


 ?>
