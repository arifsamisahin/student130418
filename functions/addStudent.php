<?php

  require_once '../core/init.php';

  global $connect;

  $u_id = $_POST['u_id'];
  $s_id = $_POST['s_id'];
  $s_name = $_POST['s_name'];
  $b_day = $_POST['b_day'];
  $b_month = $_POST['b_month'];
  $b_year = $_POST['b_year'];
  $s_phone = $_POST['s_phone'];
  $s_disease = $_POST['s_disease'];
  $s_classId = $_POST['s_classId'];
  $s_schoolId = $_POST['s_schoolId'];
  $s_sclass = $_POST['s_sclass'];
  $s_gender = $_POST['s_gender'];

  $date_old = $b_year . "-" . $b_month . "-" . $b_day;
  $birthday = date ("Y-m-d", strtotime($date_old));

  $today = date("Y-m-d");

  if($s_gender == '1'){
    $s_image = "profileM.png";
  }else{
    $s_image = "profileF.png";
  }

  if(studentExistInUser($s_id, $u_id) === TRUE){
    echo "<strong>" . $s_name . "</strong>" . " student is already registered :)";
  }else{

    if(classCapacity($s_classId) > countActiveStudentByClass($s_classId)){
      $sql = "INSERT INTO student (u_id, s_id, s_name, s_schoolId, s_sclass, s_birthday, s_phone, s_disease, s_classId, s_registerDate, s_gender, s_image) VALUES ('$u_id', '$s_id', '$s_name', '$s_schoolId', '$s_sclass', '$birthday', '$s_phone', '$s_disease', '$s_classId', '$today', '$s_gender', '$s_image')";
      $query = $connect->query($sql);

        if($query === TRUE){
          echo "<strong>" . $s_name . "</strong>" . " succesfully registered :)";
        }else {
          echo "<strong>" . $s_name . "</strong>" . " couldn't registered :)";
        }
      }
      else {
        echo "<strong>Class capacity is full</strong>";
      }

    }//studentExist
 ?>
