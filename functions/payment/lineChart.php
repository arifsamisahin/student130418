<?php

  require_once 'core/init.php';

  global $connect;

  //$u_id = $_POST['u_id'];

  $today = date('Y-m-d');

  $sql = "SELECT concat( DATE_FORMAT(p_date ,'%m')) as `yearmonth`, SUM(p_amount) as `total` FROM payment WHERE YEAR(p_date)= YEAR('$today') AND p_status='1' GROUP BY 1 ORDER BY p_date";

  $result = mysqli_query($connect, $sql);
  $result1 = mysqli_query($connect, $sql);

  //while($row = mysqli_fetch_array($result)){
    //echo date("F", strtotime('00-'.$row['yearmonth'].'-01')) . " " . $row['total'] . "<br>";
  //}

//  labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
  //datasets: [{
    //  label: '# of Votes',
      //data: [12, 19, 3, 5, 2, 3],

  $labels = "";
  echo "labels: [";
  while($row = mysqli_fetch_array($result)){
      $labels .= "'" . date("F", strtotime('00-'.$row['yearmonth'].'-01')) . "'" . ",";
  }

  $labels = substr($labels, 0, -1);
  $labels .= "],datasets: [{ label: 'Payments TRY',data:[";

  while($row1 = mysqli_fetch_array($result1)){
      $labels .= $row1['total'] . ",";
  }

  $labels = substr($labels, 0, -1);
  $labels .= "],";

  echo $labels;
 ?>
