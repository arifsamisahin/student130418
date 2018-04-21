<?php

  require_once '../core/init.php';

  global $connect;

  $u_id = $_POST['u_id'];
  $t_id = $_POST['t_id'];
  $name = $_POST['name'];
  $day = $_POST['day'];
  $month = $_POST['month'];
  $year = $_POST['year'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $username = $_POST['username'];
  $pass = $_POST['pass'];
  $gender = $_POST['gender'];


  $date_old = $year . "-" . $month . "-" . $day;
  $birthday = date ("Y-m-d", strtotime($date_old));

  $today = date("Y-m-d");

  if(teacherExistInUser($t_id, $u_id) === TRUE){
    echo "<div class='alert alert-danger mt-3'><strong>" . $name . "</strong> is already registered :)</div>";
  }else{

      if((userExists($username) === TRUE) || (teacherExists($username) === TRUE) || (subuserExists($username) === TRUE)){
        echo "<div class='alert alert-danger mt-3'>This username <strong>" . $username . "</strong> is not available, please try different username :)</div>";
      }else{
      $sql = "INSERT INTO teacher (u_id, t_id, t_name, t_birthday, t_email, t_phone, t_username, t_pass, t_gender, t_registerDate ) VALUES ('$u_id', '$t_id', '$name', '$birthday', '$email', '$phone', '$username', '$pass', '$gender', '$today')";
      $query = $connect->query($sql);

        if($query === TRUE){
          echo "<div class='alert alert-success mt-3'><strong>" . $name . "</strong>" . " succesfully registered :)</div>";
        }else {
          echo "<div class='alert alert-danger mt-3'><strong>" . $name . "</strong>" . " could not registered :)</div>";
        }
      }//else userExists
    }//teacherExistInUser
 ?>
