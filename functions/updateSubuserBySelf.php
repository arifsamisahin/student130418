<?php

  require_once '../core/init.php';

  global $connect;

  $id = $_POST['id'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $username = $_POST['username'];
  $pass = $_POST['pass'];


  if((userExists($username) === TRUE) || (subuserExistsExceptIt($username, $id) === TRUE) || (teacherExists($username) === TRUE)){
    echo "<div class='alert alert-danger mt-3'>This username <strong>" . $username . "</strong> is not available, please try different username :)</div>";
  }else{
      $sql = "UPDATE teacher SET  t_email='$email', t_phone='$phone', t_username='$username', t_pass='$pass' WHERE id='$id'";
      $query = $connect->query($sql);

        if($query === TRUE){
          echo "<div class='alert alert-success mt-3'>Succesfully updated :)</div>";
        }else {
          echo "<div class='alert alert-danger mt-3'>Could not updated :)</div>";
        }
      }


 ?>
