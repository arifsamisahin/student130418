<?php

  require_once '../core/init.php';

  global $connect;

  $id = $_POST['id'];


        $sql = "UPDATE teacher SET t_status='1' WHERE id='$id'";

        $query = $connect->query($sql);

        if($query === TRUE){
          echo '<div class="alert alert-success">
                <strong>Teacher is inactivated.
                </div>';
        }else {
          echo '<div class="alert alert-danger">
                <strong>Failed!</strong>.
                </div>';
        }


 ?>
