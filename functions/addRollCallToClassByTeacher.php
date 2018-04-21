<?php

    require_once '../core/init.php';

    global $connect;

    $u_id = $_POST['u_id'];
    $id = $_POST['id'];
    $lesson_id = $_POST['lesson_id'];

    $students = json_decode(stripslashes($_POST['students']));
    $values = json_decode(stripslashes($_POST['degerler']));
    $reasons = json_decode(stripslashes($_POST['nedenler']));

    $number = count($students);

    date_default_timezone_set("Europe/Istanbul");
    $date = date("Y-m-d H:i:sa");

    for ($i = 0; $i < $number; $i++) {

      $sql = "INSERT INTO rollCall (student_id, u_id, rC_status, added_id, rC_time, recover, lesson_id, reason) VALUES ('$students[$i]', '$u_id', '$values[$i]', '$id', '$date', '0', '$lesson_id', '$reasons[$i]')";

      $query = $connect->query($sql);

    }

    if($query === TRUE){
      echo '<div class="alert alert-success">
            <strong> Roll Call is succesfull :)</strong>
            </div>';
    }else {
      echo '<div class="alert alert-danger">
            <strong>Failed!</strong>.
            </div>';
    }

 ?>
