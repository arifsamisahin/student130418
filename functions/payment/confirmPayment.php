<?php

  require_once '../../core/init.php';

  global $connect;

  $s_id = $_POST['id'];
  $period = $_POST['period'];
  $whoPays = $_POST['whoPays'];
  $amount = $_POST['amount'];
  $takenBy = $_POST['takenBy'];
  $u_id = $_POST['u_id'];
  $su_id = $_POST['su_id'];

  date_default_timezone_set("Europe/Istanbul");
  $date = date("Y-m-d H:i:sa");

  if($su_id == '0'){
    $whoTake = $u_id;
    $sql = "INSERT INTO payment (u_id, s_id, p_date, p_amount, p_whoPaid, p_whoTake, p_period, p_takenBy, p_status) VALUES ('$u_id', '$s_id', '$date', '$amount', '$whoPays', '$u_id', '$period', '$takenBy', '1')";
  }else{
    $sql = "INSERT INTO payment (u_id, s_id, p_date, p_amount, p_whoPaid, p_whoTake, p_period, p_takenBy, p_status) VALUES ('$u_id', '$s_id', '$date', '$amount', '$whoPays', '$su_id', '$period', '$takenBy', '0')";
  }


  $query = $connect->query($sql);

  if($query === TRUE){
    echo '<div class="alert alert-success">
          <strong>Payment is succesfull</strong>
          </div>';
  }else{
    echo '<div class="alert alert-danger">
          <strong> Error :)</strong>.
          </div>';
  }
 ?>
