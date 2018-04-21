<?php

  require_once '../core/init.php';

  global $connect;

  $id = $_POST['id'];


        $sql = "UPDATE subuser SET su_status='0' WHERE id='$id'";

        $query = $connect->query($sql);

        if($query === TRUE){
          echo '<div class="alert alert-success">
                <strong>User is inactivated.
                </div>';
        }else {
          echo '<div class="alert alert-danger">
                <strong>Failed!</strong>.
                </div>';
        }


 ?>
