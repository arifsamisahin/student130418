<?php

  require_once '../../core/init.php';

  global $connect;
  $p_id = $_POST['p_id'];

  $sql = "UPDATE payment SET p_status='0' WHERE p_id=$p_id";

  $query = $connect->query($sql);

 ?>
