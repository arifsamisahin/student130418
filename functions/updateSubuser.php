<?php

  require_once '../core/init.php';

  global $connect;

  $id = $_POST['id'];
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

  if(subuserExistInUserById($su_id, $u_id, $id) === TRUE){
    echo "<div class='alert alert-danger mt-3'>This id number <strong>" . $su_id . "</strong>" . " has already registered :)</div>";
  }else{

    if((userExists($username) === TRUE) || (teacherExists($username) === TRUE) || (subuserExistsExceptIt($username, $id) === TRUE)){
      echo "<div class='alert alert-danger mt-3'>This username <strong>" . $username . "</strong> is not available, please try different username :)</div>";
    }else{
      $sql = "UPDATE subuser SET su_id='$su_id', su_name='$name', su_birthday='$birthday', su_email='$email', su_phone='$phone', su_username='$username', su_pass='$pass', su_gender='$gender' WHERE id='$id'";
      $query = $connect->query($sql);

        if($query === TRUE){
          echo "<div class='alert alert-success mt-3'><strong>" . $name . "</strong>" . " succesfully updated :)</div>";
        }else {
          echo "<div class='alert alert-danger mt-3'><strong>" . $name . "</strong>" . " could not updated :)</div>";
        }
      }


    }//teacherExistInUser
 ?>
