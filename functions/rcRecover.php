<?php

  require_once '../core/init.php';

  global $connect;
  $id = $_POST['rC'];

  $sql = "UPDATE rollCall SET recover='1' WHERE id=$id";

  $query = $connect->query($sql);

 ?>
