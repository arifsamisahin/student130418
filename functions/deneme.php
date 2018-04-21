<?php

  require_once '../core/init.php';

  global $connect;

  $sql = "SELECT * FROM student  WHERE s_status='1' ORDER BY s_name";
  $result = mysqli_query($connect, $sql);

  while ($row = mysqli_fetch_array($result)) {
    echo $row['s_name'];
  }
 ?>
