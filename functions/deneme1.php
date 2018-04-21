<?php

  require_once '../core/init.php';

  global $connect;

  //$s_id = $_POST['s_id'];
  $s_id = '124349512476';

  $sql = "SELECT DAY(s_birthday) as day, MONTH(s_birthday) as month, YEAR(s_birthday) as year, s_id, s_name, s_schoolId, s_sclass, s_phone, s_disease, s_classId, s_registerDate FROM student WHERE s_id='$s_id'";
  $result = mysqli_query($connect, $sql);

  while ($row = mysqli_fetch_array($result)) {
    echo $row['day'] . "<br>";
    echo $row['month'] . "<br>";
    echo $row['year'];


 }?>
