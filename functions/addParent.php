<?php

  require_once '../core/init.php';

  global $connect;

  $s_id = $_POST['s_id'];
  $u_id = $_POST['u_id'];

  $name = $_POST['name'];
  $job = $_POST['job'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];
  $relation = $_POST['relation'];

  if(studentExistInUser($s_id, $u_id) === TRUE){
    if(isStudentParentExistByName($s_id, $relation) === FALSE){
      $sql = "INSERT INTO parent (p_name, p_job, p_phone, p_email) VALUES ('$name', '$job', '$phone', '$email')";
      $query = $connect->query($sql);

      if($query === TRUE){
        $last_id = $connect->insert_id;
        echo $name . " added as ";
      }else {
        echo $name . "couldn't added as ";
      }

      $sql = "INSERT INTO studentParent (s_id, p_id, p_relation) VALUES ('$s_id', '$last_id' , '$relation')";

      $query = $connect->query($sql);

      if($query === TRUE){
        echo $relation;
      }else {
        echo " error";
      }
  }else{
    echo "Student's ". $relation ." are already added";
  }
}else{
  echo "Please check the form.";
}

 ?>
