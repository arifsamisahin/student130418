<?php

  require_once '../core/init.php';

  global $connect;

  $id = $_POST['id'];

  $sql = "DELETE FROM rollCall WHERE id=$id";

  $connect->query($sql);


 ?>
