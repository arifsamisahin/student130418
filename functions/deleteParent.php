<?php

  require_once '../core/init.php';

  global $connect;

  $p_id = $_POST['p_id'];

    $sql = "DELETE FROM parent WHERE p_id=$p_id";

    $sql1 = "DELETE FROM studentParent WHERE p_id=$p_id";

    if (($connect->query($sql) === TRUE) && ($connect->query($sql1) === TRUE)){
        echo "Deleted Succesfully";
    } else {
        echo "Coulnd't delete: " . $connect->error;
    }


 ?>
