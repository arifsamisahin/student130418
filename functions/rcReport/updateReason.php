<?php

  require_once '../../core/init.php';

  global $connect;
  $id = $_POST['id'];
  $reason = $_POST['reason'];

  $sql = "UPDATE rollCall SET reason='$reason' WHERE id=$id";

  $query = $connect->query($sql);

 ?>
