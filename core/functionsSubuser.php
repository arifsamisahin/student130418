<?php

function subuserExistInUser($su_id, $u_id) {

    global $connect;

    $sql = "SELECT * FROM subuser WHERE su_id = '$su_id' AND u_id = '$u_id'";
    $query = $connect->query($sql);
    if($query->num_rows == 1) {
        return true;
    } else {
        return false;
    }

    $connect->close();
}

function subuserExists($username) {
  // global keyword is used to access a global variable from within a function
  global $connect;

  $sql = "SELECT * FROM subuser WHERE su_username = '$username'";
  $query = $connect->query($sql);
  if($query->num_rows == 1) {
      return true;
  } else {
      return false;
  }

  $connect->close();
  // close the database connection
}

function subuserExistInUserById($su_id, $u_id, $id) {

    global $connect;

    $sql = "SELECT * FROM subuser WHERE su_id = '$su_id' AND u_id = '$u_id' AND id!='$id'";
    $query = $connect->query($sql);
    if($query->num_rows == 1) {
        return true;
    } else {
        return false;
    }

    $connect->close();
}

function subuserExistsExceptIt($username, $id) {
  // global keyword is used to access a global variable from within a function
  global $connect;

  $sql = "SELECT * FROM subuser WHERE su_username = '$username' AND id!='$id'";
  $query = $connect->query($sql);
  if($query->num_rows == 1) {
      return true;
  } else {
      return false;
  }

  $connect->close();
  // close the database connection
}

function loginSub($username, $password) {
  global $connect;

      $sql = "SELECT * FROM subuser WHERE su_username = '$username' AND su_pass = '$password' AND su_status='1'";
      $query = $connect->query($sql);

      if($query->num_rows == 1) {
          return true;
      } else {
          return false;
      }

  $connect->close();
}

function subuserdata($username) {
    global $connect;
    $sql = "SELECT * FROM subuser WHERE su_username = '$username'";
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

function logged_in_subuser() {
    if(isset($_SESSION['su_id'])) {
        return true;
    } else {
        return false;
    }
}

function getSubuserDataById($id) {
  global $connect;

  $sql = "SELECT * FROM subuser WHERE id=$id";
  $query = $connect->query($sql);
  $result = $query->fetch_assoc();
  return $result;

}

function logoutSu() {
  if(logged_in_subuser() === TRUE){
      // remove all session variable
      session_unset();

      // destroy the session
      session_destroy();

      header('location: ../index.php');
  }
}

function getSubuserName($id){

    global $connect;

    $sql = "SELECT su_name, id FROM subuser  WHERE id='$id'";

    $result = mysqli_query($connect, $sql);
    while ($row = mysqli_fetch_array($result)) {
      return $row['su_name'];
    }
}

function birthdayReminderSu($u_id){
  global $connect;

  $sql = "SELECT su_name, u_id, su_birthday, su_status FROM subuser WHERE u_id='$u_id' AND su_status='1' AND DAY(su_birthday)=DAY(DATE(NOW())) AND MONTH(su_birthday)=MONTH(DATE(NOW()))";
  $result = mysqli_query($connect, $sql);
  while ($row = mysqli_fetch_array($result)) {
    echo   "<div class='alert alert-success alert-dismissible fade show'>
            <button type='button' class='close' data-dismiss='alert'>&times;</button>
            <img  src='icon/birthday.png' class='birthdayIcon mr-2' alt='Birthday'>Today <strong>" . $row['su_name'] . "</strong>'s birthday.
            </div>";
  }

  $sql = "SELECT su_name, u_id, su_birthday, DAY(su_birthday) as day_name, su_status FROM subuser WHERE u_id='$u_id' AND su_status='1' AND DAY(su_birthday)>DAY(DATE(NOW())) AND MONTH(su_birthday)=MONTH(DATE(NOW())) ORDER BY day_name";
  $result = mysqli_query($connect, $sql);
  while ($row = mysqli_fetch_array($result)) {
    echo   "<div class='alert alert-warning alert-dismissible fade show'>
            <button type='button' class='close' data-dismiss='alert'>&times;</button>
            <img  src='icon/birthday.png' class='birthdayIcon mr-2' alt='Birthday'><small>Next " . $row['day_name'] . "th of this month <strong>" . $row['su_name'] . "</strong>'s birthday.</small>
            </div>";
  }
}

 ?>
