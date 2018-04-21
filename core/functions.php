<?php

  function login($username, $password) {
    global $connect;

        $sql = "SELECT * FROM user WHERE u_username = '$username' AND u_pass = '$password' AND u_status='1'";
        $query = $connect->query($sql);

        if($query->num_rows == 1) {
            return true;
        } else {
            return false;
        }


    $connect->close();
  }

  function logout() {
    if(logged_in() === TRUE){
        // remove all session variable
        session_unset();

        // destroy the session
        session_destroy();

        header('location: ../index.php');
    }
  }
  function userdata($username) {
      global $connect;
      $sql = "SELECT * FROM user WHERE u_username = '$username'";
      $query = $connect->query($sql);
      $result = $query->fetch_assoc();
      if($query->num_rows == 1) {
          return $result;
      } else {
          return false;
      }

      $connect->close();

      // close the database connection
  }

  function userExists($username) {
    // global keyword is used to access a global variable from within a function
    global $connect;

    $sql = "SELECT * FROM user WHERE u_username = '$username'";
    $query = $connect->query($sql);
    if($query->num_rows == 1) {
        return true;
    } else {
        return false;
    }

    $connect->close();
    // close the database connection
}

  function logged_in() {
      if(isset($_SESSION['u_id'])) {
          return true;
      } else {
          return false;
      }
  }

  function getUserDataByUserId($id) {
    global $connect;

    $sql = "SELECT * FROM user WHERE u_id = $id";
    $query = $connect->query($sql);
    $result = $query->fetch_assoc();
    return $result;

}

  function isStudentParentExistByName($s_id, $name) {

      global $connect;

      $sql = "SELECT * FROM studentParent WHERE s_id='$s_id' AND p_relation='$name'";
      $query = $connect->query($sql);
      if($query->num_rows == 1) {
          return true;
      } else {
          return false;
      }

  }
  function studentExistInUser($s_id, $u_id) {

      global $connect;

      $sql = "SELECT * FROM student WHERE s_id = '$s_id' AND u_id = '$u_id'";
      $query = $connect->query($sql);
      if($query->num_rows == 1) {
          return true;
      } else {
          return false;
      }

      $connect->close();
  }

  function studentExistInUserBySId($s_id, $u_id, $id) {

      global $connect;

      $sql = "SELECT * FROM student WHERE s_id = '$s_id' AND u_id = '$u_id' AND id!='$id'";
      $query = $connect->query($sql);
      if($query->num_rows == 1) {
          return true;
      } else {
          return false;
      }

      $connect->close();
  }

  function loadLessonSb($u_id){
    global $connect;

    $sql = "SELECT * FROM lesson WHERE lesson_status='1' AND u_id='$u_id' ORDER BY lesson_name";
    $result = mysqli_query($connect, $sql);
    while ($row = mysqli_fetch_array($result)) {
      echo "<option value='" . $row['lesson_id'] . "'>" . $row['lesson_name'] . "</option>";
    }
  }

  function loadSchoolSb($u_id){
    global $connect;

    $sql = "SELECT * FROM school WHERE school_status='1' AND u_id='$u_id' ORDER BY school_name";
    $result = mysqli_query($connect, $sql);
    while ($row = mysqli_fetch_array($result)) {
      echo "<option value='" . $row['school_id'] . "'>" . $row['school_name'] . "</option>";
    }
  }

  function loadTeacherSb($u_id){
    global $connect;

    $sql = "SELECT * FROM teacher WHERE t_status='1' AND u_id='$u_id' ORDER BY t_name";
    $result = mysqli_query($connect, $sql);
    while ($row = mysqli_fetch_array($result)) {
      echo "<option value='" . $row['id'] . "'>" . $row['t_name'] . "</option>";
    }
  }

  function loadClassSb($u_id){
    global $connect;

    $sql = "SELECT * FROM class  WHERE class_status='1' AND u_id='$u_id' ORDER BY class_name";
    $result = mysqli_query($connect, $sql);
    while ($row = mysqli_fetch_array($result)) {
      echo "<option value='" . $row['class_id'] . "'>" . $row['class_name'] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . countActiveStudentByClass($row['class_id']) ."/" . $row['class_cap']. "</option>";
    }
  }

  function loadStudentSb($u_id){
    global $connect;

    $sql = "SELECT * FROM student  WHERE s_status='1' AND u_id='$u_id' ORDER BY s_name";
    $result = mysqli_query($connect, $sql);
    while ($row = mysqli_fetch_array($result)) {
      echo "<option value='" . $row['id'] . "'>" . $row['s_name'] . "</option>";
    }
  }

  function loadClassChart($u_id){
    global $connect;

    $sql = "SELECT * FROM class c WHERE class_status='1' AND u_id='$u_id' ORDER BY class_name";
    $result = mysqli_query($connect, $sql);
    while ($row = mysqli_fetch_array($result)) {
      echo "['" . $row['class_name'] . "', " . countActiveStudentByClass($row['class_id']) . "],";
    }
  }

  function classCapacity($classId){
    global $connect;

    $sql = "SELECT class_cap FROM class WHERE class_id = $classId";
    $result = mysqli_query($connect, $sql);

    while($row = mysqli_fetch_array($result)){
      return $row['class_cap'];
    }
  }

  function isStudentInThisClass($s_classId, $s_id){
    global $connect;

    $sql = "SELECT s_id, s_classId FROM student WHERE s_id='$s_id' AND s_classId='$s_classId'";
    $query = $connect->query($sql);
    if($query->num_rows == 1) {
        return true;
    } else {
        return false;
    }

  }

  function countActiveStudent($u_id){
    global $connect;

    $sql = "SELECT * FROM student WHERE s_status = '1' AND u_id='$u_id'";
    $result = mysqli_query($connect, $sql);
    $num_rows = mysqli_num_rows($result);

    return $num_rows;
  }

  function countActiveStudentByClass($classId){
    global $connect;

    if($classId == '0'){
      return countActiveStudent();
    }else{
    $sql = "SELECT * FROM student WHERE s_status = '1' and s_classId = '$classId'";
    $result = mysqli_query($connect, $sql);
    $num_rows = mysqli_num_rows($result);

    return $num_rows;}
  }

  function countActiveClass($u_id){
    global $connect;

    $sql = "SELECT * FROM class WHERE class_status = '1' AND u_id='$u_id'";
    $result = mysqli_query($connect, $sql);
    $num_rows = mysqli_num_rows($result);

    return $num_rows;
  }

  function countParentByStudent($s_id){
    global $connect;

    $sql = "SELECT * FROM studentParent WHERE s_id = '$s_id'";

    $result = mysqli_query($connect, $sql);
    $num_rows = mysqli_num_rows($result);

    return $num_rows;
  }

  function countActiveStudentByGender($gender, $u_id){
    global $connect;

    $sql = "SELECT * FROM student WHERE s_gender = '$gender' and s_status = '1' and u_id='$u_id'";

    $result = mysqli_query($connect, $sql);
    $num_rows = mysqli_num_rows($result);

    return $num_rows;
  }

  function birthdayReminder($u_id){
    global $connect;

    $sql = "SELECT s_name, u_id, s_birthday, s_status FROM student WHERE u_id='$u_id' AND s_status='1' AND DAY(s_birthday)=DAY(DATE(NOW())) AND MONTH(s_birthday)=MONTH(DATE(NOW()))";
    $result = mysqli_query($connect, $sql);
    while ($row = mysqli_fetch_array($result)) {
      echo   "<div class='alert alert-success alert-dismissible fade show'>
              <button type='button' class='close' data-dismiss='alert'>&times;</button>
              <img  src='icon/birthday.png' class='birthdayIcon mr-2' alt='Birthday'>Today <strong>" . $row['s_name'] . "</strong>'s birthday.
              </div>";
    }

    $sql = "SELECT s_name, u_id, s_birthday, DAY(s_birthday) as day_name, s_status FROM student WHERE u_id='$u_id' AND s_status='1' AND DAY(s_birthday)>DAY(DATE(NOW())) AND MONTH(s_birthday)=MONTH(DATE(NOW())) ORDER BY day_name";
    $result = mysqli_query($connect, $sql);
    while ($row = mysqli_fetch_array($result)) {
      echo   "<div class='alert alert-warning alert-dismissible fade show'>
              <button type='button' class='close' data-dismiss='alert'>&times;</button>
              <img  src='icon/birthday.png' class='birthdayIcon mr-2' alt='Birthday'><small>Next " . $row['day_name'] . "th of this month <strong>" . $row['s_name'] . "</strong>'s birthday.</small>
              </div>";
    }
  }


  function getLogo($u_id){

      global $connect;

      $sql = "SELECT u_logo, u_id FROM user WHERE u_id='$u_id'";

      $result = mysqli_query($connect, $sql);
      while ($row = mysqli_fetch_array($result)) {
        echo $row['u_logo'];
      }
  }

  function getCompName($u_id){

    global $connect;

    $sql = "SELECT u_id, u_cnAbbr FROM user WHERE u_id='$u_id'";

    $result = mysqli_query($connect, $sql);
    while ($row = mysqli_fetch_array($result)) {
      echo $row['u_cnAbbr'];
    }
  }

  function getCompNameAll($u_id){

    global $connect;

    $sql = "SELECT u_id, u_companyname FROM user WHERE u_id='$u_id'";

    $result = mysqli_query($connect, $sql);
    while ($row = mysqli_fetch_array($result)) {
      echo $row['u_companyname'];
    }
  }

  function getCompNameByStudent($s_id){

    global $connect;

    $sql = "SELECT * FROM student s, user u WHERE s.id='$s_id' AND u.u_id=s.u_id";

    $result = mysqli_query($connect, $sql);
    while ($row = mysqli_fetch_array($result)) {
      echo $row['u_companyname'];
    }
  }

  function getLogoByStudent($s_id){

    global $connect;

    $sql = "SELECT * FROM student s, user u WHERE s.id='$s_id' AND u.u_id=s.u_id";

    $result = mysqli_query($connect, $sql);
    while ($row = mysqli_fetch_array($result)) {
      echo $row['u_logo'];
    }
  }

  function getStudentParentPhone($id){

    global $connect;

    $sql = "SELECT * FROM student s, parent p, studentParent sp WHERE s.id='$id' AND s.s_id=sp.s_id AND sp.p_id=p.p_id LIMIT 1";

    $result = mysqli_query($connect, $sql);
    while ($row = mysqli_fetch_array($result)) {
      echo $row['p_phone'];
    }
  }

  function lineChart($u_id){

    global $connect;

    $today = date('Y-m-d');

    $sql = "SELECT concat( DATE_FORMAT(p_date ,'%m')) as `yearmonth`, SUM(p_amount) as `total` FROM payment WHERE YEAR(p_date)= YEAR('$today') AND u_id='$u_id' AND p_status='1' GROUP BY 1 ORDER BY p_date";

    $result = mysqli_query($connect, $sql);
    $result1 = mysqli_query($connect, $sql);

    //while($row = mysqli_fetch_array($result)){
      //echo date("F", strtotime('00-'.$row['yearmonth'].'-01')) . " " . $row['total'] . "<br>";
    //}

  //  labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
    //datasets: [{
      //  label: '# of Votes',
        //data: [12, 19, 3, 5, 2, 3],

    $labels = "";
    echo "labels: [";
    while($row = mysqli_fetch_array($result)){
        $labels .= "'" . date("F", strtotime('00-'.$row['yearmonth'].'-01')) . "'" . ",";
    }

    $labels = substr($labels, 0, -1);
    $labels .= "],datasets: [{ label: 'Payments TRY',data:[ ";

    while($row1 = mysqli_fetch_array($result1)){
        $labels .= $row1['total'] . ",";
    }

    $labels = substr($labels, 0, -1);
    $labels .= "],";

    return $labels;
  }

 ?>
