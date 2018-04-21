<?php

  require_once '../core/init.php';

  global $connect;

  $u_id = $_POST['u_id'];
  $s_id = $_POST['s_idNew'];
  $s_idOLD = $_POST['s_id'];
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
  $id = $_POST['id'];

  $date_old = $b_year . "-" . $b_month . "-" . $b_day;
  $s_birthday = date ("Y-m-d", strtotime($date_old));

    if((classCapacity($s_classId) > countActiveStudentByClass($s_classId)) || isStudentInThisClass($s_classId, $s_id)){
      if(studentExistInUserBySId($s_id, $u_id, $id) === FALSE){
        $sql = "UPDATE student SET s_id='$s_id', s_name='$s_name', s_schoolId='$s_schoolId', s_sclass='$s_sclass', s_birthday='$s_birthday', s_phone='$s_phone', s_disease='$s_disease', s_classId='$s_classId', s_gender='$s_gender' WHERE id='$id'";


        $query = $connect->query($sql);

        if($query === TRUE){
          echo '<strong>Student updated succesfully.</strong>';
        }else {
          echo '<strong>Failed!</strong>.';
        }

        $sql = "UPDATE studentParent SET s_id='$s_id' WHERE s_id='$s_idOLD'";
        $query = $connect->query($sql);


      }else{
          echo '<strong>This student alreay exist!</strong>.';
        }
      } else {
        echo '<strong>Class capacity is full!</strong> Please change the class capacity.';

      }

 ?>
