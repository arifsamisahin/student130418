<?php

  require_once '../core/init.php';

  global $connect;
  $id = $_POST['rC'];

  $sql = "UPDATE rollCall SET rC_status='0', recover='0' WHERE id=$id";

  $query = $connect->query($sql);

 ?>
