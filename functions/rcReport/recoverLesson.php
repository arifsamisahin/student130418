<?php

  require_once '../../core/init.php';

  global $connect;

  $id = $_POST['id'];
  $comment = $_POST['comment'];

  date_default_timezone_set("Europe/Istanbul");
  $date = date("Y-m-d H:i:sa");

  $sql = "UPDATE rollCall SET recover='1', comment='$comment', recover_date='$date' WHERE id=$id";

  $query = $connect->query($sql);
  if($query === TRUE){
    echo "success";
  }else{
    echo "Fail";
  }

 ?>
