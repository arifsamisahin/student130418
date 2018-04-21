<?php

function teacherExistInUser($t_id, $u_id) {

    global $connect;

    $sql = "SELECT * FROM teacher WHERE t_id = '$t_id' AND u_id = '$u_id'";
    $query = $connect->query($sql);
    if($query->num_rows == 1) {
        return true;
    } else {
        return false;
    }

    $connect->close();
}

function teacherExistInUserById($t_id, $u_id, $id) {

    global $connect;

    $sql = "SELECT * FROM teacher WHERE t_id = '$t_id' AND u_id = '$u_id' AND id!='$id'";
    $query = $connect->query($sql);
    if($query->num_rows == 1) {
        return true;
    } else {
        return false;
    }

    $connect->close();
}

function teacherExists($username) {
  // global keyword is used to access a global variable from within a function
  global $connect;

  $sql = "SELECT * FROM teacher WHERE t_username = '$username'";
  $query = $connect->query($sql);
  if($query->num_rows == 1) {
      return true;
  } else {
      return false;
  }

  $connect->close();
  // close the database connection
}

function teacherExistsExceptIt($username, $id) {
  // global keyword is used to access a global variable from within a function
  global $connect;

  $sql = "SELECT * FROM teacher WHERE t_username = '$username' AND id!='$id'";
  $query = $connect->query($sql);
  if($query->num_rows == 1) {
      return true;
  } else {
      return false;
  }

  $connect->close();
  // close the database connection
}

function loginT($username, $password) {
  global $connect;

      $sql = "SELECT * FROM teacher WHERE t_username = '$username' AND t_pass = '$password' AND t_status='1'";
      $query = $connect->query($sql);

      if($query->num_rows == 1) {
          return true;
      } else {
          return false;
      }


  $connect->close();
}

function logoutT() {
  if(logged_in_teacher() === TRUE){
      // remove all session variable
      session_unset();

      // destroy the session
      session_destroy();

      header('location: ../index.php');
  }
}


function teacherdata($username) {
    global $connect;
    $sql = "SELECT * FROM teacher WHERE t_username = '$username'";
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

function getTeacherDataById($id) {
  global $connect;

  $sql = "SELECT * FROM teacher WHERE id=$id";
  $query = $connect->query($sql);
  $result = $query->fetch_assoc();
  return $result;

}

function logged_in_teacher() {
    if(isset($_SESSION['id'])) {
        return true;
    } else {
        return false;
    }
}

function getTeacherLogo($id){

    global $connect;

    $sql = "SELECT u.u_id, t.u_id, t.id, u.u_logo FROM user u, teacher t  WHERE u.u_id=t.u_id AND t.id='$id'";

    $result = mysqli_query($connect, $sql);
    while ($row = mysqli_fetch_array($result)) {
      echo $row['u_logo'];
    }
}

function getTeacherNameById($id){

    global $connect;

    $sql = "SELECT t_name, t_id FROM teacher  WHERE id='$id'";

    $result = mysqli_query($connect, $sql);
    while ($row = mysqli_fetch_array($result)) {
      return $row['t_name'];
    }
}

function getTeacherComp($id){

  global $connect;

  $sql = "SELECT u.u_id, t.u_id, t.id, u.u_cnAbbr FROM user u, teacher t  WHERE u.u_id=t.u_id AND t.id='$id'";

  $result = mysqli_query($connect, $sql);
  while ($row = mysqli_fetch_array($result)) {
    echo $row['u_cnAbbr'];
  }
}

function getTeacherCompId($id){

  global $connect;

  $sql = "SELECT u.u_id, t.u_id, t.id, u.u_cnAbbr FROM user u, teacher t  WHERE u.u_id=t.u_id AND t.id='$id'";

  $result = mysqli_query($connect, $sql);
  while ($row = mysqli_fetch_array($result)) {
    return $row['u_id'];
  }
}

function birthdayReminderT($u_id){
  global $connect;

  $sql = "SELECT t_name, u_id, t_birthday, t_status FROM teacher WHERE u_id='$u_id' AND t_status='1' AND DAY(t_birthday)=DAY(DATE(NOW())) AND MONTH(t_birthday)=MONTH(DATE(NOW()))";
  $result = mysqli_query($connect, $sql);
  while ($row = mysqli_fetch_array($result)) {
    echo   "<div class='alert alert-success alert-dismissible fade show'>
            <button type='button' class='close' data-dismiss='alert'>&times;</button>
            <img  src='icon/birthday.png' class='birthdayIcon mr-2' alt='Birthday'>Today <strong>" . $row['t_name'] . "</strong>'s birthday.
            </div>";
  }

  $sql = "SELECT t_name, u_id, t_birthday, DAY(t_birthday) as day_name, t_status FROM teacher WHERE u_id='$u_id' AND t_status='1' AND DAY(t_birthday)>DAY(DATE(NOW())) AND MONTH(t_birthday)=MONTH(DATE(NOW())) ORDER BY day_name";
  $result = mysqli_query($connect, $sql);
  while ($row = mysqli_fetch_array($result)) {
    echo   "<div class='alert alert-warning alert-dismissible fade show'>
            <button type='button' class='close' data-dismiss='alert'>&times;</button>
            <img  src='icon/birthday.png' class='birthdayIcon mr-2' alt='Birthday'><small>Next " . $row['day_name'] . "th of this month <strong>" . $row['t_name'] . "</strong>'s birthday.</small>
            </div>";
  }
}


 ?>
