<?php

  require_once '../core/init.php';

  global $connect;

  $u_id = $_POST['u_id'];
  $su_id = $_POST['t_id'];
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

  if(subuserExistInUser($su_id, $u_id) === TRUE){
    echo "<div class='alert alert-danger mt-3'><strong>" . $name . "</strong> is already registered :)</div>";
  }else{

      if((userExists($username) === TRUE) || (teacherExists($username) === TRUE) || (subuserExists($username) === TRUE)){
        echo "<div class='alert alert-danger mt-3'>This username <strong>" . $username . "</strong> is not available, please try different username :)</div>";
      }else{
      $sql = "INSERT INTO subuser (u_id, su_id, su_name, su_birthday, su_email, su_phone, su_username, su_pass, su_gender, su_registerDate ) VALUES ('$u_id', '$su_id', '$name', '$birthday', '$email', '$phone', '$username', '$pass', '$gender', '$today')";
      $query = $connect->query($sql);

        if($query === TRUE){
          echo "<div class='alert alert-success mt-3'><strong>" . $name . "</strong>" . " succesfully registered :)</div>";
        }else {
          echo "<div class='alert alert-danger mt-3'><strong>" . $name . "</strong>" . " could not registered :)</div>";
        }
      }//else userExists
    }//teacherExistInUser
 ?>
