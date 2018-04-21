<?php

  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "elaStudent";

  // crearte connection
  $connect = new mysqli($servername, $username, $password, $dbname);

  //set the text format
  mysqli_query($connect, "SET NAMES UTF8");

  date_default_timezone_set("Europe/Istanbul");

  // check connection
  if($connect->connect_error) {
      die("Connection Failed : " . $connect->error);
  } else {
      // echo "Successfully Connected";
  }

?>
